<?php
ini_set('display_errors', '0');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once('setup.php');
require_once('admin_setting.php');
//task: login
if('login' === $task) {
  $error = array();
  if($_POST) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
      $staff = $common->find('staff', $condition = ['name' => $_POST['username'], 'password' => $_POST['password']], $type = 'one');
      if(!empty($staff)) {
        if($staff['is_quited'] == 1) $error['login'] = 1;
        if(count($error) === 0) {
			      $_SESSION['is_staff_login']  = $staff['id'];
			      $_SESSION['is_staff_branch'] = $staff['branch_id'];
            $_SESSION['is_login_role']   = $staff['role'];
            $_SESSION['is_login'] = ($staff['name'] === 'admin') ? 'admin' : $staff['name'];
          	header('location:'.$admin_file);
          	exit;
        }
      }
      $error['login'] = 1;
    }
  }
  $smarty_appform->assign('error', $error);
  $smarty_appform->display('admin/login.tpl');
  exit;
}
//task: no permission to alert message no permission if no authorize...
if('no_permission' === $task) { 
  $smarty_appform->display('admin/permission.tpl'); 
  exit;
}
//task logout
if('logout' === $task) {
  $_SESSION['is_login'] = '';
  unset($_SESSION['is_login']);
  header('location:'.$admin_file.'?task=login');
  exit;
}

$permission_url = getStaffPermissionData($_SESSION['is_login_role']);
$smarty_appform->assign('staffPermission', $permission_url);
//clear session
if(empty($_SESSION['is_login'])) { header('location:'.$admin_file.'?task=login'); exit; }
//check permission;

// if($_SESSION['is_login'] === 'data_entry') 
// {
//   $task_permission = array("product", "product_note");
//   if(!empty($task)) {
//     if (!in_array($task, $task_permission))
//     {
//       header('location:'.$admin_file.'?task=no_permission'); exit;
//     }
//   }
// }

############# task ###############
########## Authentication ########
##################################
$permission = Authentication($_SESSION['is_login_role'], $task, '');
if(!empty($task) && false === $permission)
{
    //Check: If ajax request
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        header('Content-type: application/json');
        echo json_encode(array('permission' => false));
        exit;
    }
    header('location:'.$index_file_name.'?task=no_permission');
    exit;
}

//Task Permision
if('permission' === $task)
{
  //action: add & edit
  $error = array();
  if($action === 'status' && !empty($_GET['id'])) {
    $status = $_GET['status'] ?? '';
    $common->update('task_permission', $field = ['status' => $status], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=permission');
    exit;
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $role = getPermissionData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_permission_data', $role);
  $smarty_appform->display('admin/alow_permission.tpl');
  exit;
}
//Task Role
if('role' === $task)
{
  if($action === 'add')
  {
    //action: add & edit
    $error = array();
    if($_POST) 
    {
      $role_name = $common->clean_string($_POST['role']);
      $task      = $_POST['task'] ?? [];
        
      if(empty($role_name))  $error['role_name'] = 1;
      if(COUNT($task) == 0)  $error['task'] = 1;
      
      if(empty($_POST['id']) && !empty($role_name) && COUNT($task) > 0) 
      {
        $role_id = $common->save('role', $field = ['name' => $role_name]);
        foreach ($task as $key => $value) {
          $common->save('staff_permission', $field = ['staff_role_id'=> $role_id,'staff_function_id' => $value]);
        }
        header('location:'.$admin_file.'?task=role');
        exit;
      }
    }
    $smarty_appform->assign('error', $error);
    $smarty_appform->assign('list_function', $common->find('staff_function', $where = [''], $type = 'all'));
    $smarty_appform->assign('list_role_data', $role);
    $smarty_appform->display('admin/role_add.tpl');
    exit;
  }
  if($action === 'edit')
  {
    //action: add & edit
    $error = array();
    if($_POST) 
    {
      $role_name = $common->clean_string($_POST['role']);
      $task      = $_POST['task'] ?? [];
        
      if(empty($role_name))  $error['role_name'] = 1;
      if(COUNT($task) == 0)  $error['task'] = 1;
      //edit role_name information
      if(!empty($_GET['id']) && !empty($role_name)) 
      {
        editDataInfo('role', $_GET['id'], 'name', $role_name);
        $common->delete('staff_permission', $condition = ['staff_role_id' => $_GET['id']]);
        foreach ($task as $key => $value) 
        {
          $common->save('staff_permission', $field = ['staff_role_id'=> $_GET['id'],'staff_function_id' => $value]);
        }
        header('location:'.$admin_file.'?task=role');
        exit;
      }
      
    }
    $smarty_appform->assign('error', $error);
    $smarty_appform->assign('list_function', $common->find('staff_function', $where = [''], $type = 'all'));
    $smarty_appform->assign('role', getDataById('role', $_GET['id']));
    $smarty_appform->assign('list_role_data', $role);
    $smarty_appform->display('admin/role_edit.tpl');
    exit;
  }
  //action: delete branch by id
  if($action === 'delete' && !empty($_GET['id'])) {
    $staff = $common->find('staff', $condition = ['role' => $_GET['id']], $type = 'one');
    if($staff == false){
      deleteDataById('role', $_GET['id']);
      $common->delete('staff_permission', $condition = ['staff_role_id' => $_GET['id']]);
      header('location:'.$admin_file.'?task=role');
      exit;
    }else{
      $error['existed_data'] = 1;
    }
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $role = getroleData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_role_data', $role);
  $smarty_appform->display('admin/role.tpl');
  exit;
}
//task staff
if('staff' === $task) 
{
  //action: add new staff
  $error = array();
  if($_POST) {
    $staff_name = $common->clean_string($_POST['staff_name']);
    $staff_role = $common->clean_string($_POST['role']);
    $staff_password = $common->clean_string($_POST['staff_password']);
    $branch_id  = $common->clean_string($_POST['branch_id']);
    $staff_id   = $common->clean_string($_POST['staff_id'] ?? '');
    if(empty($staff_role)) $error['role'] = 1;
    if(empty($branch_id)) $error['brand'] = 1;
    if(empty($staff_name))  $error['staff_name'] = 1;
    if(empty($staff_password))  $error['staff_password'] = 1;

    // add new staff information
    if(count($error) === 0 && empty($staff_id)) {
      $common->save('staff', $field = ['name' => $staff_name,'password' => $staff_password, 'branch_id' => $branch_id, 'role'=> $staff_role]);
      header('location:'.$admin_file.'?task=staff');
      exit;
    }
    // edit staff information
    if(count($error) === 0 && !empty($staff_id))
    {
      $common->update('staff',
        $field = ['name' => $staff_name,'password' => $staff_password, 'branch_id' => $branch_id, 'role'=> $staff_role],
        $condition = ['id' => $staff_id]
      );
      header('location:'.$admin_file.'?task=staff');
      exit;
    }
  }
  //action: edit staff information
  if($action === 'edit' && !empty($_GET['id']))  { $smarty_appform->assign('staff', getDataById('staff', $_GET['id']));   }
  //action: staff resign
  if('resign' === $action) {
    // update status is_quited = 1
    $common->update('staff', $field = ['deleted_at' => date('Y-m-d H:i:s')], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=staff');
    exit;
  }
  //action: quit staff
  if($action === 'stop') {
    // update status is_quited = 1
    $common->update('staff', $field = ['is_quited' => 1], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=staff');
    exit;
  }
  //action: staff start work again
  if($action === 'start') {
    // update status is_quited = 0 that allow to work
    $common->update('staff', $field = ['is_quited' => 0], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=staff');
    exit;
  }
  //action: history of staff
  if($action === 'history' && !empty($_GET['id'])) 
  {
    $orders = listOrderByStaff($_GET['id'], '', '', '', 30);
    if($total_data > 0) {
      (new SmartyPaginate)->setTotal($total_data);
    } else {
      (new SmartyPaginate)->setTotal(1);
    }
    //index of customer
    $geturl = '?task='.$task.'&action='.$action.'&id='.$_GET['id'].'&kwd='.urlencode($kwd);
    (new SmartyPaginate)->setUrl($geturl);
    (new SmartyPaginate)->assign($smarty_appform);
    $smarty_appform->assign('list_order_data', $orders);
    $smarty_appform->assign('staff', getOrderStaffInfo($_GET['id']));
    $smarty_appform->display('admin/staffActionHistory.tpl');
    exit;
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $staff= getStaffData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of staff
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_staff_data', $staff);
  $smarty_appform->assign('list_branch_name', getListName('branch'));
  $smarty_appform->assign('list_role_name', getListName('role'));
  $smarty_appform->display('admin/staffTask.tpl');
  exit;
}
//task customer
if('customer' === $task)  {

  if($action === 'stopped')
  {
    // update status= 2
    $common->update('customer', $field = ['status' => 2], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=customer');
    exit;
  }
  //action: Edit Customer
  if($action === 'edit') 
  {
    $error       = array();
    if($_POST){
      $id          = $common->clean_string($_POST['_id']);
      $name        = $common->clean_string($_POST['name']);
      $phone       = $common->clean_string($_POST['phone']);
      $idnumber    = $common->clean_string($_POST['idnumber']);
      $email       = $common->clean_string($_POST['email']);
      $address     = $common->clean_string($_POST['address']);
      //validate form
      if(empty($name)) $error['name'] = 1;
      if(empty($phone)) $error['phone'] = 1;
      $old_cust = getDataById('customer', $id);
	    if(!empty($phone) && $old_cust['phone'] !== $phone && (checkPhoneExisted($phone) > 0)) 
      {
        $error['phone']  = 2;
      }
      //if error eqaul zero 
      if(count($error) == 0)
      {
        $field = ['name' => $name, 'phone' => $phone, 'idnumber' => $idnumber, 'email'=> $email, 'address' => $address];
        $common->update('customer', $field , $condition = ['id' => $id]);
        header('location:'.$admin_file.'?task=customer');
        exit;
      }
    }
   if(!empty($_GET['id'])){
      $getDataById = getDataById('customer', $_GET['id']);
      $smarty_appform->assign('edit', $getDataById);
   }
   $smarty_appform->assign('error', $error);
   $smarty_appform->display('admin/customerActionEdit.tpl');
   exit;
  }
  //action: history of customer
  if($action === 'history' && !empty($_GET['id']))  {
    $orders = listOrderByCustomer($_GET['id']);
    if($total_data > 0) {
      (new SmartyPaginate)->setTotal($total_data);
    } else {
      (new SmartyPaginate)->setTotal(1);
    }
    //index of customer
    $geturl = '?task='.$task.'&action='.$action.'&id='.$_GET['id'].'&kwd='.urlencode($kwd);
    (new SmartyPaginate)->setUrl($geturl);
    (new SmartyPaginate)->assign($smarty_appform);
    $smarty_appform->assign('staff', getOrderStaffInfo($_GET['id']));
    $smarty_appform->assign('list_order_data', $orders);
    $smarty_appform->assign('list_customer_data', getDataById('customer', $_GET['id']));
    $smarty_appform->display('admin/customerActionHistory.tpl');
    exit;
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $customer = getCustomerData($kwd, 30);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of customer
  (new SmartyPaginate)->setLimit(30);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('list_customer_data', $customer);
  $smarty_appform->display('admin/customerTask.tpl');
  exit;
}
//task product
if('product_history' === $task) 
{
	if('update_cost' === $action) {
		$error = array();
		$storage_id =   $common->clean_string($_POST['storage_id']);
		$color_id   =   $common->clean_string($_POST['color_id']);
		$maker_id   =   $common->clean_string($_POST['maker_id']);
		$company_title =   $common->clean_string($_POST['company_title']);
		$product_title =   $common->clean_string($_POST['product_title']);
		$date_from  =   $common->clean_string($_POST['date_from']);
		$date_to   	=   $common->clean_string($_POST['date_to']);
		$cost   	=   $common->clean_string($_POST['cost']);

		if(empty($storage_id)) $error['storage_id'] = 1;
		if(empty($color_id)) $error['color_id'] = 1;
		if(empty($maker_id)) $error['maker_id'] = 1;
		if(empty($company_title)) $error['company_title'] = 1;
		if(empty($product_title)) $error['product_title'] = 1;
		if(empty($date_from)) $error['date_from'] = 1;
		if(empty($date_to)) $error['date_to'] = 1;
		if(empty($cost)) $error['cost'] = 1;
		
		if(COUNT($error) == 0)
		{
			$result = updateProductCostByCompany($storage_id, $color_id, $maker_id, $company_title, $product_title, $cost, $date_from, $date_to);
			
			if($result) {
				header('location:'.$admin_file.'?task=product_history&from='.$date_from.'&to='.$date_to);
				exit;
			}
		}
	}
	if('print' === $action)
	{
		//search & pagination
		$kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
		$branch_id = (!empty($_GET['branch_id'])) ? $_GET['branch_id'] : '';
		$pr_st_id = (!empty($_GET['pr_st_id'])) ? $_GET['pr_st_id'] : '';
		$maker = (!empty($_GET['maker'])) ? $_GET['maker'] : '';
		$brand = (!empty($_GET['brand'])) ? $_GET['brand'] : '';
		$from = (!empty($_GET['from'])) ? $_GET['from'] : '';
		$to = (!empty($_GET['to'])) ? $_GET['to'] : '';

		if(empty($from)) $from = date("Y-m-d");
		if(empty($to)) $to = date("Y-m-d");

		$resultPHistory = reportProductHistory($branch_id, $pr_st_id, $from, $to, $slimit=30);

		if($total_data > 0) {
			(new SmartyPaginate)->setTotal($total_data);
		} else {
			(new SmartyPaginate)->setTotal(1);
		}
		//index of product
		(new SmartyPaginate)->setLimit(30);
		(new SmartyPaginate)->assign($smarty_appform);
		$smarty_appform->assign('list_product_history', $resultPHistory);
		$smarty_appform->assign('from_date', $from);
		$smarty_appform->assign('to_date', $to);
		$smarty_appform->display('admin/productTaskHistory_print.tpl');
		exit;
	}

	//search & pagination
	$kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
	$branch_id = (!empty($_GET['branch_id'])) ? $_GET['branch_id'] : '';
	$pr_st_id = (!empty($_GET['pr_st_id'])) ? $_GET['pr_st_id'] : '';
	$maker = (!empty($_GET['maker'])) ? $_GET['maker'] : '';
	$brand = (!empty($_GET['brand'])) ? $_GET['brand'] : '';
	$from = (!empty($_GET['from'])) ? $_GET['from'] : '';
	$to = (!empty($_GET['to'])) ? $_GET['to'] : '';
  $tab = !empty($_GET['tab']) ? $_GET['tab'] : 1;

	if(empty($from)) $from = date("Y-m-d");
	if(empty($to)) $to = date("Y-m-d");
  if($tab == 2){
    $resultPHistory = reportProductHistoryNoCutting($branch_id, $pr_st_id, $from, $to, $slimit=30);
  }else{
    $resultPHistory = reportProductHistory($branch_id, $pr_st_id, $from, $to, $slimit=30);
  }

	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}
	//index of product
	(new SmartyPaginate)->setLimit(30);
	(new SmartyPaginate)->assign($smarty_appform);
	$smarty_appform->assign('list_product_history', $resultPHistory);
	$smarty_appform->assign('from_date', $from);
	$smarty_appform->assign('to_date', $to);
	$smarty_appform->display('admin/productTaskHistory.tpl');
	exit;
}
//task product
if('product' === $task) 
{
  //action: add product
  if($action === 'add')   
  {
    $error = array();
    if($_POST) 
    {
      $imei   =   $common->clean_string($_POST['imei']);
      $title  =   $common->clean_string($_POST['titles']);
      $company_id  =   $common->clean_string($_POST['company_id']);
      $storages =  $common->clean_string($_POST['storages_']);
      $colors =   $common->clean_string($_POST['colors_']);
      $cost   =   $common->clean_string($_POST['cost']);
      $price  =   $common->clean_string($_POST['price']);
      $brand  =   $common->clean_string($_POST['brand_id']);
      $maker  =   $common->clean_string($_POST['maker_id']);
      $pro_used_id =   $common->clean_string($_POST['pro_used_id']);
      $desc   =   $common->clean_string($_POST['desc']);
      $branch =   $common->clean_string($_POST['branch']);
      $check_serial = $common->clean_string($_POST['check_serial']);
      $is_cutting = $common->clean_string($_POST['is_cutting']);
      if(empty($is_cutting)) $is_cutting = 1;

      if(empty($imei))      $error['imei']  = 1;
      // if(!empty($imei) && strlen($imei) < 15) $error['imei'] = 2;
      if(!empty($imei) && (checkImeiExisted($imei) > 0))  $error['imei']  = 3;
      // if(!empty($imei) && !preg_match("/^[0-9]+$/", $imei)) $error['imei'] = 4;
      if(empty($title))     $error['title'] = 1;
      if(empty($company_id)) $error['company_id'] = 1;
      // if(empty($cost))      $error['cost']  = 1;
      if(empty($price))     $error['price'] = 1;
      if(empty($brand))     $error['brand'] = 1;
      if(empty($maker))     $error['maker'] = 1;
      
      if(!empty($imei) && $check_serial != 1 && strlen($imei) < 15) $error['minlenght'] = 1;
		
      $_SESSION['sproduct'] = $_POST;
      if(count($error) == 0) {
        header('location:'.$admin_file.'?task=product&action=confirm');
        exit;
      }
	  }
    // exit;
    $smarty_appform->assign('error', $error);
    $smarty_appform->assign('list_product_title', getListName('product_title'));
    $smarty_appform->assign('list_storage_name', getListName('product_storage'));
    $smarty_appform->assign('list_color_name', getListName('product_color'));
    $smarty_appform->assign('list_maker_name', getListName('maker'));
    $smarty_appform->assign('list_brand_name', getbrandData('', ''));
    $smarty_appform->assign('list_product_used', getListName('product_used'));
    $smarty_appform->assign('list_branch', getBranchData(''));
    $smarty_appform->assign('list_company_name', getListName('company'));
    $smarty_appform->display('admin/productActionAdd.tpl');
    exit;
  }
  //action: confirm product
  if($action === 'confirm') {
  
    $smarty_appform->assign('list_product_title', getListName('product_title'));
    $smarty_appform->assign('list_storage_name', getListName('product_storage'));
    $smarty_appform->assign('list_color_name', getListName('product_color'));
    $smarty_appform->assign('list_maker_name', getListName('maker'));
    $smarty_appform->assign('list_brand_name', getListName('brand'));
    $smarty_appform->assign('list_product_used', getListName('product_used'));
    $smarty_appform->assign('list_branch', getBranchData(''));
    $smarty_appform->assign('list_company_name', getListName('company'));
    $smarty_appform->display('admin/productActionConfirm.tpl');
    exit;
  }
  //action: completed prodcut
  if($action === 'completed') {
    if(!empty($_SESSION['sproduct'])) {
      $imei   =   $common->clean_string($_SESSION['sproduct']['imei']);
      $title  =   $common->clean_string($_SESSION['sproduct']['titles']);
      $company_id  =   $common->clean_string($_SESSION['sproduct']['company_id']);
      $storages  =   $common->clean_string($_SESSION['sproduct']['storages_']);
      $colors    =   $common->clean_string($_SESSION['sproduct']['colors_']);
      $cost   =   $common->clean_string($_SESSION['sproduct']['cost']);
      $price  =   $common->clean_string($_SESSION['sproduct']['price']);
      $brand  =   $common->clean_string($_SESSION['sproduct']['brand_id']);
      $maker  =   $common->clean_string($_SESSION['sproduct']['maker_id']);
      $desc   =   $common->clean_string($_SESSION['sproduct']['desc']);
      $branch =   $common->clean_string($_SESSION['sproduct']['branch']);
      $pro_used_id = $common->clean_string($_SESSION['sproduct']['pro_used_id']);
      $is_cutting = $common->clean_string($_SESSION['sproduct']['is_cutting']);
      if(empty($is_cutting)) $is_cutting = 1;
      $rsCom = getDataById('company', $company_id);
      $company_title = $rsCom['name'];
      $product_title =  $common->find('product_title', $condition = ['id' => $title], $type = 'one');
      $field = [
        'imei'            => $imei,
        'title'           => $product_title['name'],
        'company_id'      => $company_id,
        'company_title'   => $company_title,
        'storage_id'      => $storages,
        'color_id'        => $colors,
        'stock'           => 1,
        'cost'            => $cost,
        'price'           => $price,
        'maker_id'        => $maker,
        'brand_id'        => $brand,
        'product_used_id' => $pro_used_id,
        'description'     => $desc,
        'is_cutting'      => $is_cutting,
        'created_at'      => date('Y-m-d H:i:s')
    ];
    $product_id = $common->save('product', $field);
    
    if($is_cutting == 2){
      $field = ['product_id' => $product_id, 'stock' => 1, 'created_at' => date('Y-m-d H:i:s'), 'status' => 1];
      $common->save('activity_product', $field);
    }
      if(!empty($branch)){
        $field = ['product_id' => $product_id, 'branch_id' => $branch];
        $common->save('product_branch', $field);
      }
      unset($_SESSION['sproduct']);
      header('location:'.$admin_file.'?task=product');
      exit;
    }
  }
  //action: view product
  if($action === 'view' && !empty($_GET['id'])) {
    $smarty_appform->assign('list_product_name', getDataById('product', $_GET['id']));
    $smarty_appform->assign('list_storage_name', getListName('product_storage'));
    $smarty_appform->assign('list_color_data', getListName('product_color'));
    $smarty_appform->assign('list_maker_name', getListName('maker'));
    $smarty_appform->assign('list_brand_name', getListName('brand'));
    $smarty_appform->display('admin/productActionView.tpl');
    exit;
  }
  //action: upload product
  if($action === 'upload' && !empty($_GET['id']))  {
    $error = array();
    if($_POST) {
      if(empty($_FILES['photo']['name']))    $error['no_image'] = 1;
      if($_FILES['photo']['size'] > $allows['SIZE'][0])  $error['size'] = 1;
      if(!empty($_FILES['photo']['name']) && !in_array($_FILES['photo']['type'], $allows['TYPE']['image']))    $error['type'] = 1;
      if(count($error) === 0 && !empty($_GET['id'])) {
        $photo = $common->uploadFile($_FILES, time(), PRODUCT_IMAGE_PATH, 'photo');
        if($_FILES['photo']['error'] > 0)  $error['error'] = 1;
        //Generate thumbnail
        $images = new Zubrag_image;
        $images->max_x        = $thumbnail_width;
        $images->max_y        = $thumbnail_height;
        $images->save_to_file = 1;
        $images->image_type   = '-1';
        $thumbnail_image = PRODUCT_IMAGE_PATH.'thumbnail__'.$photo;
        $images->GenerateThumbFile(PRODUCT_IMAGE_PATH.$photo, $thumbnail_image);
        $old_photo = $common->find('product', $condition = ['id' => $_GET['id']], $type = 'one');
        if($old_photo['photoone'] && file_exists(PRODUCT_IMAGE_PATH.$old_photo['photoone'])) {
          unlink(PRODUCT_IMAGE_PATH.$old_photo['photoone']);
          unlink(PRODUCT_IMAGE_PATH.'thumbnail__'.$old_photo['photoone']);
        }
        //update filename in product table
        $common->update('product', $field = ['photoone' => $photo], $condition = ['id' => $_GET['id']]);
        header('location:'.$admin_file.'?task=product');
        exit;
      }
    }
    $smarty_appform->assign('error', $error);
    $smarty_appform->assign('product_id', $_GET['id']);
    $smarty_appform->display('admin/productActionUpload.tpl');
    exit;
  }
  //action: edit product
  if($action === 'edit' && !empty($_GET['id'])) {
    
    $error = array();
    if($_POST) 
    {
      $imei   = $common->clean_string ($_POST['imei']);
      $title  = $common->clean_string ($_POST['titles']);
      $company_id = $common->clean_string ($_POST['company_id']);
      $storages =  $common->clean_string($_POST['storages_']);
      $colors =   $common->clean_string($_POST['colors_']);
      $cost   = $common->clean_string ($_POST['cost']);
      $price  = $common->clean_string ($_POST['price']);
      $brand  = $common->clean_string ($_POST['brand_id']);
      $maker  = $common->clean_string ($_POST['maker_id']);
      $desc   = $common->clean_string ($_POST['desc']);
      $branch = $common->clean_string ($_POST['branch']);
      $pro_used_id = $common->clean_string ($_POST['pro_used_id']);
      // $is_cutting = $common->clean_string($_POST['is_cutting']);
      // if(empty($is_cutting)) $is_cutting = 1;
      if (empty($imei))   $error['imei']  = 1;
      // if (strlen ($imei) < 15) $error['imei'] = 2;
      if (empty($title))  $error['title'] = 1;
      if (empty($company_id))  $error['company_id'] = 1;
      // if (empty($cost))   $error['cost']  = 1;
      if (empty($price))  $error['price'] = 1;
      if (empty($brand))  $error['brand'] = 1;
      if (empty($maker))  $error['maker'] = 1;
	  $oldPro = $common->find('product', $condition = ['id' => $_GET['id']], $type = 'one');
	  if(!empty($imei) && $oldPro['imei'] !== $imei && (checkImeiExisted($imei) > 0)) $error['imei']  = 3;
      $_SESSION['sproduct'] = $_POST;
      $rsCom = getDataById('company', $company_id);
      $company_title = $rsCom['name'];
      $product_title =  $common->find('product_title', $condition = ['id' => $title], $type = 'one');
      // echo $product_title['name']; exit;
      if(count($error) == 0) {
          $field = [
            'imei'            => $imei,
            'title'           => $product_title['name'],
            'company_id'      => $company_id,
            'company_title'   => $company_title,
            'storage_id'      => $storages,
            'color_id'        => $colors,
            'stock'           => 1,
            'cost'            => $cost,
            'price'           => $price,
            'maker_id'        => $maker,
            'brand_id'        => $brand,
            'product_used_id' => $pro_used_id,
            'description'     => $desc,
            // 'is_cutting'      => $is_cutting,
            'created_at'      => date('Y-m-d H:i:s')
        ];
        $common->update('product', $field , $condition = ['id' => $_GET['id']]);
        if(!empty($branch)){
          $oldProBranch = $common->find('product_branch', $condition = ['product_id' => $_GET['id']], $type = 'one');
          if(!empty($oldProBranch)){
            $field = ['branch_id'      => $branch];
            $common->update('product_branch', $field, $condition = ['product_id' => $_GET['id']]);
          }else{
            $field = ['product_id' => $_GET['id'], 'branch_id' => $branch];
            $common->save('product_branch', $field);
          }
        } else {
          $common->delete('product_branch', $condition = ['product_id' => $_GET['id']]);
        }
        unset($_SESSION['sproduct']);
        header('location:'.$admin_file.'?task=product');
        exit;
      }
    }
    $datas = getProductDataById($_GET['id']);

    if ( is_numeric($datas['imei']) ) {
      $_SESSION['imei_type'] = 1;
    } else {
      $_SESSION['imei_type'] = 2;
    }
    $smarty_appform->assign('error', $error);
    $smarty_appform->assign('list_product_title', getListName('product_title'));
    $smarty_appform->assign('list_product_data',  $datas);
    $smarty_appform->assign('list_storage_name', getListName('product_storage'));
    $smarty_appform->assign('list_color_name', getListName('product_color'));
    $smarty_appform->assign('list_maker_name', getListName('maker'));
    $smarty_appform->assign('list_brand_name', getListName('brand'));
    $smarty_appform->assign('list_product_used', getListName('product_used'));
    $smarty_appform->assign('list_branch', getBranchData(''));
    $smarty_appform->assign('product_branch', $common->find('product_branch', $condition = ['product_id' => $_GET['id']], $type = 'one'));
    $smarty_appform->assign('list_company_name', getListName('company'));
    $smarty_appform->display('admin/productActionEdit.tpl');
    exit;
  }
  //action: delete product
  if($action === 'delete' && !empty($_GET['id'])) {
    $photo = $common->find('product', $condition = ['id' => $_GET['id']], $type = 'one');
    if($photo['photoone'] && file_exists(PRODUCT_IMAGE_PATH.$photo['photoone'])) {
      unlink(PRODUCT_IMAGE_PATH.$photo['photoone']);
      unlink(PRODUCT_IMAGE_PATH.'thumbnail__'.$photo['photoone']);
    }
    $common->delete('product', $condition = ['id' => $_GET['id']]);
    $common->delete('product_branch', $condition = ['product_id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=product');
    exit;
  }
  //action: print qrcode product
  if($action === 'print')
  {

    $smarty_appform->assign('list_product_data', getProductDataById($_GET['id']));
    $smarty_appform->display('admin/print_qrcode_product.tpl');
    exit;
  }
  if($action === 'all_qrcode_print')
  {
    $num_blank = $common->clean_string($_GET['num_print']);
    $pro_id = '';
    $i = 0;
    foreach ($_SESSION['pro_id'] as $k => $va)
    {
      if($i == 0)
      {
        $pro_id .= $va;
      } else {
        $pro_id .= ','.$va;
      }
      $i += 1;
    }
    if($pro_id) {
      $product = getListProduct($kwd='', $branch_id='', $maker='', $brand='', $pro_id, $num_blank, '', '', $from='', $to='');
    } else {
      $product = array();
    }

    $smarty_appform->assign('list_product_data', $product);
    $smarty_appform->display('admin/print_qrcode_all_product.tpl');
    exit;
  }
  //action: detail product
  if($action === 'detail')
  {
    $smarty_appform->assign('list_product_data', getProductDataById($_GET['id']));
    $smarty_appform->display('admin/productActionDetail.tpl');
    exit;
  }

  if('return_back' === $action)
  {
    $common->update('product', $field = ['status'  => 2, 'status_date' => date('Y-m-d')], $condition = ['id' => $_GET['id']]);
    header('location:'.$admin_file.'?task=product');
    exit;
  }

  if('data_print' === $action)
  {
    if (!isset($_SESSION['pro_id'])) $_SESSION['pro_id'] = array();

    if($_POST)
    {
      $status  =  $common->clean_string($_POST['status']);
      $product_id  =  $common->clean_string($_POST['product_id']);

      if($status == 1)
      {
        unset($_SESSION['pro_id'][$product_id]);
      } else if ($status == 2) {
        $_SESSION['pro_id'][$product_id] = $product_id;
      } else {
        unset($_SESSION['pro_id']);
      }
    }
    echo json_encode(COUNT($_SESSION['pro_id']));
    exit;
  }

  if('data_print_all' === $action)
  {
    if (!isset($_SESSION['pro_id'])) $_SESSION['pro_id'] = array();

    if($_POST)
    {
      $status  =  $common->clean_string($_POST['status']);
      $product_id  =  json_decode($_POST['product_id']);
      if($status == 1)
      {
        foreach ($product_id as $key => $value) {
          unset($_SESSION['pro_id'][$value]);
        }
      } else {
        foreach ($product_id as $key => $value) {
          $_SESSION['pro_id'][$value] = $value;
        }
      }
    }
    echo json_encode(COUNT($_SESSION['pro_id']));
    exit;
  }
  //action: clone product
  if('clone' === $action) {
    if($_POST) {
      header('Content-Type: application/json');
      $product_id = $common->clean_string($_POST['product_id']);
      $product_imei = $common->clean_string($_POST['product_imei']);
      $is_cutting = $common->clean_string($_POST['is_cutting']);
      if(empty($is_cutting)) $is_cutting = 1;
      $product_info = $common->find('product', $condition = ['id' => $product_id], $type = 'one' );
      $product_branch = $common->find('product_branch', $condition = ['product_id' => $product_id], $type = 'one' );
      if(checkImeiExisted($product_imei) > 0) {
        echo json_encode(array('product_id' => null));
        exit;
      }
      if($product_info['photoone']) {
        //get the last extension of filename from table
        $extension = end(explode('.', $product_info['photoone']));
        //get file information
        $fileInfo = pathinfo($product_info['photoone']);
        // add string "_clone" to new file name
        $photoone_clone = $fileInfo['filename'].'_clone.'.$extension;
        //create image file and thumbnail to the service
        copy(PRODUCT_IMAGE_PATH.$product_info['photoone'], PRODUCT_IMAGE_PATH.$photoone_clone);
        copy(PRODUCT_IMAGE_PATH.'thumbnail__'.$product_info['photoone'], PRODUCT_IMAGE_PATH.'thumbnail__'.$photoone_clone);
      }
      $field = [
        'imei'           => $product_imei,
        'title'          => $product_info['title'],
        'company_id'     => $product_info['company_id'],
        'company_title'  => $product_info['company_title'],
        'storage_id'     => $product_info['storage_id'],
        'color_id'       => $product_info['color_id'],
        'stock'          => $product_info['stock'],
        'cost'           => $product_info['cost'],
        'price'          => $product_info['price'],
        'maker_id'       => $product_info['maker_id'],
        'brand_id'       => $product_info['brand_id'],
        'product_used_id'=> $product_info['product_used_id'],
        'description'    => $product_info['description'],
        'is_cutting'     => $is_cutting,
        'photoone'       => $photoone_clone,
        'created_at'     => date('Y-m-d H:i:s')
      ];
    
      // Save new clone data to the `product` table
      $last_product_id = $common->save('product', $field);
      if(!empty($product_branch) && !empty($last_product_id)){
        $field = ['product_id' => $last_product_id, 'branch_id' => $product_branch['branch_id']];
        $common->save('product_branch', $field);

        if($is_cutting == 2){
          $field = ['product_id' => $last_product_id, 'stock' => 1, 'created_at' => date('Y-m-d H:i:s'), 'status' => 1];
          $common->save('activity_product', $field);
        }
      }
      echo ($last_product_id) ? json_encode($last_product_id) : json_encode(array('product_id' => null));
      exit;
    }
  }
  //action: increase stock product
  if('increase_stock' === $action) {
    if($_POST) {
      header('Content-Type: application/json');
      $product_id = $common->clean_string($_POST['product_id']);
      $stock = $common->clean_string($_POST['stock']);
      $product_info = $common->find('product', $condition = ['id' => $product_id], $type = 'one' );
      if(!empty($product_info)){
        $stock = isset($stock) ? floatval($stock) : 0;
        $productStock = isset($product_info['stock']) ? floatval($product_info['stock']) : 0;
        $increase = $stock + $productStock;

        $field = ['stock' => floatval($increase)];
        $common->update('product', $field , $conditon = ['id' => $product_id]);

        $field = ['product_id' => $product_id, 'stock' => $stock, 'created_at' => date('Y-m-d H:i:s'), 'status' => 1];
        $common->save('activity_product', $field);
      }
      echo ($product_info) ? json_encode($product_info) : json_encode(array('product_id' => null));
      exit;
    }
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $branch_id = (!empty($_GET['branch_id'])) ? $_GET['branch_id'] : '';
  $pr_st_id = (!empty($_GET['pr_st_id'])) ? $_GET['pr_st_id'] : '';
  $maker = (!empty($_GET['maker'])) ? $_GET['maker'] : '';
  $brand = (!empty($_GET['brand'])) ? $_GET['brand'] : '';
  $from = (!empty($_GET['from'])) ? $_GET['from'] : '';
  $to = (!empty($_GET['to'])) ? $_GET['to'] : '';
  $tab = !empty($_GET['tab']) ? $_GET['tab'] : 1;
  // $product = getProductData($kwd);
  $product = getListProduct($kwd, $branch_id, $maker, $brand, '', $num_blank='', 30, $pr_st_id, $from, $to, $tab);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of product
  (new SmartyPaginate)->setLimit(30);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('list_product_data', $product);
  $smarty_appform->assign('product_storage', $common->find('product_storage', $where = [''], $type = 'all'));
  $smarty_appform->assign('list_maker_name', getListName('maker'));
  $smarty_appform->assign('list_brand_name', getListName('brand'));
  $smarty_appform->assign('list_branch', getListName('branch'));
  $smarty_appform->assign('list_product_used', getListName('product_used'));
  $smarty_appform->display('admin/productTask.tpl');
  exit;
}

//task: getProduct to transfer
if('getProductTransfer' === $task) {
  header('Content-Type: application/json');
  if(isset($_POST['imei']) && '' !== $_POST['imei']) {
    $data = getProductTransfer($_POST['imei']);
    echo ($data) ? json_encode($data) : json_encode(array('imei' => null));
    exit;
  }
  exit;
}
//Transfer data by changing branch id
if('transfer' === $task) {
  header('Content-Type: application/json');
  if($_POST) {
    $branch_id = $common->clean_string($_POST['branch_id']);
    $product_items = json_decode($_POST['items']);
    $result = transferProduct($branch_id, $product_items);
    echo (!empty($result)) ? json_encode($result) : json_encode(array('imei' => null));
  }
    exit;
}
//task prodcut transfer
if('product_transfer' === $task) {
  $smarty_appform->assign('list_branch', getBranchToTransfer());
  $smarty_appform->display('admin/product_transfer_task_.tpl');
  exit;
}
//task product transfer
if('product_transfer_history' === $task) {
  //history detail
  if('detail' === $action && !empty($_GET['id'])) {
    $product_transfer_data =  getProductTransferHistoryByUniqueKey($_GET['id']);
    $smarty_appform->assign('product_transfer_data', $product_transfer_data);
    $smarty_appform->assign('product_transfer_history_detail', getProductTransferHistoryDetail($_GET['id']));
    $smarty_appform->display('admin/product_transfer_history_detail.tpl');
    exit;
  }

  //print report
  if('print' === $action && !empty($_GET['id'])) {
    $product_transfer_data =  getProductTransferHistoryByUniqueKey($_GET['id']);
    $product_transfer_history = getProductTransferHistoryForPrint($_GET['id']);
    $smarty_appform->assign('product_transfer_data', $product_transfer_data);
    $smarty_appform->assign('product_transfer_history', $product_transfer_history);
    $smarty_appform->display('admin/product_transfer_task_report.tpl');
    exit;
  }
  //search and pagination
  $branch_id = !empty($_GET['branch_id']) ? $_GET['branch_id'] : '';
  $product_transfer_data = getProductTransferHistory($branch_id, $unique_key = '', 30);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of product
  (new SmartyPaginate)->setLimit(30);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('product_transfer_data', $product_transfer_data);
  $smarty_appform->assign('list_branch', getBranchToTransfer());
  $smarty_appform->display('admin/product_transfer_history.tpl');
  exit;
}
//task product order
if('product_order' === $task) {
	// product return back, and remove order item data
	if('return' === $action && !empty($_POST['id']) && !empty($_POST['orid'])) {
		$id  	=   $common->clean_string($_POST['id']);
		$orid	=   $common->clean_string($_POST['orid']);
		// $note   =   $common->clean_string($_POST['note']);
		// // product return back
		// $common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $imei]);
		// //remove order item data
		// $common->update('order_item', $field = ['deleted_at' => date('Y-m-d H:i:s')], $conditon = ['imei' => $imei, 'order_id' => $or_id]);
		// //Save note
		// // $common->save('note', $field = ['imei' => $imei, 'order_id' => $or_id, 'note' => $note, 'date_in' => date('Y-m-d')]);
		// header('location:'.$admin_file.'?task=product_order');
		// exit;

		$rsorderItem = $common->find('order_item', $condiction = ['order_id' => $orid], $type = 'all');

		if(COUNT($rsorderItem) >= 2) 
		{
			$rsOrderP = $common->find('order', $condiction = ['id' => $orid], $type = 'one');
			$orItem = $common->find('order_item', $condiction = ['id' => $id], $type = 'one');

			$amount_left_subtotal = $rsOrderP['subtotal'] - $orItem['price'];
			$amount_left_total = $rsOrderP['total'] - $orItem['price'];

			$common->update('order', $field = ['subtotal' => $amount_left_subtotal, 'total' => $amount_left_total], $conditon = ['id' => $orid]);
			$common->delete('order_item', $condition = ['id' => $id]);
			$common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $orItem['imei']]);
		} else {
      		$orItem = $common->find('order_item', $condiction = ['id' => $id], $type = 'one');

			$common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $orItem['imei']]);
			$common->delete('order', $condition = ['id' => $orid]);
			$common->delete('order_item', $condition = ['id' => $id]);
		}
		header('location:'.$admin_file.'?task=product_order');
		exit;
	}
  // return to stock after pay already
  if('return_to_Stock' === $action && !empty($_POST['id']) && !empty($_POST['orid'])) {
		$id  	=   $common->clean_string($_POST['id']);
		$orid	=   $common->clean_string($_POST['orid']);
    $rsorderItem = $common->find('order_item', $condiction = ['order_id' => $orid], $type = 'all');

    $orItem = $common->find('order_item', $condiction = ['id' => $id], $type = 'one');
    $common->update('order_item', $field = ['returned' => 2], $conditon = ['imei' => $orItem['imei']]);
    $common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $orItem['imei']]);
		header('location:'.$admin_file.'?task=product_order');
		exit;
	}
	// product return back, and remove order item data
	if('update_cost' === $action && !empty($_POST['imei']) && !empty($_POST['id'])) 
	{
		$error = array();
		$or_id  =   $common->clean_string($_POST['id']);
		$imei   =   $common->clean_string($_POST['imei']);
		$cost   =   $common->clean_string($_POST['cost']);

		if(empty($cost)) $error['cost'] = 1;
		
		if(COUNT($error) == 0){
			// product return back
			$common->update('product', $field = ['cost' => $cost], $conditon = ['imei' => $imei]);
			//remove order item data
			$reOrItem = $common->update('order_item', $field = ['cost' => $cost], $conditon = ['imei' => $imei, 'order_id' => $or_id]);
		}
		//Save note
		// $common->save('note', $field = ['imei' => $imei, 'order_id' => $or_id, 'note' => $note, 'date_in' => date('Y-m-d')]);
		header('location:'.$admin_file.'?task=product_order');
		exit;
	}

	//remove order item from list
	if('delete' === $action && !empty($_GET['id']) && !empty($_GET['orid'])) {
    	$rsorderItem = $common->find('order_item', $condiction = ['order_id' => $_GET['orid']], $type = 'all');

		if(COUNT($rsorderItem) >= 2) 
		{
			$rsOrderP = $common->find('order', $condiction = ['id' => $_GET['orid']], $type = 'one');
			$orItem = $common->find('order_item', $condiction = ['id' => $_GET['id']], $type = 'one');

			$amount_left_subtotal = $rsOrderP['subtotal'] - $orItem['price'];
			$amount_left_total = $rsOrderP['total'] - $orItem['price'];

			$common->update('order', $field = ['subtotal' => $amount_left_subtotal, 'total' => $amount_left_total], $conditon = ['id' => $_GET['orid']]);
			$common->delete('order_item', $condition = ['id' => $_GET['id']]);
			$common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $orItem['imei']]);
		} else {
      		$orItem = $common->find('order_item', $condiction = ['id' => $_GET['id']], $type = 'one');

			$common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $orItem['imei']]);
			$common->delete('order', $condition = ['id' => $_GET['orid']]);
			$common->delete('order_item', $condition = ['id' => $_GET['id']]);
		}
		header('location:'.$admin_file.'?task=product_order');
		exit;
	}

	//search & pagination
	$kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
	$from = (!empty($_GET['from'])) ? $_GET['from'] : '';
	$to = (!empty($_GET['to'])) ? $_GET['to'] : '';
	$productOrder = getProductOrderData($kwd, $from, $to, 30);
	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}

	//index of product order
		$geturl = '?task='.$task.'&from='.$from.'&to='.$to.'&kwd='.urlencode($kwd);
	(new SmartyPaginate)->setUrl($geturl);
	(new SmartyPaginate)->setLimit(30);
	(new SmartyPaginate)->assign($smarty_appform);
	$smarty_appform->assign('list_product_order_data', $productOrder);
	$smarty_appform->display('admin/productOrderTask.tpl');
	exit;
}
//task product note lastest
if('product_note' === $task)
{
  //product return back, and remove order item data
  if('return' === $action)
  {
    $imei = $common->clean_string($_GET['imei']); 
    $note_id  =   $common->clean_string($_GET['note_id']);
    $common->update('note', $field = ['status' => 2,'date_receive' => date('Y-m-d H:i:s')], $condition = ['imei' =>$imei]);
  }
  //action: Change product
  if('change' === $action) 
  {
    $error = array();
    if($_POST) 
    {
      $imei_old = $common->clean_string($_POST['imei_old']);
      $imei_change = $common->clean_string($_POST['imei_change']);
      $note_id = $common->clean_string($_POST['note_id']);
      $product_info = $common->find('product', $condition = ['imei' => $imei_old], $type = 'one' );
      $product_info = $common->find('note', $condition = ['id' => $note_id], $type = 'one' );
      // echo $imei_change; exit;
      if(checkImeiChangeExisted($imei_change) > 0) {
        $existed_imei = '&error=1';
        header('Location:'.$admin_file_name.'?task=product_note&imei='.$_GET['imei'].$existed_imei);
        exit;
      }
      //save new change data to table note product change
      $common->save('note_product_change', $field = ['imei_change' => $imei_change, 'imei_old' => $product_info['imei'],
                            'note_id' => $product_info['id'] ]);
      
      $common->update('note', $field = ['status' => 2,'date_receive' => date('Y-m-d H:i:s')], $condition = ['imei' =>$imei_old]);
      $smarty_appform->assign('e', $note_data);
      header('Location:'.$admin_file_name.'?task=product_note&imei='.$_GET['imei']);
      exit;
    }
  }

  //action: delete product
  if($action === 'delete_pro_note' && !empty($_GET['note_id'])) {
    $common->delete('note', $condition = ['id' => $_GET['note_id']]);
  }

  if('searchnote' === $action)
  {
    //search data
    $q  = "";
    $limit = 20;
    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $offset = ($page - 1) * $limit;
    $results = getProcutNote($_GET['q'] ?? '', $offset, $limit);

    header('Content-type: application/json');
    echo json_encode(array('items' => $results, 'total_count'=>$total_data));
    exit;
  }

  if('add_pro_note' === $action)
  {
    $error   = array();
    if($_POST)
    {
      $order_id     =   $common->clean_string($_POST['order_id']);
      $imei         =   $common->clean_string($_POST['imei']);
      $status       =   $common->clean_string($_POST['status']);
      $note         =   $common->clean_string($_POST['note']);
      $note_detail  =   $common->clean_string($_POST['note_detail']);
      $id           =   $common->clean_string($_POST['note_id']);
      $return       =   1;
      $proNote      =   getProductNote($imei, $order_id);
      $data_note    =  $common->find('note', $condiction = ['id' => $note], $type = 'one');
      $result_note = '';
      if($data_note['note']){
        $result_note = $data_note['note'];
      } else {
        $result_note = $note;
      }
      if(empty($status)) $status = 1;
      if(empty($note)) $error['note'] = 1;
      if(($note_detail) == " ") $error['note_detail'] = 1;
      //Save note
        if(COUNT($error) == 0)
        {
            if(!empty($id)){
                $common->update('note', $field = ['note' => $note, 'note_detail' => $note_detail], $condition = ['id' => $id]);
            }else {
                if($return == 1){
                $common->save('note', $field = ['imei' => $imei, 'order_id' => $order_id, 'note' => $result_note, 'note_detail' => $note_detail, 'status' => $status]);
                }else{
                    $getLast = getLastNote($imei, $order_id);
                    $common->update('note', $field = ['status' => 2, 'date_receive' => date('Y-m-d H:i:s')], $condition = ['imei' => $getLast['imei'],'order_id' => $getLast['order_id'] ]);
                    }
                }
            $proNote = getProductNote($imei, $order_id);
            if(!empty($_GET['imei']))
            {
                $edit = getImeiId($_GET['imei']);
                $smarty_appform->assign('edit', $edit);
            }
            header('Location:'.$admin_file_name.'?task=product_note&imei='.$imei);
            exit;
        }
    }
  }
  $imei = !empty($_GET['imei']) ? $_GET['imei'] : '';
  $note_data = [
    'id' => '',
    'note' => '',
    'note_detail' => '',
  ];
  $dataProImei = getProductOrderDataByImei($imei);
  if (!is_array($dataProImei)) {
    $dataProImei = [
      'id' => null,
      'order_id' => null,
      'imei' => null,
      'title' => '',
      'price' => '',
      'storage_name' => '',
      'description' => '',
      'pro_date_in' => '',
    ];
  }
  $order = !empty($dataProImei['order_id']) ? getListOrderItemData($dataProImei['order_id']) : ['id' => ''];
  if (!is_array($order)) {
    $order = ['id' => ''];
  }
  $proNote = !empty($dataProImei['order_id']) ? getProductNote($imei, $dataProImei['order_id'], 5) : [];
  if (!is_array($proNote)) {
    $proNote = [];
  }
  //Get Note BY ID For Edit note
  if(!empty($_GET['edit_note_id']))
  {
    $note_data = $common->find('note', $condiction = ['id' => $_GET['edit_note_id']], $type = 'one');
    if (!is_array($note_data)) {
      $note_data = [
        'id' => '',
        'note' => '',
        'note_detail' => '',
      ];
    }
    $smarty_appform->assign('edit_note', $note_data);
  }
  if(!empty($imei))
  {
    $getImei = getImeiId($imei);
    if (!is_array($getImei)) {
      $getImei = [];
    }
    $smarty_appform->assign('getImei', $getImei);
  }
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  $geturl = '?task='.$task.'&id='.($_GET['id'] ?? '').'&imei='.$imei;
  (new SmartyPaginate)->setUrl($geturl);
  (new SmartyPaginate)->setLimit(5);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('edit_note', $note_data);
  $smarty_appform->assign('list_imei_data', $dataProImei);
  $smarty_appform->assign('list_orderItem_data', $order);
  $smarty_appform->assign('list_pronote_data', $proNote);
  $smarty_appform->display('admin/productNote.tpl');
  exit;
}
//task product note old
// if('product_note' === $task)
// {
//   if('get_note_detail' === $action)
//   {
//     $id   =   $common->clean_string($_POST['id']);
//     $note_fix = $common->find('note', $condiction = ['id' => $id], $type = 'one');
//     echo json_encode($note_fix);
//     header('Content-Type: application/json');
//     exit;
//   }
//   // product return back, and remove order item data
//   if('return' === $action)
//   {
//     $or_id  =   $common->clean_string($_POST['or_id']);
//     $imei   =   $common->clean_string($_POST['imei']);
//     $note   =   $common->clean_string($_POST['note']);
//     $note_detail   =   $common->clean_string($_POST['note_detail']);
//     $status =   $common->clean_string($_POST['status']);
//     $id     = $common->clean_string($_POST['id']);
//     $return = $common->clean_string($_POST['return']);

//     if(empty($status)) $status = 1;
//     //Save note
//     if(!empty($id)){
//        $common->update('note', $field = ['note' => $note, 'note_detail' => $note_detail], $condition = ['id' => $id]);
//     }else{
//       if($return == 1){
//         $common->save('note', $field = ['imei' => $imei, 'order_id' => $or_id, 'note' => $note, 'note_detail' => $note_detail, 'status' => $status]);
//       }else{
//         $getLast = getLastNote($imei, $or_id);
//         $common->update('note', $field = ['status' => 2, 'date_receive' => date('Y-m-d H:i:s')], $condition = ['imei' => $getLast['imei'],'order_id' => $getLast['order_id'] ]);
//       }
//     }
//     $proNote = getProductNote($imei, $or_id);
//     header('Content-Type: application/json');
//     echo ($proNote) ? json_encode($proNote) : json_encode(array('imei' => null));
//     exit;
//   }

//   if('product_imei' === $action)
//   {
//     header('Content-Type: application/json');
//     if(isset($_POST['imei']) && '' !== $_POST['imei'])
//         {
//           $dataProImei = getProductOrderDataByImei($_POST['imei']);
//           $product = $common->find('product', $where = ['imei' => $_POST['imei']], $type = 'one');
//           $productStroage = $common->find('product_storage', $where = ['id' => $product['storage_id']], $type = 'one');
//           $productColor = $common->find('product_color', $where = ['id' => $product['color_id']], $type = 'one');
//           $order = getListOrderItemData($dataProImei['order_id']);
//           $customer = getCustomerById($dataProImei['customer_id']);
//           $proNote = getProductNote($_POST['imei'], $dataProImei['order_id']);

//           $newdata = array();
//           // if(!empty($dataProImei)) $newdata = array('product' => $dataProImei, 'order' => $order, 'customer' => $customer, 'pro_note' => $proNote);
//           if(!empty($dataProImei)) $newdata = array('product' => $dataProImei, 'order' => $order, 'customer' => $customer, 'pro_note' => $proNote, 'product_color' => $productColor['name'], 'product_storage' => $productStroage['name']);
//           echo ($newdata) ? json_encode($newdata) : json_encode(array('imei' => null));
//         }
//     exit;
//   }

//   if('searchnote' === $action)
//   {
//     //search data
//     $q  = "";
//     $limit = 20;
//     $page = empty($_GET['page']) ? 1 : $_GET['page'];
//     $offset = ($page - 1) * $limit;
//     $results = getProcutNote($_GET['q'], $offset, $limit);

//     header('Content-type: application/json');
//     echo json_encode(array('items' => $results, 'total_count'=>$total_data));
//     exit;
//   }


//   //search & pagination
//   $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
//   $from = (!empty($_GET['from'])) ? $_GET['from'] : '';
//   $to = (!empty($_GET['to'])) ? $_GET['to'] : '';
//   $productOrder = getProductOrderData($kwd, $from, $to, 30);
//   if($total_data > 0) {
//     (new SmartyPaginate)->setTotal($total_data);
//   } else {
//     (new SmartyPaginate)->setTotal(1);
//   }

//   //index of product order
//   $geturl = '?task='.$task.'&from='.$_GET['from'].'&to='.$_GET['to'].'&kwd='.urlencode($kwd);
//   (new SmartyPaginate)->setUrl($geturl);
//   (new SmartyPaginate)->setLimit(30);
//   (new SmartyPaginate)->assign($smarty_appform);

//   $order = getListOrderItemData($_GET['id']=21);
//   $smarty_appform->assign('list_orderItem_data', $order);
//   $smarty_appform->assign('customer', getCustomerById($order['customer_id']));
//   $smarty_appform->assign('products', getOrderItemByOrderId($order['id']));

//   $smarty_appform->assign('list_product_order_data', $productOrder);
//   $smarty_appform->display('admin/productNote.tpl');
//   exit;
// }
//task for list internal_invoice by customer
if('internal_invoice' === $task) {

  	// Action payment slip
	if ('delete' == $action) 
	{
		$int_in_id  = $common->clean_string($_GET['int_in_id']);
		$id         = $common->clean_string($_GET['id']);
		$cus_id     = $common->clean_string($_GET['cus_id']);
		if(!empty($cus_id) && !empty($id))
		{
			
			$resultInvoiceOrder = $common->find('invoice_order', $condiction = ['invoice_id' => $id], $type = 'all');
			foreach ($resultInvoiceOrder as $key => $value) 
			{
				$rsOrder = $common->find('order', $condiction = ['id' => $value['order_id']], $type = 'one');

				$total_split_payment = $rsOrder['total_payment'] - $value['total'];
				updateTPaymentStatusOrder($value['order_id'], $total_split_payment, 1);

				$common->delete('invoice_order', $condition = ['id' => $value['id']]);
			}

			$common->delete('invoice', $condition = ['id' => $id]);

			header('location:'.$admin_file.'?task=internal_invoice&action=split_payment&cus_id='.$cus_id.'&int_in_id='.$int_in_id);
			exit;
		}
  	}
	// Action payment slip
	if ('split_payment' == $action) 
	{
		$error   = array();
		$int_in_id = $common->clean_string($_GET['int_in_id']);
		$internal_invoice_id = '';
		
		if($_POST)
		{
			$date	= $common->clean_string($_POST['date_pay']);
			$dollar	= $common->clean_string($_POST['total']);
			$note	= $common->clean_string($_POST['note']);
			$cus_id	= $common->clean_string($_GET['cus_id']);
			$_SESSION['spayment'] = $_POST;

			$totalInvoieByCus = SumTotalInvoiceByCustomer($cus_id, 1);

			if(empty($date))    $error['date_pay'] = 1;
			if(empty($dollar))  $error['dollar']  = 1;
			if(!empty($dollar) && $dollar > ($totalInvoieByCus['sub_total'] - $totalInvoieByCus['total_payment'])) {
				$error['dollar_over']  = 1;
			}

			if(COUNT($error) == 0)
			{
				$interal_id = $_GET['invoice_id'];
				if(!empty($interal_id))
				{
					$common->update('invoice', $field = ['total' => $dollar, 'pay_date' => $date, 'note'=> $note], $condition = ['id' => $interal_id]);
				} else {
					$cus_id                          = $common->clean_string($_GET['cus_id']);
					$int_in_id                       = $common->clean_string($_GET['int_in_id']);
					$_SESSION['internal_invoice_id'] = $internal_invoice_id;
					$orders = getOrderByCustomer($_GET['cus_id']);
					if($dollar > 0)
					{
						$invoice_id	= $common->save('invoice', $field = [
													'customer_id' => $cus_id,
													'staff_id'	=> $_SESSION['is_staff_login'],
													'total'  	=> $dollar,
													'pay_date'    => $date,
													'note'        => $note,
													'created_at'  =>date('Y-m-d H:i:s')
						]);

						if($invoice_id) {
							$data  = getOrderByCustomerAndStatus($cus_id);

							$total_split_payment = $dollar;

							foreach ($data as $key => $value) 
							{
								if($total_split_payment > 0) 
								{
									$total_invoice = $value['total'];
									$total_payment = $value['total_payment'];
	
									if($total_payment > 0) {
										$total_leff = $total_invoice - $total_payment;
										$total_pay = $total_leff + $total_payment;
									} else {
										$total_leff = $total_invoice;
										$total_pay = $total_invoice;
									}
	
									if($total_split_payment > 0 && $total_split_payment > $total_leff)
									{
										$total_split_payment = $total_split_payment - $total_leff;

										$result = updateTPaymentStatusOrder($value['id'], $total_pay, 2);
										if($result) 
										{
											if($total_payment > 0) {
												$common->save('invoice_order', $field = [
													'invoice_id' 	=> $invoice_id,
													'order_id'		=> $value['id'],
													'total'  		=> $total_leff
												]);
											} else {
												$common->save('invoice_order', $field = [
													'invoice_id' 	=> $invoice_id,
													'order_id'		=> $value['id'],
													'total'  		=> $total_pay
												]);
											}
										}
									} else {
										if($total_payment > 0) 
										{
											if($total_split_payment == $total_leff) 
											{
												$result = updateTPaymentStatusOrder($value['id'], ($total_split_payment+$total_payment), 2);
												if($result) 
												{
													$common->save('invoice_order', $field = [
														'invoice_id' 	=> $invoice_id,
														'order_id'		=> $value['id'],
														'total'  		=> $total_leff
													]);
												}
											} else {
												$result = updateTPaymentStatusOrder($value['id'], ($total_split_payment+$total_payment), 1);
												if($result) 
												{
													$common->save('invoice_order', $field = [
														'invoice_id' 	=> $invoice_id,
														'order_id'		=> $value['id'],
														'total'  		=> $total_split_payment
													]);
												}
											}
											
										} else {
											if($total_split_payment == $total_leff) 
											{
												$result = updateTPaymentStatusOrder($value['id'], $total_split_payment, 2);
											} else {
												$result = updateTPaymentStatusOrder($value['id'], $total_split_payment, 1);
											}
											if($result) 
											{
												$common->save('invoice_order', $field = [
													'invoice_id' 	=> $invoice_id,
													'order_id'		=> $value['id'],
													'total'  		=> $total_split_payment
												]);
											}
										}
										$total_split_payment = 0;
									}
								}
							}
						}

					} else {
						$error['is_error'] = 1;
					}
				}
				unset($_SESSION['spayment']);
				header('location:'.$admin_file.'?task=internal_invoice&action=split_payment&cus_id='.$_GET['cus_id']);
				exit;
			}
		}
		$listAllInvoiceData = listSplitPayment($_GET['cus_id']);
		if($total_data > 0)
		{
		(new SmartyPaginate)->setTotal($total_data);
		}
		else
		{
		(new SmartyPaginate)->setTotal(1);
		}
		(new SmartyPaginate)->assign($smarty_appform);
		$smarty_appform->assign('listAllInvoice', $listAllInvoiceData);
		if(!empty($_GET['invoice_id'])){
		$smarty_appform->assign('edit_data', $common->find('invoice', $condiction = ['id' => $_GET['invoice_id']], $type = 'one'));
		} 
		$cus_id = $common->clean_string($_GET['cus_id']);
		$smarty_appform->assign('customerInfo', $common->find('customer', $condiction = ['id' => $cus_id], $type = 'one'));
		$smarty_appform->assign('branch', getBranch($_SESSION['is_staff_branch']));
		// $smarty_appform->assign('total_val_invoice', getTotalValInternalInvoice($cus_id, $int_in_id));// get total of internal invoice
		// $smarty_appform->assign('total_split_invoice', getTotalValInvoice($cus_id, $int_in_id));// get total value of invoice
		$smarty_appform->assign('total_invoice_customer', SumTotalInvoiceByCustomer($cus_id, 1));
		$smarty_appform->assign('error', $error);
		$smarty_appform->display('admin/split_payment.tpl');
		exit;
	}
	//action: view order item
	if($action === 'view' && !empty($_GET['id'])) {
		$order = getListOrderItemData($_GET['id']);
		$smarty_appform->assign('list_orderItem_data', $order);
		$smarty_appform->assign('customer', getCustomerById($order['customer_id']));
		$smarty_appform->assign('products', getOrderItemByOrderId($order['id']));
		$smarty_appform->display('admin/orderListActionView.tpl');
		exit;
	}

  	if('print' === $action)
	{
		//search & pagination
    $kwd     = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
    $from    = (!empty($_GET['from'])) ? $_GET['from'] : '';
    $to      = (!empty($_GET['to'])) ? $_GET['to'] : '';
    $customer_id = (!empty($_GET['customer_id'])) ? $_GET['customer_id'] : '';
    $branch      = (!empty($_GET['branch'])) ? $_GET['branch'] : '';
    $orderListPrint = getOrderListPrintDataByCustomer($kwd, $from, $to, $customer_id, $status=1);
    $total_less = getTotal();
    // if($total_data > 0) {
    //   (new SmartyPaginate)->setTotal($total_data);
    // } else {
    //   (new SmartyPaginate)->setTotal(1);
    // }
    //index of order List
    // $geturl = '?task='.$task.'&from='.$_GET['from'].'&to='.$_GET['to'].'&kwd='.urlencode($kwd);
    // (new SmartyPaginate)->setUrl($geturl);
    // (new SmartyPaginate)->setLimit(10);
    // (new SmartyPaginate)->assign($smarty_appform);

    $smarty_appform->assign('list_total', $total_less['total']);
    $smarty_appform->assign('list_orderlist_data', $orderListPrint);
    $smarty_appform->assign('list_customer_name', $common->find('customer', $where = [''], $type = 'all'));
    $smarty_appform->assign('sale', getSaleData($kwd, $from, $to, $branch));
		$smarty_appform->display('admin/print_internal_invoice.tpl');
		exit;
	}
	//search & pagination
	$kwd     = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
	$from    = (!empty($_GET['from'])) ? $_GET['from'] : '';
	$to      = (!empty($_GET['to'])) ? $_GET['to'] : '';
	$customer_id = (!empty($_GET['customer_id'])) ? $_GET['customer_id'] : '';
	$branch      = (!empty($_GET['branch'])) ? $_GET['branch'] : '';
  $total_less = getTotal();
	$orderList = getOrderListDataByCustomer($kwd, $from, $to, $customer_id, $status=1, 10);
	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}
	//index of order List
	$geturl = '?task='.$task.'&from='.$from.'&to='.$to.'&kwd='.urlencode($kwd);
	(new SmartyPaginate)->setUrl($geturl);
	(new SmartyPaginate)->setLimit(10);
	(new SmartyPaginate)->assign($smarty_appform);

  $smarty_appform->assign('list_total', $total_less['total']);
	$smarty_appform->assign('list_orderlist_data', $orderList);
	$smarty_appform->assign('list_customer_name', $common->find('customer', $where = [''], $type = 'all'));
	$smarty_appform->assign('sale', getSaleData($kwd, $from, $to, $branch));
	$smarty_appform->display('admin/internal_invoice.tpl');
	exit;
}
if ('report_split_payment' == $task) 
{
	if('detail' == $action) 
	{
		//search & pagination
		$from = (!empty($_GET['from'])) ? $_GET['from'] : '';
		$to = (!empty($_GET['to'])) ? $_GET['to'] : '';
		$branch = (!empty($_GET['branch'])) ? $_GET['branch'] : '';
    if( $from && $to ){
      $difference = strtotime($from) - strtotime($to);
      $days = abs($difference/(60 * 60)/24);
      if($days <= 90){
        $check = true;
      }else{
        $check = false;
      }
    }else{
      $check = false;
    }
		$listInvoicePayment = getInvoicePaymentByCustomer($_GET['cus_id'], $from, $to, $branch, 10);
		if($total_data > 0) {
		  (new SmartyPaginate)->setTotal($total_data);
		} else {
		  (new SmartyPaginate)->setTotal(1);
		}
		(new SmartyPaginate)->setUrl('?'.$urlq);
		(new SmartyPaginate)->setLimit(10);
		(new SmartyPaginate)->assign($smarty_appform);
    $smarty_appform->assign('check_search', $check);
		$smarty_appform->assign('list_orderlist_data', $orderList);
		$smarty_appform->assign('list_branch_name', getListName('branch'));

		$smarty_appform->assign('listAllInvoice', $listInvoicePayment);

		$cus_id = $common->clean_string($_GET['cus_id']);
		$smarty_appform->assign('customerInfo', $common->find('customer', $condiction = ['id' => $cus_id], $type = 'one'));
		$smarty_appform->assign('branch', getBranch($_SESSION['is_staff_branch']));
		$smarty_appform->assign('total_invoice_customer', SumTotalInvoiceByCustomer($cus_id, ''));
		$smarty_appform->display('admin/report_split_payment_detail.tpl');
		exit;
	}

  if('print' === $action)
	{
		//search & pagination
		$from = (!empty($_GET['from'])) ? $_GET['from'] : '';
		$to = (!empty($_GET['to'])) ? $_GET['to'] : '';
		$branch = (!empty($_GET['branch'])) ? $_GET['branch'] : '';

		if(empty($from)) $from = date("Y-m-d");
		if(empty($to)) $to = date("Y-m-d");

		$listInvoicePayment = getInvoicePaymentByCustomer($_GET['cus_id'], $from, $to, $branch, 10);

		if($total_data > 0) {
			(new SmartyPaginate)->setTotal($total_data);
		} else {
			(new SmartyPaginate)->setTotal(1);
		}
		//index of product
		if($total_data > 0) {
		  (new SmartyPaginate)->setTotal($total_data);
		} else {
		  (new SmartyPaginate)->setTotal(1);
		}

		(new SmartyPaginate)->setUrl('?'.$urlq);
		(new SmartyPaginate)->setLimit(10);
		(new SmartyPaginate)->assign($smarty_appform);
		$smarty_appform->assign('list_orderlist_data', $orderList);
		$smarty_appform->assign('list_branch_name', getListName('branch'));
    $smarty_appform->assign('list_customer_name', $common->find('customer', $where = [''], $type = 'all'));
		$smarty_appform->assign('listAllInvoice', $listInvoicePayment);

		$cus_id = $common->clean_string($_GET['cus_id']);
		$smarty_appform->assign('customerInfo', $common->find('customer', $condiction = ['id' => $cus_id], $type = 'one'));
		$smarty_appform->assign('branch', getBranch($_SESSION['is_staff_branch']));
		$smarty_appform->assign('total_invoice_customer', SumTotalInvoiceByCustomer($cus_id, ''));
		$smarty_appform->display('admin/print_split_payment.tpl');
		exit;
	}


	//search & pagination
	$kwd     = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
	$from    = (!empty($_GET['from'])) ? $_GET['from'] : '';
	$to      = (!empty($_GET['to'])) ? $_GET['to'] : '';
	$customer_id = (!empty($_GET['customer_id'])) ? $_GET['customer_id'] : '';
	$orderList = getOrderListDataByCustomer($kwd, $from, $to, $customer_id, '');

	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}
	//index of order List
		$geturl = '?task='.$task.'&from='.$from.'&to='.$to.'&kwd='.urlencode($kwd);
	(new SmartyPaginate)->setUrl($geturl);
	(new SmartyPaginate)->setLimit(10);
	(new SmartyPaginate)->assign($smarty_appform);

	$smarty_appform->assign('list_orderlist_data', $orderList);
	$smarty_appform->assign('list_customer_name', $common->find('customer', $where = [''], $type = 'all'));
	$smarty_appform->assign('sale', getSaleData($kwd, $from, $to, $branch));
	$smarty_appform->display('admin/report_split_payment.tpl');
	exit;
}
//task order_item
if('order_list' === $task) {
  //action: view order item
  if($action === 'view' && !empty($_GET['id'])) {
    $order = getListOrderItemData($_GET['id']);
    $smarty_appform->assign('list_orderItem_data', $order);
    $smarty_appform->assign('customer', getCustomerById($order['customer_id']));
    $smarty_appform->assign('products', getOrderItemByOrderId($order['id']));
    $smarty_appform->display('admin/orderListActionView.tpl');
    exit;
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $from = (!empty($_GET['from'])) ? $_GET['from'] : '';
  $to = (!empty($_GET['to'])) ? $_GET['to'] : '';
  $branch = (!empty($_GET['branch'])) ? $_GET['branch'] : '';
  $orderList = getOrderListData($kwd, $from, $to, $branch, 30);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of order List
  $geturl = '?task='.$task.'&from='.$from.'&to='.$to.'&kwd='.urlencode($kwd);
  (new SmartyPaginate)->setUrl($geturl);
  (new SmartyPaginate)->setLimit(30);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('list_orderlist_data', $orderList);
  $smarty_appform->assign('list_branch_name', getListName('branch'));
  $smarty_appform->assign('sale', getSaleData($kwd, $from, $to, $branch));
  $smarty_appform->display('admin/orderListTask.tpl');
  exit;
}
//task branch
if('branch' === $task) {
  //action: add & edit
  $error = array();
  if($_POST) {
    $branch_name = $common->clean_string($_POST['branch_name']);
    if(empty($branch_name))  $error['branch_name'] = 1;
    if(!empty($_POST['id']) && !empty($branch_name)) {
      editDataById('branch', $_POST['id'], $branch_name);
      header('Location: '.$admin_file.'?task=branch');
      exit;
    }
    if(empty($_POST['id']) && !empty($branch_name)) {
      $common->save('branch', $name = ['name' => $branch_name]);
      header('location:'.$admin_file.'?task=branch');
      exit;
    }
  }
  //action: edit branch by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('branch', getDataById('branch', $_GET['id'])); }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $branch = getBranchData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_branch_data', $branch);
  $smarty_appform->display('admin/branchTask.tpl');
  exit;
}
//task branch
if('product_used' === $task) {
  //action: add & edit
  $error = array();
  if($_POST) {
    $p_usedid = $common->clean_string($_POST['id']);
    $name = $common->clean_string($_POST['name']);
    if(empty($name))  $error['name'] = 1;
    if(!empty($_POST['id']) && !empty($name))
    {
      $common->update('product_used', $field = ['name' => $name], $condition = ['id' => $p_usedid]);
      header('Location: '.$admin_file.'?task=product_used');
      exit;
    }
    if(empty($_POST['id']) && !empty($name)) {
      $common->save('product_used', $name = ['name' => $name]);
      header('location:'.$admin_file.'?task=product_used');
      exit;
    }
  }
  //action: edit branch by id
  if($action === 'edit' && !empty($_GET['id']))
  {
    $smarty_appform->assign('product_used', $common->find('product_used', $condition = ['id' => $_GET['id']], $type = 'one'));
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $product_used = getProductUsedData($kwd);

  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_product_used_data', $product_used);
  $smarty_appform->display('admin/productUsedTask.tpl');
  exit;
}
//task brand
if('brand' === $task) {
  //action: add & edit
  $error = array();
  if($_POST) {
    $brand_name = $common->clean_string($_POST['brand_name']);
    $maker_id = $common->clean_string($_POST['maker_id']);
    $brand_id = $common->clean_string($_POST['id']);
    if(empty($maker_id))  $error['maker'] = 1;
    if(empty($brand_name))  $error['brand_name'] = 1;
    $_SESSION['brand_session'] = $_POST;
    if(!empty($brand_id) && !empty($brand_name) && !empty($maker_id)) {
      $common->update('brand', $field = ['maker_id' => $maker_id, 'name' => $brand_name], $condition = ['id' => $brand_id]);
      header('Location: '.$admin_file.'?task=brand');
      exit;
    }
    if(empty($brand_id) && !empty($brand_name) && !empty($maker_id)) {
      $common->save('brand', $field = ['maker_id' => $maker_id, 'name' => $brand_name ]);
      header('location:'.$admin_file.'?task=brand');
      exit;
    }
  }
  //action: edit brand by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('brand', getDataById('brand', $_GET['id'])); }
  //action: delete brand by id
  if($action === 'delete' && !empty($_GET['id'])) {
    deleteDataById('brand', $_GET['id']);
    header('location:'.$admin_file.'?task=brand');
    exit;
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $brand = getbrandData($kwd, 30);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of brand
  (new SmartyPaginate)->setLimit(30);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_brand_data', $brand);
  $smarty_appform->assign('list_maker_name', getListName('maker'));
  $smarty_appform->display('admin/brandTask.tpl');
  exit;
}
//task maker
if('maker' === $task) {
  //action: delete maker by id
  if($action === 'delete' && !empty($_GET['id'])) {
    deleteDataById('maker',$_GET['id']);
    header('location:'.$admin_file.'?task=maker');
    exit;
  }
  //action: edit maker by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('maker', getDataById('maker',$_GET['id'])); }
  //action: add & edit
  $error = array();
  if($_POST) {
    $maker_name = $common->clean_string($_POST['maker_name']);
    if(empty($maker_name))  $error['maker_name'] = 1;
    if(!empty($_POST['id']) && !empty($maker_name)) {
      editDataById('maker', $_POST['id'], $maker_name);
      header('Location: '.$admin_file.'?task=maker');
      exit;
    }
    if(empty($_POST['id']) && !empty($maker_name)) {
      $common->save('maker', $name = ['name' => $maker_name]);
      header('location:'.$admin_file.'?task=maker');
      exit;
    }
  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $maker = getMakerData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of maker
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_maker_data', $maker);
  $smarty_appform->display('admin/makerTask.tpl');
  exit;
}
//task color
if('color' === $task) {
  //action: add & edit
  $error = array();
  if($_POST) {
    $color_ = $common->clean_string($_POST['color_']);
    if(empty($color_))  $error['color_'] = 1;
    //edit color information
    if(!empty($_POST['id']) && !empty($color_)) {
      editDataInfo('product_color', $_POST['id'], 'name', $color_);
      header('Location: '.$admin_file.'?task=color');
      exit;
    }
    //save color information
    if(empty($_POST['id']) && !empty($color_)) {
      $common->save('product_color', $field = ['name' => $color_]);
      header('location:'.$admin_file.'?task=color');
      exit;
    }
  }
  //action: delete color by id
  if($action === 'delete' && !empty($_GET['id'])) {
    deleteDataById('product_color', $_GET['id']);
    header('location:'.$admin_file.'?task=color');
    exit;
  }
  //action: edit color by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('color', getDataById('product_color', $_GET['id']));  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $color = getColorData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_color_data', $color);
  $smarty_appform->display('admin/colorTask_.tpl');
  exit;
}
//task storage
if('storage' === $task) {
  //action: add & edit
  $error = array();
  if($_POST) {
    $storage_ = $common->clean_string($_POST['storage_']);
    if(empty($storage_))  $error['storage_'] = 1;
    //edit storage information
    if(!empty($_POST['id']) && !empty($storage_)) {
      editDataInfo('product_storage', $_POST['id'], 'name', $storage_);
      header('Location: '.$admin_file.'?task=storage');
      exit;
    }
    if(empty($_POST['id']) && !empty($storage_)) {
      $common->save('product_storage', $field = ['name' => $storage_]);
      header('location:'.$admin_file.'?task=storage');
      exit;
    }
  }
  //action: delete branch by id
  if($action === 'delete' && !empty($_GET['id'])) {
    deleteDataById('product_storage', $_GET['id']);
    header('location:'.$admin_file.'?task=storage');
    exit;
  }
  //action: edit branch by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('storage', getDataById('product_storage', $_GET['id']));  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $storage = getStorageData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_storage_data', $storage);
  $smarty_appform->display('admin/storageTask_.tpl');
  exit;
}
//task company
if('company' === $task){
  //action: add & edit
  $error = array();
  if($_POST) {
    $company = $common->clean_string($_POST['company']);

    if(empty($company))  $error['company'] = 1;
    //edit company information
    if(!empty($_POST['id']) && !empty($company)) {
      editDataInfo('company', $_POST['id'], 'name', $company);
      header('Location: '.$admin_file.'?task=company');
      exit;
    }
    if(empty($_POST['id']) && !empty($company)) {
      $common->save('company', $field = ['name' => $company]);
      // Insertcompany($company);
      header('location:'.$admin_file.'?task=company');
      exit;
    }
  }
  //action: delete branch by id
  if($action === 'delete' && !empty($_GET['id'])) {

	$proByCompany = $common->find('product', $condition = ['company_id' => $_GET['id']], $type = 'one');
	if($proByCompany) {
		deleteDataById('company', $_GET['id']);
	}
    header('location:'.$admin_file.'?task=company');
    exit;
  }
  //action: edit branch by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('company', getDataById('company', $_GET['id']));  }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $company = getcompanyData($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of branch
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_company_data', $company);
  $smarty_appform->display('admin/companyTask.tpl');
  exit;
}
//staff History Task
if('history' === $task) 
{
  if('back' === $action && !empty($_GET['imei'])) {
    $common->update('product', $field = ['deleted_at' => NULL], $conditon = ['imei' => $_GET['imei']]);
    header('location:'.$admin_file.'?task=history');
    exit;
  }
  //action: staff return
  if('return' === $action && !empty($_GET['id'])) {
		$common->update('staff', $field = ['deleted_at' => NULL], $conditon = ['id' => $_GET['id']]);
		header('location:'.$admin_file.'?task=history');
		exit;
	}
  $kwd = (!empty($_GET['kwd']) ? $_GET['kwd'] : '');
	$staff_history = getStaffHistoryData($kwd);
  // $product_history = getProdcutHistoryData($kwd);
	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}
	(new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('list_history_data', $staff_history);
  // $smarty_appform->assign('list_product_history_data', $product_history);
  $smarty_appform->display('admin/historyTask_.tpl');
  exit;
}
//daily, weekly, monthly report
if('report' === $task) 
{
  //search and pagination
  $brand_model = !empty($_GET['brd']) ? $_GET['brd'] : '';
  $product_status = !empty($_GET['sts']) ? $_GET['sts'] : '';
  $ordfrom = !empty($_GET['order_from']) ? $_GET['order_from'] : '';
  $ordto = !empty($_GET['order_to']) ? $_GET['order_to'] : '';
  $summary = !empty($_GET['summary']) ? $_GET['summary'] : '';
  $stock = !empty($_GET['stock']) ? $_GET['stock'] : '';
  $branch = !empty($_GET['branch']) ? $_GET['branch'] : '';
  //show report of all product
  if('show' === $action) {
    $data = array();
    $brand_group = getGroupBrandName($brand_model, 2, $ordfrom, $ordto, 50);
    if('' === $summary) {
      foreach($brand_group As $group) {
        $smarty_appform->assign('brand_data'.$group['brand_id'], getProductDataByBrandID($group['brand_id'], 2, $ordfrom, $ordto, 50));
      }
    }
    $smarty_appform->assign('brand_group', $brand_group);
    $smarty_appform->display('admin/reportActionShow_.tpl');
    exit;
  }
  //view report data
  if(!empty($summary)) {
    $brand_group = getGroupBrandName($brand_model, 2, $ordfrom, $ordto, 50);
  } else {
    $brand_group = getGroupBrandName($brand_model, 2, $ordfrom, $ordto, 50);
    $report      = getProductReportData($brand_model, 2, $ordfrom, $ordto, 50);
  }

  //search & paginationd
	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}
  $geturl = '?task='.$task.'&order_from='.$ordfrom.'&order_to='.$ordto.'&sts='.$product_status.'&brd='.$brand_model.'&summary='.$summary;
  (new SmartyPaginate)->setUrl($geturl);
  (new SmartyPaginate)->setLimit(50);
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('report_data', $report);
  $smarty_appform->assign('brand_group', $brand_group);
  $smarty_appform->assign('list_brand_name', getListName('brand'));
  $smarty_appform->assign('order_from', $ordfrom);
  $smarty_appform->display('admin/reportTask_.tpl');
  exit;
}

//task report product_stock
 //action: produt stock
 if('product_stock' === $task) 
 {
	//search and pagination
	$brand_model = !empty($_GET['brd']) ? $_GET['brd'] : '';
	$product_status = !empty($_GET['sts']) ? $_GET['sts'] : '';
	$ordfrom = !empty($_GET['order_from']) ? $_GET['order_from'] : '';
	$ordto = !empty($_GET['order_to']) ? $_GET['order_to'] : '';
	$summary = !empty($_GET['summary']) ? $_GET['summary'] : '';
	$stock = !empty($_GET['stock']) ? $_GET['stock'] : '';
	$branch = !empty($_GET['branch']) ? $_GET['branch'] : '';

	//action: product stock report
	if('product_stock_show' === $action) {
		$data = array();
		if(!empty($branch)) {
		  $branch_group = getProductGroupBranchName($brand_model, $ordfrom, $ordto, $branch, 1, 1);
		} else {
		  $brand_group = getProductGroupBrandName($brand_model, $ordfrom, $ordto, 1, 1);
		}
	
		if('' === $summary) {
		  if(!empty($branch)) {
			foreach($branch_group As $group) {
			  $smarty_appform->assign('branch_data'.$group['branch_id'], getProductStockDataByBranchID($brand_model, $ordfrom, $ordto, $group['branch_id'], 1));
			}
		  } else {
			foreach($brand_group As $group) {
			  $smarty_appform->assign('brand_data'.$group['brand_id'], getProductStockDataByBrandID($group['brand_id'], $ordfrom, $ordto, 1));
			}
		  }
		} else {
		  $smarty_appform->assign('brand_group_name_data', getGroupBrandNameByBranchID($brand_model, $ordfrom, $ordto, $branch, 1));
		}
	
		$smarty_appform->assign('bybranch_id', $branch);
		if(!empty($branch)) {
		  $smarty_appform->assign('branch_group', $branch_group);
		} else {
		  $smarty_appform->assign('brand_group', $brand_group);
		}
		$smarty_appform->display('admin/reportActionProductStockShow_.tpl');
		exit;
	}
    //view report data
    if(!empty($summary)) {
      if(!empty($branch)) {
        $branch_group = getProductGroupBranchName($brand_model, $ordfrom, $ordto, $branch, 1, 1);
        $brand_group_name = getGroupBrandNameByBranchID($brand_model, $ordfrom, $ordto, $branch, 1);
      } else {
        $brand_group = getProductGroupBrandName($brand_model, $ordfrom, $ordto, 1, 1);
        $brand_group_name = getGroupBrandNameByBranchID($brand_model, $ordfrom, $ordto, $branch, 1);
      }
    } else {
      if(!empty($branch)) {
        $branch_group = getProductGroupBranchName($brand_model, $ordfrom, $ordto, $branch, 1, 1);
        $product_stock_branch = getProductStockDataBranch($brand_model, $ordfrom, $ordto, $branch, 1, 10, 1);
        $brand_group_name = getGroupBrandNameByBranchID($brand_model, $ordfrom, $ordto, $branch, 1);
      } else {
        $brand_group = getProductGroupBrandName($brand_model, $ordfrom, $ordto, 1, 1);
        $product_stock_brand = getProductStockData($brand_model, $ordfrom, $ordto, 1, 10, 1);
      }
    }
    //search & pagination
  	if($total_data > 0) {
  		(new SmartyPaginate)->setTotal($total_data);
  	} else {
  		(new SmartyPaginate)->setTotal(1);
  	}
    $geturl = '?task='.$task.'&action='.$action.'&order_from='.$ordfrom.'&order_to='.$ordto.'&brd='.$brand_model.'&branch='.$branch.'&summary='.$summary;
    (new SmartyPaginate)->setUrl($geturl);
    (new SmartyPaginate)->setLimit(10);
    (new SmartyPaginate)->assign($smarty_appform);
    $smarty_appform->assign('bybranch_id', $branch);
    $smarty_appform->assign('brand_group_name_data', $brand_group_name);
    if(!empty($branch)) {
      $smarty_appform->assign('product_stock_report_data_branch', $product_stock_branch);
      $smarty_appform->assign('branch_group', $branch_group);
    } else {
      $smarty_appform->assign('product_stock_report_data', $product_stock_brand);
      $smarty_appform->assign('brand_group', $brand_group);
    }
    $smarty_appform->assign('list_brand_name', getListName('brand'));
    $smarty_appform->assign('list_branch_name', getListName('branch'));
    $smarty_appform->assign('order_from', $ordfrom);
    $smarty_appform->display('admin/reportActionProductStock_.tpl');
    exit;
  }
//task report summary stock
if('summary_stock' === $task ) 
{
	$brand_model = !empty($_GET['brd']) ? $_GET['brd'] : '';
	if('summary_stock_show' === $action) 
	{
		$branch_id = !empty($_GET['brch']) ? $_GET['brch'] : '2';
		$branch_name = $common->find('branch', $condition = ['id' => $branch_id], $type = 'one');
		$summary_stock_show = getProductStockSummary($branch_id, $brand_model, $status=1);
		$smarty_appform->assign('yesterday', strtotime('-1 day'));
		$smarty_appform->assign('branch_name', $branch_name['name']);
		$smarty_appform->assign('summary_stock_data', $summary_stock_show);
		$smarty_appform->display('admin/reportActionSummaryStockShow.tpl');
		exit;
	}
  $branch_id = !empty($_GET['brch']) ? $_GET['brch'] : '2';
  $summary_stock = getProductStockSummary($branch_id, $brand_model, $status=1);
  $smarty_appform->assign('brch_id', $branch_id);
  $smarty_appform->assign('yesterday', strtotime('-1 day'));
  $smarty_appform->assign('summary_stock_data', $summary_stock);
  $smarty_appform->assign('list_brand_name', getListName('brand'));
  $smarty_appform->assign('list_branch_name', getListName('branch'));
  $smarty_appform->display('admin/reportActionSummaryStock.tpl');
  exit;
}
//task report summary_product
if('summary_product' === $task)
{
	if('summary_product_print' === $action)
	{
		$kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
		$branch_id = (!empty($_GET['branch_id'])) ? $_GET['branch_id'] : '';
		$pr_st_id = (!empty($_GET['pr_st_id'])) ? $_GET['pr_st_id'] : '';
		$summary_product = reportSummaryProduct($kwd, $branch_id, $pr_st_id);
		$smarty_appform->assign('summary_product_data', $summary_product);
		$smarty_appform->display('admin/printReportActionSummaryProduct.tpl');
		exit;
	}
    //search & pagination
    $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
    $branch_id = (!empty($_GET['branch_id'])) ? $_GET['branch_id'] : '';
    $pr_st_id = (!empty($_GET['pr_st_id'])) ? $_GET['pr_st_id'] : '';

    $summary_product = reportSummaryProduct($kwd, $branch_id, $pr_st_id);
    $smarty_appform->assign('product_storage', $common->find('product_storage', $where = [''], $type = 'all'));
    $smarty_appform->assign('list_branch', getListName('branch'));
    $smarty_appform->assign('summary_product_data', $summary_product);
    $smarty_appform->display('admin/reportActionSummaryProduct.tpl');
    exit;
}
//task report summary_product_return
if('summary_product_return' === $task)
{
    $summary_product = reportSummaryProductReturn();
    $smarty_appform->assign('summary_product_data', $summary_product);
    $smarty_appform->display('admin/reportActionSummaryProductReturn.tpl');
    exit;
}

//task report summary_Fixed
if('summary_fixed_product' === $task)
{
    
    $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
    $from = (!empty($_GET['from_fixed'])) ? $_GET['from_fixed'] : '';
    $to = (!empty($_GET['to_fixed'])) ? $_GET['to_fixed'] : '';
    $c_from = (!empty($_GET['c_from_fixed'])) ? $_GET['c_from_fixed'] : '';
    $c_to = (!empty($_GET['c_to_fixed'])) ? $_GET['c_to_fixed'] : '';
    
    $fixedList = getFixedListData($kwd, $from, $to, $c_from, $c_to, 10);
    if($total_data > 0) {
      (new SmartyPaginate)->setTotal($total_data);
    } else {
      (new SmartyPaginate)->setTotal(1);
    }
    //index of fixed List
    $geturl = '?task='.$task.'&from='.$from.'&to='.$to.'&c_from='.$c_from.'&c_to='.$c_to.'&kwd='.urlencode($kwd);
    (new SmartyPaginate)->setUrl($geturl);
    (new SmartyPaginate)->setLimit(10);
    (new SmartyPaginate)->assign($smarty_appform);

    $smarty_appform->assign('list_fixedlist_data', $fixedList);
	$smarty_appform->display('admin/fixedReportActionSummaryProduct.tpl');
	exit;
}

//task order history
if('order_history' === $task)
{
	$cus_id 	= (!empty($_GET['customer_id'])) ? $_GET['customer_id'] : '';
    $date_from 	= (!empty($_GET['from'])) ? $_GET['from'] : '';
    $date_to 	= (!empty($_GET['to'])) ? $_GET['to'] : '';

	$orders = listOrderByStaff($_SESSION['staff_id'], $cus_id, $date_from, $date_to, 30);
	if($total_data > 0) {
		(new SmartyPaginate)->setTotal($total_data);
	} else {
		(new SmartyPaginate)->setTotal(1);
	}

	//index of customer
	(new SmartyPaginate)->setLimit(30);
	(new SmartyPaginate)->assign($smarty_appform);
	$smarty_appform->assign('list_order_data', $orders);
	$smarty_appform->assign('list_customer_name', $common->find('customer', $where = [''], $type = 'all'));
	$smarty_appform->display('admin/orderHistory.tpl');
	exit;
}


if('order_list_history' === $task)
{
  //action: view order item
  if($action === 'view' && !empty($_GET['id'])) {
    $order = getListOrderItemData($_GET['id']);
    $smarty_appform->assign('list_orderItem_data', $order);
    $smarty_appform->assign('customer', getCustomerById($order['customer_id']));
    $smarty_appform->assign('products', getOrderItemByOrderId($order['id']));
    $smarty_appform->display('admin/orderListTaskActionView.tpl');
    exit;
  }

  if('printInvoice' === $action && !empty($_GET['id'])) {
    $invoice_data = getListOrderItemData($_GET['id']);
    $invoivce_num = sprintf("%06d", $invoice_data['id']);
    $smarty_appform->assign('customer', getCustomerById($invoice_data['customer_id']));
    $smarty_appform->assign('products', getOrderItemByOrderId($invoice_data['id']));
    $smarty_appform->assign('warrenty', getWarrentyByOrderId($invoice_data['id']));
    $smarty_appform->assign('order_invoice_number', $invoivce_num);
    $smarty_appform->assign('product_count', count(getOrderItemByOrderId($invoice_data['id'])));
    $smarty_appform->assign('invoice_data', $invoice_data);
    $smarty_appform->display('admin/receipt.tpl');
    exit;
  }
  if('printInvoiceNoIme' === $action && !empty($_GET['id']))
  {
    $invoice_data = getListOrderItemData($_GET['id']);
    $invoivce_num = sprintf("%06d", $invoice_data['id']);
    $smarty_appform->assign('customer', getCustomerById($invoice_data['customer_id']));
    $smarty_appform->assign('products', getOrderItemByOrderIdNoImei($invoice_data['id']));
    $smarty_appform->assign('warrenty', getWarrentyByOrderId($invoice_data['id']));
    $smarty_appform->assign('order_invoice_number', $invoivce_num);
    $smarty_appform->assign('invoice_data', $invoice_data);
    $smarty_appform->display('admin/receipt_noimei.tpl');
    exit;
  }
}
// task product title 
if('product_title' === $task) 
{
  $error = array();
  //action: add & edit
  if($_POST)
  {
    $product_title = $common->clean_string($_POST['product_title']);
    if(empty($product_title))  $error['product_title'] = 1;
    if(!empty($product_title) && checkTitleExisted($product_title) > 0) $error['product_title'] = 2;
    
    if(count($error) == 0 ) 
    {
        if(!empty($_POST['id']) && !empty($product_title)) 
      {
        editDataById('product_title', $_POST['id'], $product_title);
        header('Location: '.$admin_file.'?task=product_title');
        exit;
      }
      if(empty($_POST['id']) && !empty($product_title)) 
      {
        $common->save('product_title', $name = ['name' => $product_title]);
        header('location:'.$admin_file.'?task=product_title');
        exit;
      }
    }
  }
  //action: edit product_title by id
  if($action === 'edit' && !empty($_GET['id'])) { $smarty_appform->assign('product_title', getDataById('product_title', $_GET['id'])); }
  //search & pagination
  $kwd = (!empty($_GET['kwd'])) ? $_GET['kwd'] : '';
  $product_title = getProductTitle($kwd);
  if($total_data > 0) {
    (new SmartyPaginate)->setTotal($total_data);
  } else {
    (new SmartyPaginate)->setTotal(1);
  }
  //index of product_title
  (new SmartyPaginate)->assign($smarty_appform);
  $smarty_appform->assign('error', $error);
  $smarty_appform->assign('list_product_title', $product_title);
  $smarty_appform->display('admin/productTitle.tpl');
  exit;
}

//index of admin.php
$smarty_appform->assign('list_customer_data', getListData('customer', 10));
$smarty_appform->assign('list_staff_data', getStaffData($kwd = '', 10));
$smarty_appform->assign('list_product_data', getProductData($kwd = '', 10));
$smarty_appform->display('admin/index.tpl');
exit;
