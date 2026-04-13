<?php
/**
 * Staff login
 * @author Sengtha
 * @param string $id Staff ID
 * @param string $password password
 * @return int
 */
function staff_login($id, $password)
{
  //these values are set in setup.php
  global $debug, $connected;

  $result = 0;
  try
  {
    $sql = 'SELECT id, branch_id FROM staff WHERE deleted_at IS NULL AND id = :id AND password = :password';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('id' => $id, 'password' => $password));
    return $stmt->fetch();
  }
  catch(PDOException $e)
  {
    $result = 0;
    if ($debug)
    {
      echo 'ERROR: ' . $e->getMessage();
      exit;
    }
  }
  return $result;
}

/**
 * Get branch Information
 * @author: Sengtha
 * @param int $id Brand ID
 * @return mixed
 */
function getBranchById($id)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = 'SELECT * FROM branch WHERE id = :id';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('id' => $id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e)
  {
    $result = false;
    if($debug)  echo 'Function getBranchById Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * Get customer information by national id
 * @author: Sengtha
 * @param int $id national ID
 * @return mixed
 */
function checkCustomerByPhone($phone)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = 'SELECT * FROM customer WHERE phone = :phone';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':phone', (string)$phone, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

  }
  catch(PDOException $e)
  {
    $result = false;
    if($debug)  echo 'Function checkCustomerByPhone Errors: '.$e->getMessage();
  }

  return $result;
}


function getCustomerByNationalId($national_id)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = 'SELECT * FROM customer WHERE idnumber = :idnumber';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':idnumber', (string)$national_id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

  }
  catch(PDOException $e)
  {
    $result = false;
    if($debug)  echo 'Function getCustomerByNationalId Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * Get production information by imei number
 * @author: Sengtha
 * @param int $imei imei number of phone
 * @return array of data
 */
function getProductByImei($imei)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = 'SELECT * FROM product WHERE deleted_at IS NULL AND imei = :imei';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('imei' => $imei));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e)
  {
    $result = false;
    if($debug)  echo 'Function getProductByImei Errors: '.$e->getMessage();
  }

  return $result;
}
/**
 * update order data
 * @author Sengtha
 * @param int $staff_id Staff ID
 * @param int $branch_id Branch ID
 * @param float $total Total order
 * @param array $customer Customer Information
 * @param array $items Product Information
 * @return int
 */
function update_order_data($order_id, $cus_id, $staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items)
{
	global $debug, $connected;
	$result = 0;
	//Save customer Information
	// var_dump($customer->phone); exit;
	$customer_data = checkCustomerByPhone($customer->phone);
	if(false != $customer_data)
	{
		$customer_id = $customer_data['id'];
		$sql = " UPDATE `customer` SET `idnumber` = :idnumber , `name` = :name, `phone` = :phone, `email` = :email, `address` = :address WHERE id = :id ";
		$stmt = $connected->prepare($sql);
		$stmt->bindValue(':id', (int)$customer_id, PDO::PARAM_INT);
		$stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
		$stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
		$stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
		$stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
		$stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
		$stmt->execute();
	}else{
		$stmt = $connected->prepare("INSERT INTO `customer`(`idnumber`, `name`, `phone`, `email`, `address`) VALUES (:idnumber, :name, :phone, :email, :address)");
		$stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
		$stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
		$stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
		$stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
		$stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
		$rs = $stmt->execute();
		if($rs) $result = 1;
		$customer_id = $connected->lastInsertId();
	}

	//Save to order table;
	$sql = " UPDATE `order` SET `branch_id` = :branchid , `customer_id` = :customer_id, `staff_id` = :staff_id, `subtotal` = :subtotal, `discount` = :discount, `changed_model_from` = :changed_model_from, model_price = :model_price, total = :total, ordered_at = :ordered_at  WHERE id = :id ";
	$stmt = $connected->prepare($sql);
	$stmt->bindValue(':id', (int)$order_id, PDO::PARAM_INT);
	$stmt->bindValue(':branchid', (int)$branch_id, PDO::PARAM_INT);
	$stmt->bindValue(':staff_id', (int)$staff_id, PDO::PARAM_INT);
	$stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
	$stmt->bindValue(':subtotal', (string)$subtotal, PDO::PARAM_STR);
	$stmt->bindValue(':discount', (string)$discount, PDO::PARAM_STR);
	$stmt->bindValue(':changed_model_from', (string)$model_text, PDO::PARAM_STR);
	$stmt->bindValue(':model_price', (string)$model_price, PDO::PARAM_STR);
	$stmt->bindValue(':total', (string)$total, PDO::PARAM_STR);
	$stmt->bindValue(':ordered_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
	$stmt->execute();
	if(!empty($order_id))
	{
    $oldOrderITem = getOrderItemByOrderIDForEdit($order_id);
    foreach ($oldOrderITem as $key => $value) 
    {
      updateProductOrderedToNULL($value['imei']);
    }
    
		deleteOrderById($order_id);
		//Save order products
		foreach($items as $item)
		{
			if($item->imei)
			{
				updateProductOrderedDate($item->imei);
				$stmt = $connected->prepare("INSERT INTO `order_item`(`order_id`, `product_id`, `imei`, `title`, `description`, `cost`, `price`, `maker_id`, `brand_id`, `warrenty`, `ordered_item_at`) VALUES (:orderid, :productid, :imei, :title, :description, :cost, :price, :makerid, :brandid, :warrenty, :ordered_item_at)");
				$stmt->bindValue(':orderid', (int)$order_id, PDO::PARAM_INT);
				$stmt->bindValue(':productid', (int)$item->productid, PDO::PARAM_INT);
				$stmt->bindValue(':imei', (string)$item->imei, PDO::PARAM_STR);
				$stmt->bindValue(':title', (string)$item->title, PDO::PARAM_STR);
				$stmt->bindValue(':description', (string)$item->desc, PDO::PARAM_STR);
				$stmt->bindValue(':price', (string)$item->price, PDO::PARAM_STR);
				$stmt->bindValue(':cost', (string)$item->cost, PDO::PARAM_STR);
				$stmt->bindValue(':makerid', (int)$item->maker_id, PDO::PARAM_INT);
				$stmt->bindValue(':brandid', (int)$item->brand_id, PDO::PARAM_INT);
				$stmt->bindValue(':warrenty', (int)$warrenty, PDO::PARAM_INT);
				$stmt->bindValue(':ordered_item_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
				$rs = $stmt->execute();
				if($rs) $result += 1;
			}
		}
		$result = $order_id;
		return $result;
	}
}

function update_order_data_no_cuting($order_id, $cus_id, $staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items)
{
	global $debug, $connected;
	$result = 0;
	//Save customer Information
	// var_dump($customer->phone); exit;
	$customer_data = checkCustomerByPhone($customer->phone);
	if(false != $customer_data)
	{
		$customer_id = $customer_data['id'];
		$sql = " UPDATE `customer` SET `idnumber` = :idnumber , `name` = :name, `phone` = :phone, `email` = :email, `address` = :address WHERE id = :id ";
		$stmt = $connected->prepare($sql);
		$stmt->bindValue(':id', (int)$customer_id, PDO::PARAM_INT);
		$stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
		$stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
		$stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
		$stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
		$stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
		$stmt->execute();
	}else{
		$stmt = $connected->prepare("INSERT INTO `customer`(`idnumber`, `name`, `phone`, `email`, `address`) VALUES (:idnumber, :name, :phone, :email, :address)");
		$stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
		$stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
		$stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
		$stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
		$stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
		$rs = $stmt->execute();
		if($rs) $result = 1;
		$customer_id = $connected->lastInsertId();
	}

	//Save to order table;
	$sql = " UPDATE `order` SET `branch_id` = :branchid , `customer_id` = :customer_id, `staff_id` = :staff_id, `subtotal` = :subtotal, `discount` = :discount, `changed_model_from` = :changed_model_from, model_price = :model_price, total = :total, ordered_at = :ordered_at  WHERE id = :id ";
	$stmt = $connected->prepare($sql);
	$stmt->bindValue(':id', (int)$order_id, PDO::PARAM_INT);
	$stmt->bindValue(':branchid', (int)$branch_id, PDO::PARAM_INT);
	$stmt->bindValue(':staff_id', (int)$staff_id, PDO::PARAM_INT);
	$stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
	$stmt->bindValue(':subtotal', (string)$subtotal, PDO::PARAM_STR);
	$stmt->bindValue(':discount', (string)$discount, PDO::PARAM_STR);
	$stmt->bindValue(':changed_model_from', (string)$model_text, PDO::PARAM_STR);
	$stmt->bindValue(':model_price', (string)$model_price, PDO::PARAM_STR);
	$stmt->bindValue(':total', (string)$total, PDO::PARAM_STR);
	$stmt->bindValue(':ordered_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
	$stmt->execute();
	if(!empty($order_id))
	{
    $oldOrderITem = getOrderItemByOrderIDForEdit($order_id);
    foreach ($oldOrderITem as $key => $value) 
    {
      updateProductOrderedToNULL($value['imei']);
    }
    
    deleteOrderById($order_id);
		//Save order products
		foreach($items as $item)
		{
      if($item->imei){

        $totalStock = 0;
        $totalQuantity = 0;
        // Get stock from product by IMEI
        $sql = "SELECT stock FROM product WHERE imei = :imei";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':imei', trim($item->imei), PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($products as $p) {
            $totalStock += (int)$p->stock;
        }

        $getVule = "SELECT quantity FROM order_item WHERE order_id = :order_id AND imei = :imei";
        $stmts = $connected->prepare($getVule);
        $stmts->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $stmts->bindValue(':imei', trim($item->imei), PDO::PARAM_STR);
        $stmts->execute();
        $orderItem = $stmts->fetch(PDO::FETCH_OBJ);

        if ($orderItem) {
            $totalQuantity += (int)$orderItem->quantity;
        }

        $grandTotal = $totalStock + $totalQuantity;
        $new_qty = $item->quantity;
        $update_stock = $grandTotal - $new_qty;
        $updateSQL = "UPDATE product SET stock = :stock WHERE imei = :imei";
        $updateStmt = $connected->prepare($updateSQL);
        $updateStmt->bindValue(':stock', $update_stock, PDO::PARAM_INT);
        $updateStmt->bindValue(':imei', $item->imei, PDO::PARAM_STR);
        $updateStmt->execute();
      }

      $stmt = $connected->prepare("INSERT INTO `order_item`(`order_id`, `product_id`, `imei`, `title`, `description`, `cost`, `price`, `maker_id`, `brand_id`, `warrenty`, `quantity`,`ordered_item_at`) VALUES (:orderid, :productid, :imei, :title, :description, :cost, :price, :makerid, :brandid, :warrenty, :quantity, :ordered_item_at)");
      $stmt->bindValue(':orderid', (int)$order_id, PDO::PARAM_INT);
      $stmt->bindValue(':productid', (int)$item->productid, PDO::PARAM_INT);
      $stmt->bindValue(':imei', (string)$item->imei, PDO::PARAM_STR);
      $stmt->bindValue(':title', (string)$item->title, PDO::PARAM_STR);
      $stmt->bindValue(':description', (string)$item->desc, PDO::PARAM_STR);
      $stmt->bindValue(':price', (string)$item->price, PDO::PARAM_STR);
      $stmt->bindValue(':cost', (string)$item->cost, PDO::PARAM_STR);
      $stmt->bindValue(':makerid', (int)$item->maker_id, PDO::PARAM_INT);
      $stmt->bindValue(':brandid', (int)$item->brand_id, PDO::PARAM_INT);
      $stmt->bindValue(':warrenty', (int)$warrenty, PDO::PARAM_INT);
      $stmt->bindValue(':quantity', (int)$item->quantity, PDO::PARAM_INT);
      $stmt->bindValue(':ordered_item_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $rs = $stmt->execute();
      if($rs) $result += 1;
    }
		$result = $order_id;
		return $result;
	}
}

function deleteOrderById($id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'DELETE FROM `order_item` WHERE order_id = :id';
    $stmt = $connected->prepare($sql);
    return $stmt->execute(array('id' => $id));
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function  deleteOrderById Errors: '.$e->getMessage();
  }

  return $result;
}
/**
 * Save order data
 * @author Sengtha
 * @param int $staff_id Staff ID
 * @param int $branch_id Branch ID
 * @param float $total Total order
 * @param array $customer Customer Information
 * @param array $items Product Information
 * @return int
 */
function save_order_data($staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items)
{
  global $debug, $connected;
  $result = 0;
  //Save customer Information
  // var_dump($customer->phone); exit;
  $customer_data = checkCustomerByPhone($customer->phone);

  if(false != $customer_data){
    $customer_id = $customer_data['id'];
  }else{
    $stmt = $connected->prepare("INSERT INTO `customer`(`idnumber`, `name`, `phone`, `email`, `address`) VALUES (:idnumber, :name, :phone, :email, :address)");
  	$stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
  	$stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
  	$stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
    $stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
    $stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
  	$rs = $stmt->execute();
    if($rs) $result = 1;
    $customer_id = $connected->lastInsertId();
  }


  //Save to order table;
  $stmt = $connected->prepare("INSERT INTO `order`(`branch_id`, `customer_id`, `staff_id`, `subtotal`, `discount`, `changed_model_from`, `model_price`, `total`, `ordered_at`) VALUES (:branchid, :customerid, :staffid, :subtotal, :discount, :changed_model_from, :model_price, :total, :ordered_at)");
	$stmt->bindValue(':branchid', (int)$branch_id, PDO::PARAM_INT);
	$stmt->bindValue(':staffid', (int)$staff_id, PDO::PARAM_INT);
	$stmt->bindValue(':customerid', (int)$customer_id, PDO::PARAM_INT);
  $stmt->bindValue(':subtotal', (string)$subtotal, PDO::PARAM_STR);
  $stmt->bindValue(':discount', (string)$discount, PDO::PARAM_STR);
  $stmt->bindValue(':changed_model_from', (string)$model_text, PDO::PARAM_STR);
  $stmt->bindValue(':model_price', (string)$model_price, PDO::PARAM_STR);
  $stmt->bindValue(':total', (string)$total, PDO::PARAM_STR);
  $stmt->bindValue(':ordered_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
	$rs = $stmt->execute();
  if($rs) $result = 2;
	$order_id = $connected->lastInsertId();
  //Save order products
  foreach($items as $item)
  {
    if($item->imei)
    {
      $product = getProductByImei($item->imei);
      updateProductOrderedDate($item->imei);
      $stmt = $connected->prepare("INSERT INTO `order_item`(`order_id`, `product_id`, `imei`, `title`, `description`, `cost`, `price`, `maker_id`, `brand_id`, `warrenty`, `ordered_item_at`) VALUES (:orderid, :productid, :imei, :title, :description, :cost, :price, :makerid, :brandid, :warrenty, :ordered_item_at)");
    	$stmt->bindValue(':orderid', (int)$order_id, PDO::PARAM_INT);
    	$stmt->bindValue(':productid', (int)$product['id'], PDO::PARAM_INT);
    	$stmt->bindValue(':imei', (string)$item->imei, PDO::PARAM_STR);
    	$stmt->bindValue(':title', (string)$product['title'], PDO::PARAM_STR);
      $stmt->bindValue(':description', (string)$item->desc, PDO::PARAM_STR);
      $stmt->bindValue(':price', (string)$item->price, PDO::PARAM_STR);
      $stmt->bindValue(':cost', (string)$product['cost'], PDO::PARAM_STR);
      $stmt->bindValue(':makerid', (int)$product['maker_id'], PDO::PARAM_INT);
      $stmt->bindValue(':brandid', (int)$product['brand_id'], PDO::PARAM_INT);
      $stmt->bindValue(':warrenty', (int)$warrenty, PDO::PARAM_INT);
      $stmt->bindValue(':ordered_item_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    	$rs = $stmt->execute();
      if($rs) $result += 1;
    }
  }
  $result = $order_id;
  return $result;
}

function save_order_data_no_cuting($staff_id, $branch_id, $subtotal, $discount, $total, $warrenty, $model_text, $model_price, $customer, $items) {
  global $connected;
  $result = 0;

  // Check if customer exists
  $customer_data = checkCustomerByPhone($customer->phone);
  if ($customer_data) {
      $customer_id = $customer_data['id'];
  } else {
      $stmt = $connected->prepare("INSERT INTO `customer`(`idnumber`, `name`, `phone`, `email`, `address`) VALUES (:idnumber, :name, :phone, :email, :address)");
      $stmt->bindValue(':idnumber', (int)$customer->idnumber, PDO::PARAM_INT);
      $stmt->bindValue(':name', (string)$customer->name, PDO::PARAM_STR);
      $stmt->bindValue(':phone', (string)$customer->phone, PDO::PARAM_STR);
      $stmt->bindValue(':email', (string)$customer->email, PDO::PARAM_STR);
      $stmt->bindValue(':address', (string)$customer->address, PDO::PARAM_STR);
      $stmt->execute();
      $customer_id = $connected->lastInsertId();
  }

  // Insert into `order` table
  $stmt = $connected->prepare("INSERT INTO `order`(`branch_id`, `customer_id`, `staff_id`, `subtotal`, `discount`, `changed_model_from`, `model_price`, `total`, `ordered_at`) VALUES (:branchid, :customerid, :staffid, :subtotal, :discount, :changed_model_from, :model_price, :total, :ordered_at)");
  $stmt->bindValue(':branchid', (int)$branch_id, PDO::PARAM_INT);
  $stmt->bindValue(':staffid', (int)$staff_id, PDO::PARAM_INT);
  $stmt->bindValue(':customerid', (int)$customer_id, PDO::PARAM_INT);
  $stmt->bindValue(':subtotal', (string)$subtotal, PDO::PARAM_STR);
  $stmt->bindValue(':discount', (string)$discount, PDO::PARAM_STR);
  $stmt->bindValue(':changed_model_from', (string)$model_text, PDO::PARAM_STR);
  $stmt->bindValue(':model_price', (string)$model_price, PDO::PARAM_STR);
  $stmt->bindValue(':total', (string)$total, PDO::PARAM_STR);
  $stmt->bindValue(':ordered_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
  $stmt->execute();
  $order_id = $connected->lastInsertId();

  // Insert order items
  foreach ($items as $item) {
      $sql = "SELECT id, stock FROM product WHERE imei = :imei";
      $stmt = $connected->prepare($sql);
      $stmt->bindValue(':imei', $item->imei, PDO::PARAM_STR);
      $stmt->execute();
      $product = $stmt->fetch(PDO::FETCH_OBJ);

      if ($product !== false) {
          $cut_QTY = max(0, $product->stock - $item->quantity);

          $updateSQL = "UPDATE product SET stock = :stock WHERE imei = :imei";
          $updateStmt = $connected->prepare($updateSQL);
          $updateStmt->bindValue(':stock', $cut_QTY, PDO::PARAM_INT);
          $updateStmt->bindValue(':imei', $item->imei, PDO::PARAM_STR);
          $updateStmt->execute();

          $insertSQL = "INSERT INTO activity_product (product_id, stock, created_at, status) 
                        VALUES (:product_id, :stock, :created_at, :status)";
          $insertStmt = $connected->prepare($insertSQL);
          $insertStmt->bindValue(':product_id', $product->id, PDO::PARAM_INT);
          $insertStmt->bindValue(':stock', $cut_QTY, PDO::PARAM_INT);
          $insertStmt->bindValue(':status', 2, PDO::PARAM_INT);
          $insertStmt->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
          $insertStmt->execute();
      }
      if ($item->imei) {
          $product = getProductByImei($item->imei);
          if (!$product) continue; // Skip if product not found

          $stmt = $connected->prepare("INSERT INTO `order_item`(`order_id`, `product_id`, `imei`, `title`, `description`, `cost`, `price`, `maker_id`, `brand_id`, `warrenty`, `quantity`, `ordered_item_at`) 
          VALUES (:orderid, :productid, :imei, :title, :description, :cost, :price, :makerid, :brandid, :warrenty, :quantity, :ordered_item_at)");

          $stmt->bindValue(':orderid', (int)$order_id, PDO::PARAM_INT);
          $stmt->bindValue(':productid', (int)$product['id'], PDO::PARAM_INT);
          $stmt->bindValue(':imei', (string)$item->imei, PDO::PARAM_STR);
          $stmt->bindValue(':title', (string)$product['title'], PDO::PARAM_STR);
          $stmt->bindValue(':description', (string)$item->desc, PDO::PARAM_STR);
          $stmt->bindValue(':price', (string)$item->price, PDO::PARAM_STR);
          $stmt->bindValue(':cost', (string)$product['cost'], PDO::PARAM_STR);
          $stmt->bindValue(':makerid', (int)$product['maker_id'], PDO::PARAM_INT);
          $stmt->bindValue(':brandid', (int)$product['brand_id'], PDO::PARAM_INT);
          $stmt->bindValue(':warrenty', (int)$warrenty, PDO::PARAM_INT);
          $stmt->bindValue(':quantity', (int)$item->quantity, PDO::PARAM_INT);
          $stmt->bindValue(':ordered_item_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
          $stmt->execute();
      }
  }

  return $order_id;
}


function getOrderById($id)
{
  global $debug, $connected, $total_data, $offset, $limit;

  $result = true;
  try
  {

    //Step #1 Get total record from database
    $sql = 'SELECT * FROM `order` r WHERE id =:id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: getOrderById ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

function getlistOrderByStaff($staff_id)
{
  global $debug, $connected, $total_data, $offset, $limit;

  $result = true;
  try
  {

    //Step #1 Get total record from database
    $sql = 'SELECT * FROM `order` r INNER JOIN customer c ON c.id = r.customer_id WHERE r.staff_id = :staffid ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':staffid', (int)$staff_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: getlistOrderByStaff ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

function checkOrderItemByStaff($invoice_id, $staff_id)
{
  global $debug, $connected, $total_data, $offset, $limit;

  $result = true;
  try
  {

    //Step #1 Get total record from database
    $sql = 'SELECT count(*) As total
            FROM `order` r INNER JOIN customer c ON c.id = r.customer_id
            WHERE r.id = :invoice_id AND r.id IN (SELECT r.id FROM `order` r INNER JOIN customer c ON c.id = r.customer_id WHERE r.staff_id = :staff_id)';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':staff_id', (int)$staff_id, PDO::PARAM_INT);
    $stmt->bindValue(':invoice_id', (int)$invoice_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['total'];
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: checkOrderItemByStaff ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

function updateProductOrderedToNULL($imei)
{
  global $debug, $connected;

  $result = true;
  try
  {
    //Step #1 Get total record from database
    $sql = 'UPDATE `product` SET deleted_at = NULL WHERE imei = :imei';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    return $stmt->execute();
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: updateProductOrderedToNULL ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

function updateProductOrderedDate($imei)
{
  global $debug, $connected;

  $result = true;
  try
  {
    //Step #1 Get total record from database
    $sql = 'UPDATE `product` SET deleted_at = :deleted_at WHERE imei = :imei';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':deleted_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    return $stmt->execute();
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: updateProductOrderedDate ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

function getOrderItemByOrderIDForEdit($order_id) 
{
	global $debug, $connected, $total_data, $offset, $limit;
	$result = true;
	try
	{
		$sql = 'SELECT MAX(pr.id) AS produc_id, otm.quantity, otm.price, MAX(pr.cost) AS cost, pr.imei, pr.title, st.name As storage_name, clr.name As color_name, pr.description, pr.brand_id, pr.maker_id
				FROM `order_item` otm
					INNER JOIN product pr ON pr.imei = otm.imei
					INNER JOIN `product_storage` st ON pr.storage_id = st.id
					INNER JOIN `product_color` clr ON pr.color_id = clr.id
					LEFT JOIN `product_branch` pb ON pb.product_id = pr.id
				WHERE otm.order_id = :order_id GROUP BY pr.imei ';
		$stmt = $connected->prepare($sql);
		$stmt->bindValue(':order_id', (int)$order_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	} catch(PDOException $e) {
		$result = false;
		if ($debug)
		{
			echo 'ERROR: getOrderItemByOrderIDForEdit ' . $e->getMessage();
			exit;
		}
	}
	return $result;
}

?>
