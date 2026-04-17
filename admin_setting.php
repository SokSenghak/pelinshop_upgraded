<?php
// Load core libraries
require_once dirname(__FILE__) . '/internal_libs/database.class.php';
require_once dirname(__FILE__) . '/internal_libs/validate.class.php';
require_once dirname(__FILE__) . '/internal_libs/common.class.php';
require_once dirname(__FILE__) . '/external_libs/thumbnail.php';
require_once dirname(__FILE__) . '/external_libs/smarty-4.1.0/libs/SmartyPaginate.class.php';
require_once dirname(__FILE__) . '/src/admin/functions_admin.php';

// Common instance
$common = new common();

// ─── Request parameters (PHP 8: use null coalescing to avoid undefined warnings) ─
$task      = !empty($_GET['task'])      ? $_GET['task']      : null;
$action    = !empty($_GET['action'])    ? $_GET['action']    : null;
$lang      = !empty($_GET['lang'])      ? $_GET['lang']      : null;
$kwd       = !empty($_GET['kwd'])       ? $_GET['kwd']       : null;
$maker     = !empty($_GET['maker'])     ? $_GET['maker']     : null;
$branch_id = !empty($_GET['branch_id']) ? $_GET['branch_id'] : null;
$brand     = !empty($_GET['brand'])     ? $_GET['brand']     : null;

// ─── Smarty ───────────────────────────────────────────────────────────────────
$smarty_appform = new SHOP_SMARTY();
$smarty_appform->assign('smpaginate',  'common/paginate.tpl');
$smarty_appform->assign('mode',        'admin');
$smarty_appform->assign('admin_file',  $admin_file);
$smarty_appform->assign('admin_file_name', $admin_file);
$smarty_appform->assign('index_file',  $admin_file);
$smarty_appform->assign('shop_site',   $shop_site);

// ─── Pagination ───────────────────────────────────────────────────────────────
if (empty($_SESSION['task']))   $_SESSION['task']   = $task;
if (empty($_SESSION['action'])) $_SESSION['action'] = $action;
if (empty($_SESSION['kwd']))    $_SESSION['kwd']    = $kwd;

if ($_SESSION['task'] !== $task)                                                                          (new SmartyPaginate)->disconnect();
if (($_SESSION['task'] === $task) && ($_SESSION['action'] !== $action))                                   (new SmartyPaginate)->disconnect();
if (($_SESSION['task'] === $task) && ($_SESSION['action'] === $action) && $_SESSION['kwd'] !== $kwd)      (new SmartyPaginate)->disconnect();

(new SmartyPaginate)->disconnect();
(new SmartyPaginate)->connect();
(new SmartyPaginate)->setLimit($limit);

if ((new SmartyPaginate)->getCurrentIndex()) $offset = (new SmartyPaginate)->getCurrentIndex();
if ((new SmartyPaginate)->getLimit())        $limit  = (new SmartyPaginate)->getLimit();

// Build and set pagination URL (strip existing 'next' param)
$urlq = $_SERVER['QUERY_STRING'] ?? '';
$urlq = preg_replace('/(&|^)next=\d+/', '', $urlq);
(new SmartyPaginate)->setUrl('?' . ltrim($urlq, '&'));
// ─── End Pagination ───────────────────────────────────────────────────────────

$total_data = null;
$error      = '';

// ─── Database connection ──────────────────────────────────────────────────────
$database_connect = new database(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
$database_connect->debug = $debug;
$connected = $database_connect->_Connect;

if (!$connected instanceof PDO) {
    http_response_code(500);
    $message = 'Database connection failed. Check DB_HOSTNAME, DB_USER, DB_PASSWORD, and DB_DATABASE_NAME in setup.php.';
    if (!empty($database_connect->lastError)) {
        $message .= ' PDO error: ' . $database_connect->lastError;
    }
    exit($message);
}
