<?php
// Uncomment below for debugging only — never enable on production
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
ini_set('display_errors', '0');

session_start();
require_once 'setup.php';
require_once dirname(__FILE__) . '/internal_libs/database.class.php';
require_once dirname(__FILE__) . '/internal_libs/validate.class.php';
require_once dirname(__FILE__) . '/internal_libs/common.class.php';
require_once dirname(__FILE__) . '/external_libs/thumbnail.php';
require_once dirname(__FILE__) . '/external_libs/smarty-4.1.0/libs/SmartyPaginate.class.php';
require_once dirname(__FILE__) . '/src/admin/functions_admin.php';
require_once dirname(__FILE__) . '/src/order/functions_order.php';

$common = new common();

// ─── Request parameters ───────────────────────────────────────────────────────
$task   = !empty($_GET['task'])   ? $_GET['task']   : null;
$action = !empty($_GET['action']) ? $_GET['action'] : null;
$lang   = !empty($_GET['lang'])   ? $_GET['lang']   : null;
$kwd    = !empty($_GET['kwd'])    ? $_GET['kwd']    : null;

// ─── Smarty ───────────────────────────────────────────────────────────────────
$smarty_appform = new SHOP_SMARTY();
$smarty_appform->assign('smpaginate',  'common/paginate.tpl');
$smarty_appform->assign('index_file',  $index_file);
$smarty_appform->assign('shop_site',   $shop_site);
$smarty_appform->assign('order_file',  $order_file);

// ─── Pagination ───────────────────────────────────────────────────────────────
if (empty($_SESSION['task']))   $_SESSION['task']   = $task;
if (empty($_SESSION['action'])) $_SESSION['action'] = $action;
if (empty($_SESSION['kwd']))    $_SESSION['kwd']    = $kwd;

if ($_SESSION['task'] !== $task)                                                                        (new SmartyPaginate)->disconnect();
if (($_SESSION['task'] === $task) && ($_SESSION['action'] !== $action))                                 (new SmartyPaginate)->disconnect();
if (($_SESSION['task'] === $task) && ($_SESSION['action'] === $action) && $_SESSION['kwd'] !== $kwd)    (new SmartyPaginate)->disconnect();

(new SmartyPaginate)->disconnect();
(new SmartyPaginate)->connect();
(new SmartyPaginate)->setLimit($limit);

if ((new SmartyPaginate)->getCurrentIndex()) $offset = (new SmartyPaginate)->getCurrentIndex();
if ((new SmartyPaginate)->getLimit())        $limit  = (new SmartyPaginate)->getLimit();

$geturl = '?task=' . $task . '&action=' . $action . '&kwd=' . urlencode((string)$kwd);
(new SmartyPaginate)->setUrl($geturl);

$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$smarty_appform->assign('current_page', $current_page);
// ─── End Pagination ───────────────────────────────────────────────────────────

$total_data = null;
$error      = '';

// ─── Database connection ──────────────────────────────────────────────────────
$database_connect        = new database(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
$database_connect->debug = $debug;
$connected               = $database_connect->_Connect;

if (!$connected instanceof PDO) {
    http_response_code(500);
    $message = 'Database connection failed. Check DB_HOSTNAME, DB_USER, DB_PASSWORD, and DB_DATABASE_NAME in setup.php.';
    if (!empty($database_connect->lastError)) {
        $message .= ' PDO error: ' . $database_connect->lastError;
    }
    exit($message);
}

// ─── Add staff name to menu ───────────────────────────────────────────────────
$staff_id_session = $_SESSION['staff_id'] ?? null;
$staff_data       = $staff_id_session ? $common->find('staff', ['id' => $staff_id_session], 'one') : null;
$smarty_appform->assign('staff_name', $staff_data['name'] ?? '');

// ─── Task: logout ─────────────────────────────────────────────────────────────
if ($task === 'logout') {
    unset($_SESSION['staff_id'], $_SESSION['branch_id']);
    header('location:' . $order_file . '?task=login');
    exit;
}

// ─── Task: login ──────────────────────────────────────────────────────────────
if ($task === 'login') {
    $error = [];
    if ($_POST) {
        if (empty($_POST['id']))       $error['id']       = 1;
        if (empty($_POST['password'])) $error['password'] = 1;

        if (!empty($_POST['id']) && !empty($_POST['password'])) {
            $status = $common->find('staff', ['id' => $_POST['id'], 'password' => $_POST['password']], 'one');
            if (!empty($status)) {
                if ($status['is_quited'] == 1)          $error['stopped'] = 1;
                if ($status['name'] === 'data_entry')   $error['stopped'] = 1;
            }
            $result = staff_login($_POST['id'], $_POST['password']);
            if (count($error) === 0 && !empty($result) && !empty($result['id'])) {
                $_SESSION['staff_id']  = $result['id'];
                $_SESSION['branch_id'] = $result['branch_id'];
                header('location:' . $order_file);
                exit;
            }
            $error['login'] = 1;
        }
    }
    $smarty_appform->assign('error', $error);
    $smarty_appform->display('order/staff_enter.tpl');
    exit;
}

// ─── Redirect to login if no session ─────────────────────────────────────────
if (empty($_SESSION['staff_id'])) {
    header('location:' . $order_file . '?task=login');
    exit;
}

// ─── Branch information ───────────────────────────────────────────────────────
$branch = getBranchById($_SESSION['branch_id'] ?? 0);
$smarty_appform->assign('branch', $branch);

// ─── Task: order ─────────────────────────────────────────────────────────────
if ($task === 'order') {
    if ($action === 'edit') {
        $data_order                 = getOrderById($_GET['id'] ?? 0);
        $data_order['invoivce_num'] = sprintf("%06d", $data_order['id'] ?? 0);
        $smarty_appform->assign('orderInfo',    $data_order);
        $smarty_appform->assign('customerInfo', $common->find('customer', ['id' => $data_order['customer_id']], 'one'));
        $smarty_appform->assign('list_items',   getOrderItemByOrderIDForEdit($data_order['id']));
        $smarty_appform->display('order/product_order_edit.tpl');
        exit;
    }
    if ($action === 'upate_invoice') {
        header('Content-Type: application/json');
        if ($_POST) {
            $staff_id    = $common->clean_string($_POST['staffid']     ?? '');
            $branch_id   = $common->clean_string($_POST['branchid']    ?? '');
            $subtotal    = $common->clean_string($_POST['subtotal']    ?? '');
            $discount    = $common->clean_string($_POST['discount']    ?? '');
            $warrenty    = $common->clean_string($_POST['warrenty']    ?? '');
            $total       = $common->clean_string($_POST['total_all']   ?? '');
            $model_text  = $common->clean_string($_POST['model_text']  ?? '');
            $model_price = $common->clean_string($_POST['model_price'] ?? '');
            $order_id    = $common->clean_string($_POST['order_id']    ?? '');
            $customer_id = $common->clean_string($_POST['customer_id'] ?? '');
            $customer    = json_decode($_POST['customer'] ?? '{}');
            $items       = json_decode($_POST['items']    ?? '[]');
            $result = update_order_data_no_cuting($order_id, $customer_id, $staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items);
            echo json_encode(['result' => $result]);
        }
        exit;
    }
    header('Content-Type: application/json');
    if (isset($_POST['imei']) && '' !== $_POST['imei']) {
        $data = getProductDataByImei($_POST['imei'], $_SESSION['branch_id'] ?? 0, 2);
        echo $data ? json_encode($data) : json_encode(['imei' => null]);
    }
    exit;
}

// ─── Task: customer ───────────────────────────────────────────────────────────
if ($task === 'customer') {
    if ($action === 'SearchByPersonalID') {
        $national_id = $common->clean_string($_POST['nationalid'] ?? '');
        $result      = getCustomerByNationalId($national_id);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    if ($action === 'SearchByPhoneNumber') {
        $customer_phone = $common->clean_string($_POST['phone'] ?? '');
        $result         = $common->find('customer', ['phone' => $customer_phone], 'one');
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}

// ─── Task: save order (no IMEI cut) ──────────────────────────────────────────
if ($task === 'save') {
    header('Content-Type: application/json');
    if ($_POST) {
        $staff_id    = $common->clean_string($_POST['staffid']     ?? '');
        $branch_id   = $common->clean_string($_POST['branchid']    ?? '');
        $subtotal    = $common->clean_string($_POST['subtotal']    ?? '');
        $discount    = $common->clean_string($_POST['discount']    ?? '');
        $warrenty    = $common->clean_string($_POST['warrenty']    ?? '');
        $total       = $common->clean_string($_POST['total_all']   ?? '');
        $model_text  = $common->clean_string($_POST['model_text']  ?? '');
        $model_price = $common->clean_string($_POST['model_price'] ?? '');
        $customer    = json_decode($_POST['customer'] ?? '{}');
        $items       = json_decode($_POST['items']    ?? '[]');
        $result      = save_order_data_no_cuting($staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items);
        echo json_encode(['result' => $result]);
    }
    exit;
}

// ─── Task: history ────────────────────────────────────────────────────────────
if ($task === 'history') {
    $cus_id    = !empty($_GET['customer_id']) ? $_GET['customer_id'] : '';
    $date_from = !empty($_GET['from'])        ? $_GET['from']        : '';
    $date_to   = !empty($_GET['to'])          ? $_GET['to']          : '';

    $orders = listOrderByStaff($_SESSION['staff_id'] ?? 0, $cus_id, $date_from, $date_to, 30);
    (new SmartyPaginate)->setTotal($total_data > 0 ? $total_data : 1);
    (new SmartyPaginate)->setLimit(30);
    (new SmartyPaginate)->assign($smarty_appform);

    $smarty_appform->assign('list_order_data',    $orders);
    $smarty_appform->assign('list_customer_name', $common->find('customer', null, 'all'));
    $smarty_appform->display('order/staffActionHistory.tpl');
    exit;
}

// ─── Task: order_list ─────────────────────────────────────────────────────────
if ($task === 'order_list') {
    if ($action === 'view' && !empty($_GET['id'])) {
        $order = getListOrderItemData($_GET['id']);
        $smarty_appform->assign('list_orderItem_data', $order);
        $smarty_appform->assign('customer',  getCustomerById($order['customer_id'] ?? 0));
        $smarty_appform->assign('products',  getOrderItemByOrderId($order['id']    ?? 0));
        $smarty_appform->display('order/orderListTaskActionView.tpl');
        exit;
    }
    if ($action === 'printInvoice' && !empty($_GET['id'])) {
        $invoice_data = getListOrderItemData($_GET['id']);
        $invoivce_num = sprintf("%06d", $invoice_data['id'] ?? 0);
        $products     = getOrderItemByOrderId($invoice_data['id'] ?? 0);
        $smarty_appform->assign('customer',             getCustomerById($invoice_data['customer_id'] ?? 0));
        $smarty_appform->assign('products',             $products);
        $smarty_appform->assign('warrenty',             getWarrentyByOrderId($invoice_data['id'] ?? 0));
        $smarty_appform->assign('order_invoice_number', $invoivce_num);
        $smarty_appform->assign('product_count',        count($products));
        $smarty_appform->assign('invoice_data',         $invoice_data);
        $smarty_appform->display('order/receipt_1.tpl');
        exit;
    }
    if ($action === 'printInvoiceNoIme' && !empty($_GET['id'])) {
        $invoice_data = getListOrderItemData($_GET['id']);
        $invoivce_num = sprintf("%06d", $invoice_data['id'] ?? 0);
        $smarty_appform->assign('customer',             getCustomerById($invoice_data['customer_id'] ?? 0));
        $smarty_appform->assign('products',             getOrderItemByOrderIdNoImei($invoice_data['id'] ?? 0));
        $smarty_appform->assign('warrenty',             getWarrentyByOrderId($invoice_data['id'] ?? 0));
        $smarty_appform->assign('order_invoice_number', $invoivce_num);
        $smarty_appform->assign('invoice_data',         $invoice_data);
        $smarty_appform->display('order/receipt_noime.tpl');
        exit;
    }
}

// ─── Default: show no-IMEI order page ────────────────────────────────────────
$smarty_appform->display('order/product_order_no_imei.tpl');
exit;
