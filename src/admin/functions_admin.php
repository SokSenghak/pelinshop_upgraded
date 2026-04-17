<?php
function checkTitleExisted($product_title) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = ' SELECT name FROM product_title WHERE name = :name ';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('name' => $product_title));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkTitleExisted Errors: '.$e->getMessage();
  }
  return $result;
}
//check phone already existed in tb customer
function checkPhoneExisted($phone) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = ' SELECT phone FROM customer WHERE phone = :phone ';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('phone' => $phone));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkPhoneExisted Errors: '.$e->getMessage();
  }

  return $result;
}
function updateProductCostByCompany($storage_id, $color_id, $maker_id, $company_title, $product_title, $cost, $date_from, $date_to)
{
	global $debug, $connected, $total_data, $offset, $limit;
	$result = true;
	try {
		$sql =' UPDATE `product` SET `cost` = :cost 
				WHERE title = :product_title AND storage_id = :storage_id AND color_id = :color_id 
				AND maker_id = :maker_id AND company_title = :company_title 
        AND DATE_FORMAT(created_at, "%Y-%m-%d" ) BETWEEN :date_from AND :date_to ';

		$stmt = $connected->prepare($sql);
		$stmt->bindValue(':storage_id', (int)$storage_id, PDO::PARAM_INT);
		$stmt->bindValue(':color_id', (int)$color_id, PDO::PARAM_INT);
		$stmt->bindValue(':maker_id', (int)$maker_id, PDO::PARAM_INT);
		$stmt->bindValue(':company_title', (string)$company_title, PDO::PARAM_STR);
		$stmt->bindValue(':product_title', (string)$product_title, PDO::PARAM_STR);
		$stmt->bindValue(':date_from', (string)$date_from, PDO::PARAM_STR);
    $stmt->bindValue(':date_to', (string)$date_to, PDO::PARAM_STR);

		$stmt->bindValue(':cost', (string)$cost, PDO::PARAM_STR);
		$result = $stmt->execute();

		return $result;
	} catch(PDOException $e) {
		$result = false;
		if($debug)  echo 'Function updateProductCostByCompany Errors: '.$e->getMessage();
	}

	return $result;
}


function addProductNote($imei, $order_id, $note, $note_detail, $status, $date_receive, $created_at)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = "INSERT INTO `note` (imei, order_id, note, note_detail, status, date_receive, created_at) VALUES(:imei, :order_id, :note, :note_detail, :status, :date_receive, :created_at)";
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    $stmt->bindValue(':order_id', (int)$order_id, PDO::PARAM_INT);
    $stmt->bindValue(':note', (string)$note, PDO::PARAM_STR);
    $stmt->bindValue(':note_detail', (string)$note_detail, PDO::PARAM_STR);
    $stmt->bindValue(':status', (string)$status, PDO::PARAM_STR);
    $stmt->bindValue(':date_receive', (string)$date_receive, PDO::PARAM_STR);
    $stmt->bindValue(':created_at', (string)$created_at, PDO::PARAM_STR);
    $stmt->execute();
  }
  catch (Exception $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: addCustomer ' . $e->getMessage();
      exit;
    }
  }
  return $result;
}
//get imei id for search
function getImeiId($imei)
{
  global $debug, $connected;
  $result = true;
  try
  {
    $sql = "SELECT * FROM `note` WHERE id = :id";
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':id', (int)$imei, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows;
  }
  catch (Exception $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: getEditOrderById ' . $e->getMessage();
      exit;
    }
  }
    return $result;
}
/**
 * @created: 18-01-2022
 * @author CHHOM CHHUNMENG
 * get data by id field
 * @param $tbl table name
 * @param $id field id
 * @return bool|mixed
 */
function checkImeiChangeExisted($imei_change) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = ' SELECT imei_change FROM note_product_change WHERE imei_change = :imei_change ';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('imei_change' => $imei_change));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkImeiChangeExisted Errors: '.$e->getMessage();
  }

  return $result;
}
// Summary Fixed Product

function getFixedListData($kwd = '', $from = '', $to = '', $c_from ='', $c_to = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition = ' imei = :kwd ';
    }
    // Search Date Receive
    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(date_receive, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(date_receive, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(date_receive, \'%Y-%m-%d\' ) <= :to ';
    }
    //End Search Date Receive

    // Search Date Create
    if(!empty($c_from) && !empty($c_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(created_at, \'%Y-%m-%d\' ) BETWEEN :c_from AND :c_to';
    }

    if(!empty($c_from) && empty($c_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(created_at, \'%Y-%m-%d\' ) >= :c_from ';
    }

    if(empty($c_from) && !empty($c_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT(created_at, \'%Y-%m-%d\' ) <= :c_to ';
    }
    //End Search Date Create

    if($condition != '') $where = ' WHERE '.$condition;
    
    //Step #1 Get total record from database
    $sql  = ' SELECT *, (SELECT COUNT(*) FROM `note`'.$where.') AS total FROM `note`'.$where.' ORDER BY id DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    
    if(!empty($kwd))  $stmt->bindValue(':kwd', (string)$kwd, PDO::PARAM_STR);
    if(!empty($from) && empty($to)) $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(empty($from) && !empty($to)) $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }

    if(!empty($c_from) && empty($c_to)) $stmt->bindValue(':c_from', (string)$c_from, PDO::PARAM_STR);
    if(empty($c_from) && !empty($c_to)) $stmt->bindValue(':c_to', (string)$c_to, PDO::PARAM_STR); 
    if(!empty($c_from) && !empty($c_to))
    {
      $stmt->bindValue(':c_from', (string)$c_from, PDO::PARAM_STR);
      $stmt->bindValue(':c_to', (string)$c_to, PDO::PARAM_STR);
    }
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(0 < count($rows)) $total_data = $rows[0]['total'];
    return $rows;
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}


function getInvoicePaymentByCustomer($cus_id, $from, $to, $branch, $slimit)
{
	global $debug, $connected, $offset, $limit, $total_data;
    $result = 0;
    try {
		//Create search condition
		$condition = '';
    	if(!empty($slimit)) $limit = $slimit;
	
		if(!empty($from) && !empty($to))
		{
		  $condition .= ' AND DATE_FORMAT( ord.ordered_at, "%Y-%m-%d" ) BETWEEN :from AND :to ';
		}
	
		if(!empty($from) && empty($to))
		{
		  $condition .= ' AND DATE_FORMAT( ord.ordered_at, "%Y-%m-%d" ) >= :from ';
		}
	
		if(empty($from) && !empty($to))
		{
		  $condition .= ' AND DATE_FORMAT( ord.ordered_at, "%Y-%m-%d" ) <= :to ';
		}
	
		if(!empty($branch))
		{
		  $condition .= ' AND ord.branch_id = :branch ';
		}

		$sql =" SELECT ord.*, b.name AS branch_name, s.name AS staff_name,
					(SELECT COUNT(*) FROM `order` ord
						INNER JOIN branch b ON b.id = ord.branch_id
						INNER JOIN staff s ON s.id = ord.staff_id 
					WHERE ord.customer_id = :cus_id ".$condition." ) AS total_count
				FROM `order` ord
					INNER JOIN branch b ON b.id = ord.branch_id
					INNER JOIN staff s ON s.id = ord.staff_id 
				WHERE ord.customer_id = :cus_id ".$condition." ORDER BY ord.id DESC LIMIT :offset, :limit ";
        $stmt = $connected->prepare($sql);

        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
		$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
		$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
		if(!empty($from))   $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    	if(!empty($to))    	$stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    	if(!empty($branch))	$stmt->bindValue(':branch', (int)$branch, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll();
		if (count($rows) > 0) $total_data = $rows[0]['total_count'];

		$newResult = array();
		foreach ($rows as $key => $value) 
		{
			$sql1=" SELECT inv.*, ior.total AS payment_invoice FROM `invoice_order` ior 
						INNER JOIN invoice inv ON inv.id = ior.invoice_id
					WHERE ior.order_id = :order_id ";

			$stmt1 = $connected->prepare($sql1);
			$stmt1->bindValue(':order_id', (int)$value['id'], PDO::PARAM_INT);
			$stmt1->execute();
			$rows1 = $stmt1->fetchAll();
			$value['invoicedata'] = $rows1;
			$newResult[] = $value;
		}

		// print_r($newResult);

        return $newResult;
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: getInvoicePaymentByCustomer' . $e->getMessage();
            exit;
        }
    }
    return $result;
}
function reportProductHistoryNoCutting($branch_id, $pr_st_id, $from, $to, $slimit=30)
{
	global $debug, $connected, $total_data, $offset, $limit;
	$result = [];
	try {
		if(!empty($slimit)) $limit = $slimit;
		$condition = $where = '';
		if(!empty($branch_id)) {
			if($condition) $condition .= ' AND ';
			$condition .= ' pbr.branch_id = :branch_id ';
		}
		if(!empty($pr_st_id)) {
			if($condition) $condition .= ' AND ';
			$condition .= ' p.storage_id = :pr_st_id ';
		}
		if(!empty($from) && !empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to ';
		}
		if(!empty($from) && empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) >= :from ';
		}
		if(empty($from) && !empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) <= :to ';
		}
		if($condition) $where = ' WHERE '.$condition;

		$sql =' SELECT p.company_title, ap.created_at, 
				(SELECT COUNT(*) FROM (SELECT COUNT(*)
					FROM `product` p
          INNER JOIN activity_product ap ON ap.product_id = p.id
					'.$where.' GROUP BY p.company_title ) AS total_g) AS total_data
				FROM `product` p
        INNER JOIN activity_product ap ON ap.product_id = p.id
				'.$where.' GROUP BY p.company_title LIMIT :offset, :limit ';

		$stmt = $connected->prepare($sql);
		if(!empty($branch_id))	$stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
		if(!empty($pr_st_id))	$stmt->bindValue(':pr_st_id', (int)$pr_st_id, PDO::PARAM_INT);
		if(!empty($from))   	$stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(!empty($to))    		$stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
		$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
		$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll();

		if(count($rows) > 0) $total_data = $rows[0]['total_data'];

		$newResult = array();
		foreach ($rows as $key => $value) 
		{
			$condition1 = '';
			if(!empty($branch_id)) {
				$condition1 .= ' AND p.branch_id = :branch_id ';
			}
			if(!empty($storage_id)) {
				$condition1 .= ' AND p.storage_id = :pr_st_id ';
			}
			if(!empty($from) && !empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to ';
			}
			if(!empty($from) && empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) >= :from ';
			}
			if(empty($from) && !empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) <= :to ';
			}
			$sql1 ='SELECT p.color_id, p.id, p.storage_id, p.maker_id, p.brand_id, p.title, ps.name AS pro_storage, m.name AS maker_name, b.name AS brand_name,
			 		ap.created_at, p.cost, p.imei, pcl.name AS color_name, COUNT(p.deleted_at) AS total_sale
					FROM `product` p
            INNER JOIN activity_product ap ON ap.product_id = p.id
						INNER JOIN product_storage ps ON ps.id = p.storage_id
						INNER JOIN maker m ON m.id = p.maker_id
						INNER JOIN brand b ON b.id = p.brand_id
						INNER JOIN product_branch pbr ON pbr.product_id = p.id
						INNER JOIN product_color pcl ON pcl.id = p.color_id
					WHERE p.company_title = :company_title '.$condition1.' GROUP BY p.storage_id, p.color_id, p.maker_id ';
			$stmt1 = $connected->prepare($sql1);
			$stmt1->bindValue(':company_title', $value['company_title'], PDO::PARAM_STR);
			if(!empty($from))   $stmt1->bindValue(':from', (string)$from, PDO::PARAM_STR);
    	if(!empty($to))    	$stmt1->bindValue(':to', (string)$to, PDO::PARAM_STR);
			$stmt1->execute();
			$rows_detail = $stmt1->fetchAll();
      
      foreach ($rows_detail as $kpd => $pd) 
      {
        $increase = sumStockNoCutting($from, $to, $value['company_title'], $pd['storage_id'], $pd['color_id'], $pd['maker_id'], 1);
        $decrease = sumStockNoCutting($from, $to, $value['company_title'], $pd['storage_id'], $pd['color_id'], $pd['maker_id'], 2);
        $rows_detail[$kpd]['total_product'] = $totalPro['total'];
        $rows_detail[$kpd]['total_stock_increase'] = $increase['total_stock'];
        $rows_detail[$kpd]['total_stock_decrease'] = $decrease['total_stock'];
      }

			$value['products'] = $rows_detail;
			$newResult[] = $value;
		}
		
		return $newResult;
	} catch(PDOException $e) {
		$result = [];
		$total_data = 0;
		if($debug)  echo 'Function reportSummaryProduct Errors: '.$e->getMessage();
	}

	return $result;
}

function sumStockNoCutting($from, $to, $company_title, $storage_id, $color_id, $maker_id, $status)
{
  global $debug, $connected;
  $result = ['total' => 0, 'total_stock' => 0];
  try {
    $sqltotal = ' SELECT COUNT(*) AS total , IFNULL(SUM(ap.stock), 0) AS total_stock FROM `product` p  
                    INNER JOIN activity_product ap ON ap.product_id = p.id
                     WHERE p.company_title = :company_title AND DATE_FORMAT( ap.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to
                      AND p.storage_id = :storage_id AND p.color_id = :color_id AND p.maker_id = :maker_id AND ap.status = :status';

    $stmt_sqltotal = $connected->prepare($sqltotal);
    $stmt_sqltotal->bindValue(':company_title', $company_title, PDO::PARAM_STR);
    $stmt_sqltotal->bindValue(':storage_id', $storage_id, PDO::PARAM_INT);
    $stmt_sqltotal->bindValue(':color_id', $color_id, PDO::PARAM_INT);
    $stmt_sqltotal->bindValue(':maker_id', $maker_id, PDO::PARAM_INT);
    $stmt_sqltotal->bindValue(':from', (string)$from, PDO::PARAM_STR);
    $stmt_sqltotal->bindValue(':to', (string)$to, PDO::PARAM_STR);
    $stmt_sqltotal->bindValue(':status', $status, PDO::PARAM_INT);
    $stmt_sqltotal->execute();

    $result = $stmt_sqltotal->fetch();
    return $result;
  } catch (\Throwable $e) {
    $result = ['total' => 0, 'total_stock' => 0];
		if($debug)  echo 'Function sumStockNoCutting Errors: '.$e->getMessage();
  }
  return $result;
}

function reportProductHistory($branch_id, $pr_st_id, $from, $to, $slimit=30)
{
	global $debug, $connected, $total_data, $offset, $limit;
	$result = [];
	try {
		if(!empty($slimit)) $limit = $slimit;
		$condition = $where = '';
		if(!empty($branch_id)) {
			if($condition) $condition .= ' AND ';
			$condition .= ' pbr.branch_id = :branch_id ';
		}
		if(!empty($pr_st_id)) {
			if($condition) $condition .= ' AND ';
			$condition .= ' p.storage_id = :pr_st_id ';
		}
		if(!empty($from) && !empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( p.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to ';
		}
		if(!empty($from) && empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( p.created_at, "%Y-%m-%d" ) >= :from ';
		}
		if(empty($from) && !empty($to))
		{
			if($condition) $condition .= ' AND ';
		  	$condition .= ' DATE_FORMAT( p.created_at, "%Y-%m-%d" ) <= :to ';
		}
		if($condition) $where = ' WHERE '.$condition;

		$sql =' SELECT p.company_title, p.created_at, 
				(SELECT COUNT(*) FROM (SELECT COUNT(*)
					FROM `product` p
					'.$where.' AND p.is_cutting = 1 GROUP BY p.company_title ) AS total_g) AS total_data
				FROM `product` p
				'.$where.' AND p.is_cutting = 1 GROUP BY p.company_title LIMIT :offset, :limit ';

		$stmt = $connected->prepare($sql);
		if(!empty($branch_id))	$stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
		if(!empty($pr_st_id))	$stmt->bindValue(':pr_st_id', (int)$pr_st_id, PDO::PARAM_INT);
		if(!empty($from))   	$stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    	if(!empty($to))    		$stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
		$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
		$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll();

		if(count($rows) > 0) $total_data = $rows[0]['total_data'];

		$newResult = array();
		foreach ($rows as $key => $value) 
		{
			$condition1 = '';
			if(!empty($branch_id)) {
				$condition1 .= ' AND p.branch_id = :branch_id ';
			}
			if(!empty($storage_id)) {
				$condition1 .= ' AND p.storage_id = :pr_st_id ';
			}
			if(!empty($from) && !empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( p.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to ';
			}
			if(!empty($from) && empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( p.created_at, "%Y-%m-%d" ) >= :from ';
			}
			if(empty($from) && !empty($to))
			{
				$condition1 .= ' AND DATE_FORMAT( p.created_at, "%Y-%m-%d" ) <= :to ';
			}
			$sql1 ='SELECT p.color_id, p.id, p.storage_id, p.maker_id, p.brand_id, p.title, ps.name AS pro_storage, m.name AS maker_name, b.name AS brand_name,
			 		p.created_at, p.cost, p.imei, pcl.name AS color_name, COUNT(p.deleted_at) AS total_sale
					FROM `product` p
						INNER JOIN product_storage ps ON ps.id = p.storage_id
						INNER JOIN maker m ON m.id = p.maker_id
						INNER JOIN brand b ON b.id = p.brand_id
						INNER JOIN product_branch pbr ON pbr.product_id = p.id
						INNER JOIN product_color pcl ON pcl.id = p.color_id
					WHERE p.company_title = :company_title '.$condition1.' GROUP BY p.storage_id, p.color_id, p.maker_id ';
			$stmt1 = $connected->prepare($sql1);
			$stmt1->bindValue(':company_title', $value['company_title'], PDO::PARAM_STR);
			if(!empty($from))   $stmt1->bindValue(':from', (string)$from, PDO::PARAM_STR);
    	if(!empty($to))    	$stmt1->bindValue(':to', (string)$to, PDO::PARAM_STR);
			$stmt1->execute();
			$rows_detail = $stmt1->fetchAll();
      
      foreach ($rows_detail as $kpd => $pd) 
      {
        $sqltotal = ' SELECT COUNT(*) AS total FROM `product` p  
                     WHERE p.company_title = :company_title AND p.is_cutting = 1 AND DATE_FORMAT( p.created_at, "%Y-%m-%d" ) BETWEEN :from AND :to
                      AND p.storage_id = :storage_id AND p.color_id = :color_id AND p.maker_id = :maker_id ';
        $stmt_sqltotal = $connected->prepare($sqltotal);
        $stmt_sqltotal->bindValue(':company_title', $value['company_title'], PDO::PARAM_STR);
        $stmt_sqltotal->bindValue(':storage_id', $pd['storage_id'], PDO::PARAM_INT);
        $stmt_sqltotal->bindValue(':color_id', $pd['color_id'], PDO::PARAM_INT);
        $stmt_sqltotal->bindValue(':maker_id', $pd['maker_id'], PDO::PARAM_INT);
        $stmt_sqltotal->bindValue(':from', (string)$from, PDO::PARAM_STR);
    	  $stmt_sqltotal->bindValue(':to', (string)$to, PDO::PARAM_STR);
        $stmt_sqltotal->execute();
			  $totalPro = $stmt_sqltotal->fetch();
        $rows_detail[$kpd]['total_product'] = $totalPro['total'];
      }

			$value['products'] = $rows_detail;
			$newResult[] = $value;
		}
		

		return $newResult;
	} catch(PDOException $e) {
		$result = [];
		$total_data = 0;
		if($debug)  echo 'Function reportSummaryProduct Errors: '.$e->getMessage();
	}

	return $result;
}

function getOrderByCustomerAndStatus($cus_id)
{
    global $debug, $connected;
    $result = 0;
    try {
        $sql = "SELECT * FROM `order` WHERE customer_id = :cus_id AND `status` = 1";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: getOrderByCustomerAndStatus' . $e->getMessage();
            exit;
        }
    }
    return $result;
}

function updateTPaymentStatusOrder($id, $tpayment, $status)
{
	global $debug, $connected;
    $result = 0;
    try {
        $sql = " UPDATE `order` SET `total_payment` = :tpayment, `status` = :status WHERE `order`.`id` = :id ";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->bindValue(':tpayment', (int)$tpayment, PDO::PARAM_INT);
        $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
        return $stmt->execute();
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: updateTPaymentStatusOrder' . $e->getMessage();
            exit;
        }
    }
    return $result;
}

function dataSum($cus_id)
{
    global $debug, $connected;
    $result = 0;
    try {
        $sql = "SELECT SUM(total) AS stotal FROM `order` WHERE customer_id = :cus_id AND status = 2";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows['stotal'];
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: dataTest' . $e->getMessage();
            exit;
        }
    }
    return $result;
}
function getLastNote($imei, $or_id){
  global $debug, $connected;
  $result = 0;
  try {
      $sql = " SELECT * FROM `note` WHERE imei = :imei AND order_id = :order_id ORDER BY id DESC";
      $stmt = $connected->prepare($sql);
      $stmt->bindValue(':imei', (string)$imei,   PDO::PARAM_STR);
      $stmt->bindValue(':order_id',(int)$or_id, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetch();
     return $rows;
  }
  catch (\Exception $e)
  {
      $result = 0;
      if ($debug)
      {
          echo 'ERROR: getLastNote' . $e->getMessage();
          exit;
      }
  }
  return $result;
}

function getOrderByCustomer($customer_id){
  global $debug, $connected;
  $result = 0;
  try {
      $sql = " SELECT * FROM `order` WHERE customer_id = :customer_id";
      $stmt = $connected->prepare($sql);
      $stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetchAll();
     return $rows;
  }
  catch (\Exception $e)
  {
      $result = 0;
      if ($debug)
      {
          echo 'ERROR: getOrderByCustomer' . $e->getMessage();
          exit;
      }
  }
  return $result;
}
/**
 * getStaffPermissionData
 * @param  int $srid is staff role id
 * @return array or boolean
 */
function getStaffPermissionData($srid)
{
  global $debug, $connected;

  $result = true;
  try
  {
    //Get Task Name
    $sql = ' SELECT * FROM `staff_permission` sp
                INNER JOIN staff_function sf
                    ON sf.id = sp.staff_function_id
                WHERE sp.staff_role_id = :staff_role_id
            GROUP BY sf.task_name ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':staff_role_id', $srid, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $newResult = array();
    foreach ($rows as $key => $value) {
      //Get Action Name
      $sql1 = ' SELECT action_name FROM `staff_permission` sp INNER JOIN staff_function sf ON sf.id = sp.staff_function_id WHERE sp.staff_role_id = :staff_role_id AND sf.action_name != "" AND task_name = :task_name ';
      $stmt1 = $connected->prepare($sql1);
      $stmt1->bindValue(':staff_role_id', $srid, PDO::PARAM_INT);
      $stmt1->bindValue(':task_name', $value['task_name'], PDO::PARAM_STR);
      $stmt1->execute();
      $rows1 = $stmt1->fetchAll();
      if(!empty($rows1)){
        foreach ($rows1 as $k => $va) {
          $newResult[$value['task_name']][$va['action_name']] = array($va['action_name'] => $va['action_name']);
        }
      }else {
        $newResult[$value['task_name']][] = array();
      }
    }
    return $newResult;
  } catch(PDOException $e) {

    $result = false;
    if ($debug)
    {
      echo 'ERROR: getStaffPermissionData ' . $e->getMessage();
      exit;
    }

  }

  return $result;
}

function FuncPermission($func, $role){
  global $debug, $connected;
  $result = 0;
  try {
      $sql = " SELECT COUNT(*) AS total FROM `staff_permission` WHERE staff_function_id = :staff_function_id AND staff_role_id = :staff_role_id";
      $stmt = $connected->prepare($sql);
      $stmt->bindValue(':staff_function_id', (int)$func, PDO::PARAM_INT);
      $stmt->bindValue(':staff_role_id', (int)$role, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetch();
      if($rows['total'] > 0){
        return 1;  //checked
      }else{
        return 2;  //No checked
      }
  }
  catch (\Exception $e)
  {
      $result = 0;
      if ($debug)
      {
          echo 'ERROR: FuncPermission' . $e->getMessage();
          exit;
      }
  }
  return $result;
}
/**
* Check staff permission
*
* @param int $role_id Staff role id taken from staff_role_id of table staff
* @param string $task Task name. Ex: staff
* @param string $action Action name. Ex: edit
* @return boolean If it is true, it means that staff has permission to perform this function
*/
function Authentication($role_id, $task, $action = '')
{
 global $debug, $connected;
 //super admin
//  if(isset($_SESSION['is_super_staff']) && !empty($_SESSION['is_super_staff'])) return true;

 $result = true;
 try
 {
   //Get function id
   $sql = "SELECT id FROM `staff_function` WHERE task_name = :task_name ";
   if(!empty($action)) $sql .= "AND action_name = :action_name";
   $stmt = $connected->prepare($sql);
   $stmt->bindValue(':task_name', $task, PDO::PARAM_STR);
   if(!empty($action)) $stmt->bindValue(':action_name', $action, PDO::PARAM_STR);
   $stmt->execute();
   $row = $stmt->fetch();
   if(empty($row['id'])) return false;
   $stmt = $connected->prepare('SELECT count(*) AS total FROM `staff_permission` WHERE staff_role_id = :role_id AND staff_function_id = :function_id');
   $stmt->bindValue(':role_id', (int)$role_id, PDO::PARAM_INT);
   $stmt->bindValue(':function_id', (int)$row['id'], PDO::PARAM_INT);
   $stmt->execute();
   $row = $stmt->fetch();
   if(empty($row['total'])) return false;
   if(!empty($row['total']) && $row['total']>0) return true;

 } catch(PDOException $e) {

   $result = false;
   if ($debug)
   {
     echo 'ERROR: ' . $e->getMessage();
     exit;
   }

 }
 return $result;
}


function listSplitPayment($cus_id)
{
  global $debug, $connected, $offset, $limit, $total_data;
  try {
    $join = "INNER JOIN customer AS c ON c.id = invoice.customer_id
             INNER JOIN staff AS s ON s.id = invoice.staff_id";

    $sql  = " SELECT invoice.*, c.name AS cus_name, c.phone AS phone, s.name AS staff_name, (SELECT COUNT(*) FROM invoice  ".$join." WHERE invoice.customer_id = :customer_id) AS total_count
    FROM invoice ".$join." WHERE invoice.customer_id = :customer_id ORDER BY id DESC LIMIT :offset, :limit ";
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':customer_id', (int)$cus_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if (count($rows) > 0) $total_data = $rows[0]['total_count'];
    return $rows;
  } catch (Exception $e) {
    $result = false;
    echo " ERROR: listSplitPayment ".$e->getMessage();
  }
  return $result;
}

function getAppointmentStatus($appoint_id)
{
    global $debug, $connected;
    $result = 0;
    try {
        $join = " INNER JOIN appointment_specialist AS aps ON aps.appointment_id = s.appointment_id
                  INNER JOIN specialist AS sp ON sp.id = aps.specialist_id ";
        $sql = " SELECT sp.* FROM status AS s ".$join." ";
        $stmt = $connected->prepare($sql);
        $stmt->execute();
    return $stmt->fetch();
    } catch (\Exception $e) {
        $result = 0;
    if ($debug)
    {
      echo 'ERROR: getAppointmentStatus' . $e->getMessage();
      exit;
    }
    }
    return $result;
}
/**
* get org_name for display in template
*@param $id
*@return array
*/
function getBranch($id)
{
	global $debug, $connected;
	$result = 0;
	try
	{
		$sql = 'SELECT name FROM branch WHERE id = :id';
		$stmt = $connected->prepare($sql);
		$stmt->bindValue(':id',(int)$id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	catch(PDOException $e)
	{
		$result = 0;
		if ($debug)
		{
			echo 'ERROR: function getAccStaff()' . $e->getMessage();
			exit;
		}
	}
	return $result;
}
/**
* យកចំនួនទឺកប្រាក់ដែលបានបង  (បងបណ្ដាក់)
*@param $kwd
*@return array
*/
function getTotalValInvoice($cus_id)
{
    global $debug, $connected;
    $result = 0;
    try {
        $sql = " SELECT SUM(total) AS split_total
        FROM `invoice` WHERE customer_id = :cus_id";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: getTotalValInvoice' . $e->getMessage();
            exit;
        }
    }
    return $result;
}
/**
* this function to get total order invoice
*@param $kwd
*@return array
*/
function getTotalValInternalInvoice($cus_id, $int_in_id)
{
    global $debug, $connected;
    $result = 0;
    try {
        $sql = " SELECT SUM(subtotal) AS totaldollar
        FROM `order` WHERE customer_id = :cus_id AND `status` = 1 ";
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: getTotalValInternalInvoice' . $e->getMessage();
            exit;
        }
    }
    return $result;
}

/**
 * @author IN KHEMRAK
 * search & pagination for Invoice
 * @param string $kwd Keyword
 * @param string $from order date from
 * @param string $to order date to
 * @param string $branch branch id
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getTotal()
{
    global $debug, $connected;
  $result = ['total' => 0];
  try
  {
    $sql = ' SELECT SUM(total - total_payment) AS total FROM `order` WHERE status = 1 ';
    // echo $sql; exit;
    $stmt = $connected->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetch(); 
    return $rows;
  }
  catch (Exception $e)
  {
    $result = ['total' => 0];
    if ($debug)
    {
      echo 'ERROR: getTotal ' . $e->getMessage();
      exit;
    }
  }
  return $result;
}
function getOrderListPrintDataByCustomer($kwd = '', $from = '', $to = '', $customer_id = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = [];
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' (s.name LIKE :kwd OR c.name LIKE :kwd) ';
    }

    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) <= :to ';
    }

    if(!empty($customer_id))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.customer_id = :customer_id ';
    }

	if(!empty($status))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.status = :status ';
    }


    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT r.*, c.name AS customer_name,c.phone AS customer_phone, s.name AS staff_name, b.name AS branch_name, SUM(r.total - r.total_payment) AS total_amount
            FROM `order` AS r
            INNER JOIN `customer` c ON c.id = r.customer_id
            INNER JOIN `staff` s ON s.id = r.staff_id
            INNER JOIN `branch` b ON b.id = r.branch_id '.$where.'
            GROUP BY r.customer_id ORDER BY total_amount DESC';
            // echo $sql; exit;
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))  $stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    if(!empty($from) && empty($to)) $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(empty($from) && !empty($to)) $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    if(!empty($customer_id)) $stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $newdata = array();
    if (count($rows) > 0)
    {
      foreach ($rows as $key => $value) 
      {
        $data                = SumTotalInvoiceByCustomer($value['customer_id'], $status);
        $total_val_invoice   = getTotalValInternalInvoice($value['customer_id'], $value['id']);
        $total_split_invoice = getTotalValInvoice($value['customer_id']);

        $sub_total_dollar    = $total_val_invoice['totaldollar'] - $total_split_invoice['split_total'];
        $value['sub_total']           = $data['sub_total'];
        $value['total_payment']       = $data['total_payment'];
        $value['total_split_invoice'] = $total_split_invoice['split_total'];
        $value['total_payment_lest']  = $sub_total_dollar;
        $newdata[] = $value;
        }
      }
      return $newdata;
  }
  catch(PDOException $e)
  {
    $result = [];
    $total_data = 0;
    if ($debug)
    {
      echo 'ERROR: getOrderListPrintDataByCustomer ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}
function getOrderListDataByCustomer($kwd = '', $from = '', $to = '', $customer_id = '', $status = '', $slimit='') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = [];
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' (s.name LIKE :kwd OR c.name LIKE :kwd) ';
    }

    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) <= :to ';
    }

    if(!empty($customer_id))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.customer_id = :customer_id ';
    }

	if(!empty($status))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.status = :status ';
    }


    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT r.*, c.name AS customer_name,c.phone AS customer_phone, s.name AS staff_name, b.name AS branch_name, SUM(r.total - r.total_payment) AS total_amount, 
			(SELECT COUNT(*) FROM (SELECT COUNT(*) FROM `order` r 
				INNER JOIN `customer` c ON c.id = r.customer_id 
				INNER JOIN `staff` s ON s.id = r.staff_id 
				INNER JOIN `branch` b ON b.id = r.branch_id '.$where.' GROUP BY r.customer_id) AS total_group ) AS total_count
            FROM `order` AS r
            INNER JOIN `customer` c ON c.id = r.customer_id
            INNER JOIN `staff` s ON s.id = r.staff_id
            INNER JOIN `branch` b ON b.id = r.branch_id '.$where.'
            GROUP BY r.customer_id ORDER BY total_amount DESC LIMIT :offset, :limit';
            // echo $sql; exit;
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))  $stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    if(!empty($from) && empty($to)) $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(empty($from) && !empty($to)) $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    if(!empty($customer_id)) $stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);

    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $newdata = array();
    if (count($rows) > 0)
    {
      	$total_data = $rows[0]['total_count'];
        foreach ($rows as $key => $value) 
		{
			$data                = SumTotalInvoiceByCustomer($value['customer_id'], $status);
			$total_val_invoice   = getTotalValInternalInvoice($value['customer_id'], $value['id']);
			$total_split_invoice = getTotalValInvoice($value['customer_id']);

			$sub_total_dollar    = $total_val_invoice['totaldollar'] - $total_split_invoice['split_total'];
			$value['sub_total']           = $data['sub_total'];
			$value['total_payment']       = $data['total_payment'];
			$value['total_split_invoice'] = $total_split_invoice['split_total'];
			$value['total_payment_lest']  = $sub_total_dollar;
			$newdata[] = $value;
        }
    }
    return $newdata;
  }
  catch(PDOException $e)
  {
    $result = [];
    $total_data = 0;
    if ($debug)
    {
      echo 'ERROR: getOrderListDataByCustomer ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}
function SumTotalInvoiceByCustomer($cus_id, $status='')
{
    global $debug, $connected;
    $result = 0;
    try {
		$condition = '';
		if($status) $condition = ' AND `status` = :status ';
		
        $sql = " SELECT SUM(total) AS sub_total, SUM(total_payment) AS total_payment
        FROM `order` WHERE customer_id = :cus_id ".$condition;
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, PDO::PARAM_INT);
        if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
    catch (\Exception $e)
    {
        $result = 0;
        if ($debug)
        {
            echo 'ERROR: SumTotalInvoice' . $e->getMessage();
            exit;
        }
    }
    return $result;
}
function reportSummaryProduct($kwd, $branch_id, $pr_st_id)
{
	global $debug, $connected, $total_data, $offset, $limit;
	$result = true;
	try {
    $condition = '';
		$condition .= !empty($kwd) ? ' AND (p.title LIKE :kwd OR p.imei LIKE :kwd OR p.company_title LIKE :kwd) ' : '';
		$condition .= !empty($branch_id) ? ' AND pbr.branch_id = :branch_id ' : '';
		$condition .= !empty($pr_st_id) ? ' AND p.storage_id = :pr_st_id ' : '';

		$sql = 'SELECT p.color_id, p.id, p.storage_id, p.maker_id, p.brand_id, p.title, ps.name AS pro_storage, m.name AS maker_name, b.name AS brand_name, COUNT(p.id) AS total_product
				FROM `product` p
					INNER JOIN product_storage ps ON ps.id = p.storage_id
				INNER JOIN maker m ON m.id = p.maker_id
				INNER JOIN brand b ON b.id = p.brand_id
				INNER JOIN product_branch pbr ON pbr.product_id = p.id
				WHERE p.status = 1 AND p.deleted_at IS NULL '.$condition.' GROUP BY p.title, p.storage_id, p.brand_id, p.maker_id ORDER BY b.name, m.name ';
		// echo $sql;
		$stmt = $connected->prepare($sql);
		if(!empty($kwd))	$stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
		if(!empty($branch_id)) $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
		if(!empty($pr_st_id))	$stmt->bindValue(':pr_st_id', (int)$pr_st_id, PDO::PARAM_INT);
		// $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
		// $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll();

		$newData = [];
		foreach ($rows as $key => $value)
		{
			// query color
			$sql_color = ' SELECT pcr.name AS product_color, COUNT(p.color_id) AS total_color FROM `product` p
			INNER JOIN product_color pcr ON pcr.id = p.color_id
			WHERE p.status = 1 AND p.storage_id = :storage_id AND p.maker_id = :maker_id AND p.brand_id = :brand_id AND p.title = :title AND p.deleted_at IS NULL GROUP BY p.color_id';
			$stmt_color = $connected->prepare($sql_color);
			$stmt_color->bindValue(':storage_id', (int)$value['storage_id'], PDO::PARAM_INT);
			$stmt_color->bindValue(':maker_id', (int)$value['maker_id'], PDO::PARAM_INT);
			$stmt_color->bindValue(':brand_id', (int)$value['brand_id'], PDO::PARAM_INT);
			$stmt_color->bindValue(':title', (string)$value['title'], PDO::PARAM_STR);
			$stmt_color->execute();
			$rows_color = $stmt_color->fetchAll();
				// print_r($rows_color);
			$value['product_color'] = $rows_color;
			$newData[] = $value;
		}

		if(count($rows) > 0) $total_data = $rows[0]['total'];

		return $newData;
	} catch(PDOException $e) {
		$result = false;
		if($debug)  echo 'Function reportSummaryProduct Errors: '.$e->getMessage();
	}

	return $result;
}
function reportSummaryProductReturn()
{
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $sql = 'SELECT p.id, p.storage_id, p.maker_id, p.brand_id, p.title, ps.name AS pro_storage, m.name AS maker_name, b.name AS brand_name, COUNT(p.id) AS total_product
            FROM `product` p
            	INNER JOIN product_storage ps ON ps.id = p.storage_id
              INNER JOIN maker m ON m.id = p.maker_id
              INNER JOIN brand b ON b.id = p.brand_id
            WHERE p.status = 2 AND p.deleted_at IS NULL GROUP BY p.storage_id, p.brand_id, p.maker_id ORDER BY b.name, m.name ';
    $stmt = $connected->prepare($sql);
    // $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    // $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    $newData = [];
    foreach ($rows as $key => $value)
    {
      // query color
      $sql_color = ' SELECT pcr.name AS product_color, COUNT(p.color_id) AS total_color FROM `product` p
      INNER JOIN product_color pcr ON pcr.id = p.color_id
      WHERE p.status = 2 AND p.storage_id = :storage_id AND p.maker_id = :maker_id AND p.brand_id = :brand_id GROUP BY p.color_id ';
      $stmt_color = $connected->prepare($sql_color);
      $stmt_color->bindValue(':storage_id', (int)$value['storage_id'], PDO::PARAM_INT);
      $stmt_color->bindValue(':maker_id', (int)$value['maker_id'], PDO::PARAM_INT);
      $stmt_color->bindValue(':brand_id', (int)$value['brand_id'], PDO::PARAM_INT);
      $stmt_color->execute();
      $rows_color = $stmt_color->fetchAll();
        // print_r($rows_color);
      $value['product_color'] = $rows_color;
      $newData[] = $value;

    }

    if(count($rows) > 0) $total_data = $rows[0]['total'];

    return $newData;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function reportSummaryProductReturn Errors: '.$e->getMessage();
  }

  return $result;
}
/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * get name from table
 * @param $tbl string table name
 * @return array|bool
 */
function getListName($tbl) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT * FROM '.$tbl;
    $stmt = $connected->prepare($sql.' ORDER BY name');
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * get all data in maker table
 * @param string $tbl table name
 * @param string $setLimit set limit
 * @return array|bool
 */
function getListData($tbl, $setLimit = '') {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT * FROM '.$tbl;
    if(!empty($setLimit))
    {
      $limit = $setLimit;
      $sql .= ' LIMIT 0,'.$limit;
    }

    $stmt = $connected->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListData Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * delete maker by id
 * @param int $id maker id
 * @return bool
 */
function deleteDataById($tbl, $id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'DELETE FROM '.$tbl.' WHERE id = :id';
    $stmt = $connected->prepare($sql);
    return $stmt->execute(array('id' => $id));
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function deleteDataById Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * add data to maker table
 * @return bool
 */
function editDataById($tbl, $id, $name) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'UPDATE '.$tbl.' SET name = :name WHERE id = :id';
    $stmt = $connected->prepare($sql);
    return $stmt->execute(array('id' => $id, 'name' => $name));
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function editDataById Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created: 27-12-2015
 * @author CHHOM CHHUNMENG
 * edit color data
 * @return bool
 */
function editDataInfo($tbl, $id, $field_name, $name) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'UPDATE '.$tbl.' SET '.$field_name.' = :name WHERE id = :id';
    $stmt = $connected->prepare($sql);
    return $stmt->execute(array('id' => $id, 'name' => $name));
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}
//function insert company
function Insertcompany($name)
{
  global $connected;
  $sql = "INSERT INTO company (name) VALUES (:name)";
  $stmt = $connected->prepare($sql);
  $stmt->bindValue(":name", (string) $name, PDO::PARAM_STR);
  $user = $stmt->execute();
  return $user;
}

/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * get data by id field
 * @param $tbl table name
 * @param $id field id
 * @return bool|mixed
 */
function getDataById($tbl, $id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT * FROM '.$tbl.' WHERE id = :id';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('id' => $id));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created: 17-08-2015
 * @author CHHOM CHHUNMENG
 * get data by id field
 * @param $tbl table name
 * @param $id field id
 * @return bool|mixed
 */
function getProductDataById($product_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, br.name As brand_name, mk.name As maker_name, pru.name AS product_used
            FROM `product` pr
            INNER JOIN `product_storage` ps ON ps.id = pr.storage_id
            LEFT JOIN `product_color` pc ON pc.id = pr.color_id
            INNER JOIN `brand` br ON br.id = pr.brand_id
            INNER JOIN `maker` mk ON mk.id = pr.maker_id
            LEFT JOIN `product_used` pru ON pru.id = pr.product_used_id
            WHERE pr.deleted_at IS NULL AND pr.id = :product_id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':product_id', (int)$product_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @created 18-08-2015
 * @author CHHOM CHHUNMENG
 * check imei number in product table
 * @param $imei imei number
 * @return bool|mixed
 */
function checkImeiExisted($imei) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = ' SELECT imei FROM product WHERE imei = :imei ';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('imei' => $imei));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * get all record of order item
 * @created at: 21-08-2015
 * @param string $id optional
 * @return array|bool
 */
function getListOrderItemData($id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT r.*, s.name AS staff_name, b.name AS branch_name, c.name AS cus_name, c.phone AS cus_phone
            FROM `order` r
            INNER JOIN staff s ON s.id = r.staff_id
            INNER JOIN branch b ON b.id = r.branch_id
            INNER JOIN customer c ON c.id = r.customer_id
            WHERE r.id = :order_id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue('order_id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

function getProductStoragByImei($imei) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT psr.name As product_storage FROM `product_storage` psr INNER JOIN `product` pr ON pr.storage_id = psr.id WHERE pr.imei = :imei ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['product_storage'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductStoragByImei Errors: '.$e->getMessage();
  }

  return $result;
}

function getProductNote($imei, $order_id, $slimit = '')
{
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    $sql = ' SELECT note.*, `note_product_change`.imei_old, `note_product_change`.imei_change AS imei_change, (SELECT COUNT(*) FROM `note` LEFT JOIN `note_product_change` ON `note`.id = `note_product_change`.note_id WHERE `note`.imei = :imei AND `note`.order_id = :order_id) AS total FROM `note` LEFT JOIN `note_product_change` ON `note`.id = `note_product_change`.note_id WHERE `note`.imei = :imei AND `note`.order_id = :order_id ORDER BY `note`.id DESC LIMIT :offset, :limit';

    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    $stmt->bindValue(':order_id', (int)$order_id, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(count($rows) > 0) $total_data = $rows[0]['total'];

    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductNote Errors: '.$e->getMessage();
  }

  return $result;
}

function getProductColorByImei($imei) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pc.name As product_color FROM `product` pr INNER JOIN `product_color` pc ON pr.color_id = pc.id WHERE pr.imei = :imei ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['product_color'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author Sengtha
 * get all products by order_id
 * @param int $id Order ID
 * @return mixed
 */
function getOrderItemByOrderId($id) {
  global $debug, $connected;
  $result = true;
  try {
    //get record data
    $sql = 'SELECT o.*, m.name AS maker_name, b.name AS brand_name
            FROM `order_item` o LEFT JOIN maker m ON m.id = o.maker_id
                                LEFT JOIN brand b ON b.id = o.brand_id
            WHERE o.order_id = :order_id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue('order_id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $rows_count = count($rows);
    for ($i=0; $i < $rows_count; $i++) {
      $rows[$i]['product_color_name'] = getProductColorByImei($rows[$i]['imei']);
      $rows[$i]['product_storage_name'] = getProductStoragByImei($rows[$i]['imei']);
    }
    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

function getOrderItemByOrderIdNoImei($id) {
  global $debug, $connected;
  $result = true;
  try {
    //get record data
    $sql = 'SELECT o.*, m.name AS maker_name, b.name AS brand_name, SUM(o.cost) AS tcost, SUM(o.price) AS tprice, COUNT(o.id) AS tqty
            FROM `order_item` o
              LEFT JOIN product p ON p.imei = o.imei
              LEFT JOIN maker m ON m.id = o.maker_id
              LEFT JOIN brand b ON b.id = o.brand_id
            WHERE o.order_id = :order_id GROUP BY o.title, p.storage_id, p.color_id, o.cost, o.price ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue('order_id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $rows_count = count($rows);
    for ($i=0; $i < $rows_count; $i++) {
      $rows[$i]['product_color_name'] = getProductColorByImei($rows[$i]['imei']);
      $rows[$i]['product_storage_name'] = getProductStoragByImei($rows[$i]['imei']);
    }
    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getOrderItemByOrderIdNoImei Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author Sengtha
 * get all products by order_id
 * @param int $id Order ID
 * @return mixed
 */
function getWarrentyByOrderId($id) {
  global $debug, $connected;
  $result = true;
  try {
    //get record data
    $sql = 'SELECT DISTINCT warrenty
            FROM `order_item`
            WHERE order_id = :order_id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue('order_id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['warrenty'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * get Customer history
 * @created at: 24-08-2015
 * @param $customer_id customer id
 * @return bool|mixed
 */
function getCustomerHistory($customer_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT *
            FROM `customer` c
            INNER JOIN `order` ord ON c.id = ord.customer_id
            INNER JOIN `order_item` ordm ON ord.id = ordm.order_id
            WHERE c.id = :customer_id';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('customer_id' => $customer_id));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * Get customer information by id
 * @author: Sengtha
 * @param int $id Customer ID
 * @return mixed
 */
function getCustomerById($id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT * FROM customer WHERE id = :id';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('id' => $id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG and Modified by Sengtha
 * Get staff information
 * @created at: 24-08-2015
 * @param int $staff_id Staff id
 * @return mixed
 */
function getOrderStaffInfo($staff_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT s.*, b.name AS branch_name
            FROM `staff` s
            INNER JOIN `branch` b ON b.id = s.branch_id
            WHERE s.id = :staff_id';
    $stmt = $connected->prepare($sql);
    $stmt->execute(array('staff_id' => $staff_id));
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for product task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getProductData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = ' WHERE pr.deleted_at IS NULL ';
    if(!empty($kwd))    $condition .= ' AND (pr.title LIKE :kwd OR pr.imei LIKE :kwd) ';
    $sqlData = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name,
                  br.name As brand_name, (
                  SELECT COUNT(*)
                    FROM `product` pr
                    INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
                    INNER JOIN `product_color` pc ON pr.color_id = pc.id
                    INNER JOIN `maker` mk ON pr.maker_id = mk.id
                    INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.'
                  ) As total
                FROM `product` pr
                INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
                INNER JOIN `product_color` pc ON pr.color_id = pc.id
                INNER JOIN `maker` mk ON pr.maker_id = mk.id
                INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.' ORDER BY pr.created_at DESC LIMIT :offset, :limit';
                // echo $sqlData;
    $stmt = $connected->prepare($sqlData);
    if(!empty($kwd))	$stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(count($rows) > 0) $total_data = $rows[0]['total'];
    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}
/**
 * getListProductHistory
 * @param  string $kwd is keyword
 * @param  int $branch_id is branch_id
 * @param  int $slimit is for assign limit
 * @param  int $flag is 1 or 2.. for check product_branch
 * @return array or boolen
 */
function getListProductHistory($kwd = '', $branch_id = '', $maker = '', $brand = '', $pro_id, $num_blank, $slimit = '', $pr_st_id, $from, $to) {
    global $debug, $connected, $total_data, $offset, $limit;
    $result = true;
    if(!empty($slimit))
    {
      $limit = $slimit;
      $setLimit = ' LIMIT :offset, :limit ';
    }
    try {
      $condition = '';
      $condition .= !empty($kwd) ? ' AND (pr.title LIKE :kwd OR pr.imei LIKE :kwd OR pr.company_title LIKE :kwd) ' : '';
      $condition .= !empty($branch_id) ? ' AND pbr.branch_id = :branch_id ' : '';
      $condition .= !empty($maker) ? ' AND pr.maker_id = :maker ' : '';
      $condition .= !empty($brand) ? ' AND pr.brand_id = :brand ' : '';
      $condition .= !empty($pr_st_id) ? ' AND pr.storage_id = :pr_st_id ' : '';
  
      if(!empty($from) && !empty($to))
      {
        if(!empty($condition)) $condition .= ' AND ';
        $condition .= ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
      }
  
      if(!empty($from) && empty($to))
      {
        if(!empty($condition)) $condition .= ' AND ';
        $condition .= ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :from ';
      }
  
      if(empty($from) && !empty($to))
      {
        if(!empty($condition)) $condition .= ' AND ';
        $condition .= ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :to ';
      }
  
      if(!empty($pro_id)) {
        if(!empty($condition)) $condition .= ' AND ';
        $condition .= ' AND pr.id IN ('.$pro_id.') ';
      } 

      if($condition) $where = ' WHERE '.$condition;
  
      $sql = ' SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name, pus.name AS pro_used_name,
              (SELECT COUNT(*) FROM `product` pr
                LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
                LEFT JOIN `product_color` pc ON pr.color_id = pc.id
                LEFT JOIN `maker` mk ON pr.maker_id = mk.id
                LEFT JOIN `brand` br ON pr.brand_id = br.id
                LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id '.$where.') As total
            FROM `product` pr
              LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
              LEFT JOIN `product_color` pc ON pr.color_id = pc.id
              LEFT JOIN `maker` mk ON pr.maker_id = mk.id
              LEFT JOIN `brand` br ON pr.brand_id = br.id
              LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
              LEFT JOIN `product_used` pus ON pus.id = pr.product_used_id '.$where.' ORDER BY pr.created_at DESC '.$setLimit;
      // echo $sql;exit;
      $stmt = $connected->prepare($sql);
      if(!empty($kwd))	$stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
      if(!empty($branch_id)) $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
      if(!empty($maker))	$stmt->bindValue(':maker', (int)$maker, PDO::PARAM_INT);
      if(!empty($brand))	$stmt->bindValue(':brand', (int)$brand, PDO::PARAM_INT);
      if(!empty($pr_st_id))	$stmt->bindValue(':pr_st_id', (int)$pr_st_id, PDO::PARAM_INT);
      if(!empty($slimit))
      {
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
      }
      if(!empty($from))  $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      if(!empty($to))  $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
  
      $stmt->execute();

      $rows = $stmt->fetchAll();
      $rows_count = count($rows);

      for ($i = 0; $i < $rows_count ; $i++) {
        $rows[$i]['branch_name'] = getProductBranchId($rows[$i]['id']);
      }
      if(count($rows) > 0) $total_data = $rows[0]['total'];

      $newResult = array();

      if($num_blank > 0)
      {
        for ($i=0; $i < $num_blank; $i++) {
          $newResult[] = array('status_blank' => 1);
        }
      }

      foreach ($rows as $key => $value)
      {
        $newResult[] = $value;
      }

      return $newResult;
      
    } catch(PDOException $e) {
      $result = false;
      if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
    }
    return $result;
  }
/**
 * getListProduct
 * @param  string $kwd is keyword
 * @param  int $branch_id is branch_id
 * @param  int $slimit is for assign limit
 * @param  int $flag is 1 or 2.. for check product_branch
 * @return array or boolen
 */

function getListProduct($kwd = '', $branch_id = '', $maker = '', $brand = '', $pro_id, $num_blank, $slimit = '', $pr_st_id, $from, $to, $is_cutting) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = [];
  if(!empty($slimit))
  {
    $limit = $slimit;
    $setLimit = ' LIMIT :offset, :limit ';
  }
  try {
    $condition = '';
    $condition .= !empty($kwd) ? ' AND (pr.title LIKE :kwd OR pr.imei LIKE :kwd OR pr.company_title LIKE :kwd) ' : '';
    $condition .= !empty($branch_id) ? ' AND pbr.branch_id = :branch_id ' : '';
    $condition .= !empty($maker) ? ' AND pr.maker_id = :maker ' : '';
    $condition .= !empty($brand) ? ' AND pr.brand_id = :brand ' : '';
    $condition .= !empty($pr_st_id) ? ' AND pr.storage_id = :pr_st_id ' : '';
    $condition .= !empty($is_cutting) ? ' AND pr.is_cutting = :is_cutting ' : '';

    if(!empty($from) && !empty($to))
    {
      $condition .= ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      $condition .= ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      $condition .= ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :to ';
    }

    if(!empty($pro_id)) $condition .= ' AND pr.id IN ('.$pro_id.') ';

    $sql = ' SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name, pus.name AS pro_used_name, pbr.branch_id,
            (SELECT COUNT(*) FROM `product` pr
              LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
              LEFT JOIN `product_color` pc ON pr.color_id = pc.id
              LEFT JOIN `maker` mk ON pr.maker_id = mk.id
              LEFT JOIN `brand` br ON pr.brand_id = br.id
              LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
            WHERE pr.status = 1 AND pr.deleted_at IS NULL '.$condition.') As total
          FROM `product` pr
            LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id
            LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
            LEFT JOIN `product_used` pus ON pus.id = pr.product_used_id
          WHERE pr.status = 1 AND pr.deleted_at IS NULL '.$condition.' ORDER BY pr.created_at DESC '.$setLimit;
    // echo $sql;exit;
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))	$stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    if(!empty($branch_id)) $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
    if(!empty($maker))	$stmt->bindValue(':maker', (int)$maker, PDO::PARAM_INT);
    if(!empty($brand))	$stmt->bindValue(':brand', (int)$brand, PDO::PARAM_INT);
    if(!empty($pr_st_id))	$stmt->bindValue(':pr_st_id', (int)$pr_st_id, PDO::PARAM_INT);
    if(!empty($is_cutting))	$stmt->bindValue(':is_cutting', (int)$is_cutting, PDO::PARAM_INT);
    if(!empty($slimit))
    {
      $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
      $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    }
    if(!empty($from))  $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(!empty($to))  $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);

    $stmt->execute();
    $rows = $stmt->fetchAll();
    $rows_count = count($rows);
    for ($i = 0; $i < $rows_count ; $i++) {
      $rows[$i]['branch_name'] = getProductBranchId($rows[$i]['id'], $rows[$i]['branch_id']);
    }
    if(count($rows) > 0) $total_data = $rows[0]['total'];

    $newResult = array();

    if($num_blank > 0)
    {
      for ($i=0; $i < $num_blank; $i++) {
        $newResult[] = array('status_blank' => 1);
      }
    }

    foreach ($rows as $key => $value)
    {
      $newResult[] = $value;
    }

    return $newResult;
  } catch(PDOException $e) {
    $result = [];
    $total_data = 0;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }
  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for product task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getProdcutHistoryData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $where = ' WHERE pr.deleted_at IS NOT NULL';
    if(!empty($kwd))
    {
      $condition = '';
      $condition .= ' AND p.title LIKE :kwd ';
      $condition .= ' OR p.imei LIKE :kwd';
    }

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name,
                  br.name As brand_name
                FROM `product` pr
                INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
                INNER JOIN `product_color` pc ON pr.color_id = pc.id
                INNER JOIN `maker` mk ON pr.maker_id = mk.id
                INNER JOIN `brand` br ON pr.brand_id = br.id';
    return getDataFromSearch($sqlData, 'pr.created_at', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * get product transferred to other branch
 * @param  string  $unique_key unique key
 * @return array of data
 */
function getProductTransferHistoryForPrint($unique_key) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pt.*, br.name As branch_name, pr.title, pr.price, str.name As storage_name, clr.name As color_name,
              mkr.name As maker_name, brd.name As brand_name
            FROM `product_transfer` pt
            INNER JOIN `product` pr ON pr.id = pt.product_id
            INNER JOIN `branch` br ON pt.branch_id = br.id
            LEFT JOIN `product_storage` str ON str.id = pr.storage_id
            LEFT JOIN `product_color` clr ON clr.id = pr.color_id
            LEFT JOIN `maker` mkr ON mkr.id = pr.maker_id
            LEFT JOIN `brand` brd ON brd.id = pr.brand_id
            WHERE pt.unique_key = :unique_key';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':unique_key', (string)$unique_key, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductTransferHistoryForPrint Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * get product transferred history to other branch
 * @param  string  $unique_key unique key
 * @return array of data
 */
function getProductTransferHistoryByUniqueKey($unique_key) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pt.*, br.name As branch_name, (
              SELECT COUNT(*) FROM `product_transfer` pt
              INNER JOIN `branch` br ON pt.branch_id = br.id
              WHERE  pt.unique_key = :unique_key ) As qty
            FROM `product_transfer` pt
            INNER JOIN `branch` br ON pt.branch_id = br.id
            WHERE pt.unique_key = :unique_key GROUP BY pt.unique_key';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':unique_key', (string)$unique_key, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  { echo 'Function getProductTransferHistoryByUniqueKey Errors: '.$e->getMessage(); exit; }
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search product transferred history
 * @param  integer  $branch_id branch id
 * @param  string  $unique_key unique key
 * @param  integer  $slimit set limit from pg
 * @return array of data
 */
function getProductTransferHistory($branch_id = '', $unique_key = '',  $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    $condition = $where = '';
    $condition .= !empty($branch_id) ? (!empty($condition) ? ' AND pt.branch_id = :branch_id ' : ' pt.branch_id = :branch_id ' ): '';
    $condition .= !empty($unique_key) ? (!empty($condition) ? 'AND pt.unique_key = :unique_key ' : ' pt.unique_key = :unique_key ' ) : '';
    $where .= !empty($condition) ? ' WHERE '.$condition : '';
    $sql = 'SELECT pt.*, br.name As branch_name, COUNT(*) As qty, (
              SELECT COUNT(*) As total FROM (SELECT pt.*, br.name As branch_name, COUNT(*) As qty
              FROM `product_transfer` pt
              INNER JOIN `branch` br ON pt.branch_id = br.id
              '.$where.' GROUP BY pt.unique_key ) As total_all) As total_record
            FROM `product_transfer` pt
            INNER JOIN `branch` br ON pt.branch_id = br.id
            '.$where.' GROUP BY pt.unique_key ORDER BY pt.transfered_date DESC LIMIT :offset, :limit ';

    $stmt = $connected->prepare($sql);
    if(!empty($branch_id)) $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
    if(!empty($unique_key)) $stmt->bindValue(':unique_key', (string)$unique_key, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(count($rows) > 0) $total_data = $rows[0]['total_record'];
    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductTransferHistory Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Staff task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getStaffData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $where = ' WHERE s.deleted_at IS NULL ';
    if(!empty($kwd))  $where .= ' AND s.name LIKE :kwd';
    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total
            FROM `staff` s
            INNER JOIN `branch` br ON s.branch_id = br.id
            LEFT JOIN `role` r ON s.role = r.id ';
            
            
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT s.*, br.name as branch_name, r.name AS role_name
                FROM `staff` s
                INNER JOIN `branch` br ON s.branch_id = br.id
                LEFT JOIN `role` r ON s.role = r.id';
    return getDataFromSearch($sqlData, 's.created_at', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Customer task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getCustomerData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
      $condition .= ' OR phone LIKE :kwd ';
      $condition .= ' OR idnumber LIKE :kwd ';
      $condition .= ' OR email LIKE :kwd ';
      $condition .= ' OR address LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `customer`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `customer`';
    return getDataFromSearch($sqlData, 'created_at', $kwd, $where, $limit);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Branch task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getBranchData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `branch`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `branch`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getBranchData Errors: '.$e->getMessage();
  }

  return $result;
}

//product title
function getProductTitle ($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `product_title`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `product_title`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductTitle Errors: '.$e->getMessage();
  }

  return $result;
}

function getProductUsedData($kwd = '', $slimit = '')
{
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `product_used`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `product_used`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductUsedData Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * get product for transfer
 * @param  string  $kwd    keyword
 * @param  string  $maker  product marker
 * @param  string  $brand  product brand
 * @param  string  $slimit set limit from pg
 * @return array of data
 */
function getListProductToTransfer($kwd = '', $maker = '', $brand = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    $condition = '';
    $condition .= !empty($kwd) ? ' AND (pr.title LIKE :kwd OR pr.imei LIKE :kwd) ' : '';
    $condition .= !empty($maker) ? ' AND pr.maker_id = :maker ' : '';
    $condition .= !empty($brand) ? ' AND pr.brand_id = :brand ' : '';
    $sql = ' SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name,
            (SELECT COUNT(*) FROM `product` pr
              LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
              LEFT JOIN `product_color` pc ON pr.color_id = pc.id
              LEFT JOIN `maker` mk ON pr.maker_id = mk.id
              LEFT JOIN `brand` br ON pr.brand_id = br.id
              LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
            WHERE pr.deleted_at IS NULL AND pbr.branch_id = 2 '.$condition.') As total
          FROM `product` pr
            LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id
            LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
          WHERE pr.deleted_at IS NULL AND pbr.branch_id = 2 '.$condition.' ORDER BY pr.created_at DESC LIMIT :offset, :limit ';

    $stmt = $connected->prepare($sql);
    if(!empty($kwd))	$stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    if(!empty($maker))	$stmt->bindValue(':maker', (int)$maker, PDO::PARAM_INT);
    if(!empty($brand))	$stmt->bindValue(':brand', (int)$brand, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(count($rows) > 0) $total_data = $rows[0]['total'];
    return $rows;
  } catch (Exception $e) {
    $result = false;
    if ($debug){ echo 'ERROR: ' . $e->getMessage(); exit; }
  }
  return $result;
}

/**
 * get product transfer by imei
 * @param  string   $product_imei imei
 * @return array of data
 */
function getProductTransfer($product_imei) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $sql = 'SELECT pr.id, pr.imei, CONCAT(pr.title, "-", pc.name, "-", ps.name) As product_name, pr.description, pr.cost, pr.price,
            mk.name As maker_name, br.name As brand_name
            FROM `product` pr
              LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
              LEFT JOIN `product_color` pc ON pr.color_id = pc.id
              LEFT JOIN `maker` mk ON pr.maker_id = mk.id
              LEFT JOIN `brand` br ON pr.brand_id = br.id
              LEFT JOIN `product_branch` pbr ON pbr.product_id = pr.id
            WHERE pr.deleted_at IS NULL AND pbr.branch_id = 3 AND pr.imei = :product_imei ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':product_imei', $product_imei, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;

  } catch (Exception $e) {
    $result = false;
    if ($debug){ echo 'ERROR: ' . $e->getMessage(); exit; }
  }
  return $result;
}

/**
 * transfer product to product transfer table
 * @param  integer  $branch_id     branch id
 * @param  array  $product_items  product items
 * @return array of data
 */
function transferProduct($branch_id, $product_items) {
  global $debug, $connected;
  $result = 0;
  try {
    $_SESSION['unique_key'] = md5(time());
    foreach ($product_items as $item) {
      if($item->imei) {
        $sql = 'UPDATE `product_branch` SET branch_id = :branch_id WHERE product_id = :product_id';
        $stmt = $connected->prepare($sql);
        $stmt->bindValue(':product_id', (int)$item->id, PDO::PARAM_INT);
        $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
        $stmt->execute();

        $sql1 = 'INSERT INTO `product_transfer` (`unique_key`, `product_id`, `imei`, `branch_id`, `transfered_date`)
                VALUES(:unique_key, :product_id, :imei, :branch_id, :transfered_date)';
        $st = $connected->prepare($sql1);
        $st->bindValue(':unique_key', (string)$_SESSION['unique_key'], PDO::PARAM_STR);
        $st->bindValue(':product_id', (int)$item->id, PDO::PARAM_INT);
        $st->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
        $st->bindValue(':imei', (string)$item->imei, PDO::PARAM_STR);
        $st->bindValue(':transfered_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $st->execute();
      }
    }

    unset($_SESSION['unique_key']);
    return true;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function transferProduct Errors: '.$e->getMessage();
  }


  return false;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Color task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getBranchToTransfer() {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $sql = 'SELECT * FROM `branch` WHERE id <> 3';
    $stmt = $connected->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getBranchToTransfer Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Color task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getColorData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `product_color`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `product_color`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Color task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getStorageData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `product_storage`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `product_storage`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}
//function list company
function getcompanyData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `company`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `company`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}
function getPermissionData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' task_name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `task_permission`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `task_permission`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function task_permission Errors: '.$e->getMessage();
  }

  return $result;
}
function getroleData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `role`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `role`';
    $rows = getDataFromSearch($sqlData, '', $kwd, $where);
  
    $newdata = array();
    if (count($rows) > 0)
    {
      $total_data = $rows[0]['total_count'];
        foreach ($rows as $value) {
          $permission                   = getPermissionByRole($value['id']);
          $value['permissions']         = $permission;
          $newdata[] = $value;
        }
    }
    return $newdata;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getroleData Errors: '.$e->getMessage();
  }
  return $result;
}
function getPermissionByRole($role){
  global $debug, $connected;
  $result = 0;
  try {
      $sql = " SELECT sp.*, sf.title AS fn_title FROM `staff_permission` AS sp INNER JOIN staff_function AS sf ON sf.id = sp.staff_function_id WHERE staff_role_id = :staff_role_id";
      $stmt = $connected->prepare($sql);
      $stmt->bindValue(':staff_role_id', (int)$role, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetchAll();
     return $rows;
  }
  catch (\Exception $e)
  {
      $result = 0;
      if ($debug)
      {
          echo 'ERROR: FuncPermission' . $e->getMessage();
          exit;
      }
  }
  return $result;
}
/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Brand task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getBrandData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' br.name LIKE :kwd ';
      $condition .= ' OR m.name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total
            FROM `brand` br INNER JOIN `maker` m ON br.maker_id = m.id';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT br.*, m.name As maker_name
                FROM `brand` br INNER JOIN `maker` m ON br.maker_id = m.id';
    return getDataFromSearch($sqlData, '', $kwd, $where, $limit);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Brand task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getStaffHistoryData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $where = ' WHERE st.deleted_at IS NOT NULL ';
    if(!empty($kwd))  $where .= ' AND st.name LIKE :kwd ';

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total
            FROM `staff` st
            INNER JOIN `branch` br ON st.branch_id = br.id';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT st.*, br.name As branch_name
                FROM `staff` st
                INNER JOIN `branch` br ON st.branch_id = br.id';
    return getDataFromSearch($sqlData, 'st.created_at', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author Sengtha
 * List order by staff_id
 * @param int $staff_id Staff ID
 * @return mixed
 */
function listOrderByStaff($staff_id, $customer_id, $date_from, $date_to, $setLimit = '') {
	global $debug, $connected, $total_data, $offset, $limit;
	$result = true;
	if(!empty($setLimit)) $limit = $setLimit;
	$where = '';
	$condition = '';
	if(!empty($customer_id)) {
		if($condition) $condition .= ' AND ';
		$condition .= ' r.customer_id = :customer_id ';
	}
	if(!empty($staff_id)) {
		if($condition) $condition .= ' AND ';
		$condition .= ' r.staff_id = :staffid ';
	}
	if(!empty($date_from) && !empty($date_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }
    if(!empty($date_from) && empty($date_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) >= :from ';
    }
    if(empty($date_from) && !empty($date_to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) <= :to ';
    }
	if($condition) $where = ' WHERE '.$condition;

	try {
		//Get record from database
		$sql = 'SELECT r.*, r.id AS order_id, r.total AS r_total, c.name AS customer_name, c.phone, (
				SELECT COUNT(*) FROM `order` r INNER JOIN `customer` c ON c.id = r.customer_id '.$where.' ) As total
				FROM `order` r
				INNER JOIN `customer` c ON c.id = r.customer_id
				'.$where.' ORDER BY r.created_at DESC LIMIT :offset, :limit';
		$stmt = $connected->prepare($sql);
		if(!empty($customer_id))	$stmt->bindValue(':customer_id', (int)$customer_id, PDO::PARAM_INT);
		if(!empty($staff_id)) 		$stmt->bindValue(':staffid', (int)$staff_id, PDO::PARAM_INT);
		if(!empty($date_from)) 		$stmt->bindValue(':from', (string)$date_from, PDO::PARAM_STR);
		if(!empty($date_to)) 		$stmt->bindValue(':to', (string)$date_to, PDO::PARAM_STR);
		$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
		$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		$rows_count = count($rows);
		if(0 < $rows_count) $total_data = $rows[0]['total'];

    $new_result = [];
    foreach ($rows as $key => $value) {
      $sql_nostock = 'SELECT COUNT(*) AS totalNoCutStock FROM `order_item` AS oitm
        INNER JOIN product as p ON p.id = oitm.product_id
      WHERE oitm.order_id = :order_id AND p.is_cutting = 2';
      $stmt_nostock = $connected->prepare($sql_nostock);
      $stmt_nostock->bindValue(':order_id', (int)$value['id'], PDO::PARAM_INT);
      $stmt_nostock->execute();
      $row_nostock = $stmt_nostock->fetch();

      $value['totalNoCutStock'] = $row_nostock['totalNoCutStock'];
      $new_result[] = $value;
    }

		return $new_result;
	} catch(PDOException $e) {
		$result = false;
		if($debug)  echo 'Function listOrderByStaff Errors: '.$e->getMessage();
	}

	return $result;
}

/**
 * @author Sengtha
 * List order by customer_id
 * @param int $customer_id Customer ID
 * @return mixed
 */
function listOrderByCustomer($customer_id) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `order` r INNER JOIN staff s ON s.id = r.staff_id WHERE r.customer_id = :customerid ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':customerid', (int)$customer_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $total_data = $row['total'];

    //Step #2 Get Data
    $sqlData = 'SELECT r.*, s.name AS staff_name FROM `order` r INNER JOIN staff s ON s.id = r.staff_id WHERE r.customer_id = :customerid ';
    $stmt = $connected->prepare($sqlData.' ORDER BY r.created_at DESC LIMIT :offset,:limit');
    $stmt->bindValue(':customerid', (int)$customer_id, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getListName Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG, Edited by Sengtha
 * search & pagination for Order List task
 * @param string $kwd Keyword
 * @param string $from order date from
 * @param string $to order date to
 * @param string $branch branch id
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getOrderListData($kwd = '', $from = '', $to = '', $branch = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' s.name = :kwd ';
      $condition .= ' OR c.name = :kwd ';
    }

    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( r.ordered_at, \'%Y-%m-%d\' ) <= :to ';
    }

    if(!empty($branch))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.branch_id = :branch ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT r.*, c.name AS customer_name, s.name AS staff_name, b.name AS branch_name, (
              SELECT COUNT(*)
              FROM `order` r
              INNER JOIN `customer` c ON c.id = r.customer_id
              INNER JOIN `staff` s ON s.id = r.staff_id
              INNER JOIN `branch` b ON b.id = r.branch_id '.$where.'
              ) As total_count
            FROM `order` r
            INNER JOIN `customer` c ON c.id = r.customer_id
            INNER JOIN `staff` s ON s.id = r.staff_id
            INNER JOIN `branch` b ON b.id = r.branch_id '.$where.'
            ORDER BY r.ordered_at DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))  $stmt->bindValue(':kwd', (string)$kwd, PDO::PARAM_STR);
    if(!empty($from) && empty($to)) $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(empty($from) && !empty($to)) $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    if(!empty($branch)) $stmt->bindValue(':branch', (int)$branch, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(0 < count($rows)) $total_data = $rows[0]['total_count'];
    return $rows;
  }
  catch(PDOException $e)
  {
    $result = false;
    if ($debug)
    {
      echo 'ERROR: ' . $e->getMessage();
      exit;
    }
  }

  return $result;
}

/**
 * @author Sengtha
 * Aggregate order
 * @param string $kwd Keyword
 * @param string $from order date from
 * @param string $to order date to
 * @param string $branch branch id
 * @return array
 */
function getSaleData($kwd = '', $from = '', $to = '', $branch = '') {
  global $debug, $connected;
  $result = true;
  try {
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' o.imei = :kwd ';
    }

    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.ordered_at BETWEEN :from AND :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.ordered_at >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.ordered_at <= :to ';
    }

    if(!empty($branch))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' r.branch_id = :branch ';
    }

    if($condition != '') $where = ' WHERE '.$condition;
    $sql = 'SELECT SUM(o.price) AS total_price, SUM(o.cost) AS total_cost, (SUM(o.price) - SUM(o.cost)) As income
            FROM `order_item` o INNER JOIN `order` r ON r.id = o.order_id '.$where;
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))
    {
      $stmt->bindValue(':kwd', (string)$kwd, PDO::PARAM_STR);
    }

    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }

    if(!empty($from) && empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    }

    if(empty($from) && !empty($to))
    {
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }

    if(!empty($branch))
    {
      $stmt->bindValue(':branch', (int)$branch, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetch();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getSaleData Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Product Order task
 * @param string $kwd Keyword
 * @param string $from order date from
 * @param string $to order date to
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getProductOrderData($kwd = '', $from = '', $to = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = ' WHERE oi.deleted_at IS NULL ';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' (oi.title LIKE :kwd OR oi.imei LIKE :kwd) ';
    }

    if(!empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( oi.ordered_item_at, \'%Y-%m-%d\' ) >= :from AND DATE_FORMAT( oi.ordered_item_at, \'%Y-%m-%d\' ) <= :to';
    }

    if(!empty($from) && empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( oi.ordered_item_at, \'%Y-%m-%d\' ) >= :from ';
    }

    if(empty($from) && !empty($to))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' DATE_FORMAT( oi.ordered_item_at, \'%Y-%m-%d\' ) <= :to ';
    }

    //Step #1 Get total record from database
    $sql = 'SELECT oi.*, b.name As brand_name, m.name As maker_name, p.id AS pro_id, ord.status, (
              SELECT COUNT(*)
              FROM `order_item` oi
              INNER JOIN `brand` b ON oi.brand_id = b.id
              INNER JOIN `maker` m ON oi.maker_id = m.id '.$condition.'
              ) As total_count
            FROM `order_item` oi
            INNER JOIN `brand` b ON oi.brand_id = b.id
            INNER JOIN `product` p ON p.imei = oi.imei
            INNER JOIN `maker` m ON oi.maker_id = m.id 
            INNER JOIN `order` ord ON ord.id = oi.order_id '.$condition.'
            ORDER BY oi.ordered_item_at DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    if(!empty($kwd))  $stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    if(!empty($from) && empty($to)) $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
    if(empty($from) && !empty($to)) $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    if(!empty($from) && !empty($to))
    {
      $stmt->bindValue(':from', (string)$from, PDO::PARAM_STR);
      $stmt->bindValue(':to', (string)$to, PDO::PARAM_STR);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if(0 < count($rows))  $total_data = $rows[0]['total_count'];
    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductOrderData Errors: '.$e->getMessage();
  }

  return $result;
}

function getProductOrderDataByImei($imei) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    $sql = 'SELECT oi.*,prs.name AS storage_name, b.name As brand_name, m.name As maker_name, o.customer_id, p.company_title, p.created_at AS pro_date_in
            FROM `order_item` oi
              INNER JOIN `order` o ON o.id = oi.order_id
              INNER JOIN `brand` b ON oi.brand_id = b.id
              INNER JOIN `maker` m ON oi.maker_id = m.id
              INNER JOIN `product` p ON p.imei = oi.imei
              LEFT JOIN `product_storage` prs ON p.storage_id = prs.id
            WHERE oi.deleted_at IS NULL AND oi.imei = :imei LIMIT 0, 1';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', $imei, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch();

    return $rows;
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductOrderDataByImei Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * search & pagination for Maker task
 * @param string $kwd keyword
 * @param string $slimit limit from user
 * @return number of row/ array of data
 */
function getMakerData($kwd = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    if(!empty($kwd))
    {
      if(!empty($condition)) $condition .= ' AND ';
      $condition .= ' name LIKE :kwd ';
    }

    if($condition != '') $where = ' WHERE '.$condition;

    //Step #1 Get total record from database
    $sql = 'SELECT COUNT(*) As total FROM `maker`';
    countTotalData($sql, $kwd, $where);

    //Step #2 Get Data
    $sqlData = 'SELECT * FROM `maker`';
    return getDataFromSearch($sqlData, '', $kwd, $where);
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getMakerData Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * get product report data with searcha ad pagination
 * @param  string  $brand_model brand model
 * @param  string  $status      stutus
 * @param  string  $ordfrom     order date from
 * @param  string  $ordto       order date to
 * @param  string  $slimit      set limit from pg
 * @return array of data
 */
function getProductReportData($brand_model = '', $status = '', $ordfrom = '', $ordto = '', $slimit = '' ) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;

  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = ' WHERE pr.created_at is NOT NULL ';
    $condition .= !empty($brand_model) ? ' AND pr.brand_id = :brand ' : '';
    // $condition .= !empty($status) && 1 == $status ? ' AND pr.deleted_at IS NULL ' : '';
    $condition .= !empty($status) && 2 == $status ? ' AND pr.deleted_at IS NOT NULL ' : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';

    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name,
            ( SELECT COUNT(*)
                FROM `product` pr
                INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
                INNER JOIN `product_color` pc ON pr.color_id = pc.id
                INNER JOIN `maker` mk ON pr.maker_id = mk.id
                INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.'
            ) As total
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.'
            ORDER BY pr.brand_id DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if(!empty($row))  $total_data = $row[0]['total'];
    return $row;
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product stock report data with searcha ad pagination
 * @param  string  $brand_model brand model
 * @param  string  $status      stutus
 * @param  string  $ordfrom     order date from
 * @param  string  $ordto       order date to
 * @param  string  $slimit      set limit from pg
 * @return array of data
 */
function getProductStockData($brand_model = '', $ordfrom = '', $ordto = '', $stock = '', $slimit = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    $condition .= !empty($brand_model) ? (!empty($condition) ? ' AND pr.brand_id = :brand ' : ' pr.brand_id = :brand ') : '';
    $condition .= !empty($status) ? (!empty($condition) ? ' AND pr.status = :status ' : ' pr.status = :status ') : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ') : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .= !empty($stock) ? (!empty($condition) ? ' AND pr.deleted_at IS NULL ' : ' pr.deleted_at IS NULL ') : '';
    $where = !empty($condition) ? ' WHERE '.$condition : '';
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name,
            ( SELECT COUNT(*)
                FROM `product` pr
                INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
                INNER JOIN `product_color` pc ON pr.color_id = pc.id
                INNER JOIN `maker` mk ON pr.maker_id = mk.id
                INNER JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            ) As total
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            ORDER BY pr.created_at DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if(!empty($row))  $total_data = $row[0]['total'];
    return $row;
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product stock in branch
 * @param  string  $brand_model brand model
 * @param  string  $ordfrom    order date from
 * @param  string  $ordto       order date to
 * @param  string  $branch      branch id
 * @param  string  $stock       stock
 * @param  string  $slimit      set limit from pg
 * @return array of data
 */
function getProductStockDataBranch($brand_model = '', $ordfrom = '', $ordto = '', $branch = '', $stock = '', $slimit = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  if(!empty($slimit)) $limit = $slimit;
  try {
    //Create search condition
    $condition = $where = '';
    $condition .= !empty($brand_model) ? (!empty($condition) ? ' AND pr.brand_id = :brand ' : ' pr.brand_id = :brand ') : '';
    $condition .= !empty($status) ? (!empty($condition) ? ' AND pr.status = :status ' : ' pr.status = :status ') : '';
    $condition .= !empty($branch) ? (!empty($condition) ? ' AND pb.branch_id = :branch_id ' : ' pb.branch_id = :branch_id ') : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ') : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .= !empty($stock) ? (!empty($condition) ? ' AND pr.deleted_at IS NULL ' : ' pr.deleted_at IS NULL ') : '';
    $where = !empty($condition) ? ' WHERE '.$condition : '';
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name,
            ( SELECT COUNT(*)
              FROM `product` pr
             	INNER JOIN `product_branch` pb ON pb.product_id = pr.id
             	LEFT JOIN `branch` brn ON brn.id = pb.branch_id
              LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
              LEFT JOIN `product_color` pc ON pr.color_id = pc.id
              LEFT JOIN `maker` mk ON pr.maker_id = mk.id
              LEFT JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            ) As total
            FROM `product` pr
           	INNER JOIN `product_branch` pb ON pb.product_id = pr.id
           	LEFT JOIN `branch` brn ON brn.id = pb.branch_id
            LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            ORDER BY pr.created_at DESC LIMIT :offset, :limit';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($branch)) $stmt->bindValue(':branch_id', (int)$branch, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    if(!empty($row))  $total_data = $row[0]['total'];
    return $row;
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product group brand
 * @param  string  $brand_model brand model
 * @param  string  $ordfrom    order date from
 * @param  string  $ordto       order date to
 * @param  string  $slimit      set limit from pg
 * @return array of data
 */
function getGroupBrandName($brand_model = '', $status = '', $ordfrom = '', $ordto = '', $slimit='') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    if(!empty($slimit)) $limit = $slimit;
    //Create search condition
    $condition = ' WHERE pr.created_at is NOT NULL ';
    $condition .= !empty($brand_model) ? ' AND pr.brand_id = :brand ' : '';
    $condition .= !empty($status) && 1 == $status ? ' AND pr.deleted_at IS NULL ' : '';
    $condition .= !empty($status) && 2 == $status ? ' AND pr.deleted_at IS NOT NULL ' : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';

    $sql = 'SELECT br.id As brand_id, br.name, COUNT( * ) As brand_count
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.'
            GROUP BY pr.brand_id LIMIT :offset,:limit';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product group brand by branch id
 * @param  string  $brand_model brand model
 * @param  string  $ordfrom    order date from
 * @param  string  $ordto       order date to
 * @param  string  $branch      branch id
 * @return array of data
 */
function getGroupBrandNameByBranchID($brand_model = '', $ordfrom = '', $ordto = '', $branch = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    //Create search condition
    $condition = ' WHERE pr.deleted_at is NULL ';
    $condition .= !empty($brand_model) ? ' AND pr.brand_id = :brand ' : '';
    $condition .= !empty($status) ? ' AND pr.status = :status ' : '';
    $condition .= !empty($branch) ? ' AND pb.branch_id = :branch_id ' : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';

    $sql = 'SELECT br.id As brand_id, br.name, COUNT( * ) As brand_count
            FROM `product` pr
            INNER JOIN `product_branch` pb ON pb.product_id = pr.id
            LEFT JOIN `branch` brn ON brn.id = pb.branch_id
            LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id '.$condition.'
            GROUP BY pr.brand_id';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($branch)) $stmt->bindValue(':branch_id', (int)$branch, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product group brand name
 * @param  string  $brand_model brand model
 * @param  string  $ordfrom    order date from
 * @param  string  $ordto       order date to
 * @param  string  $stock       stock
 * @return array of data
 */
function getProductGroupBrandName($brand_model = '', $ordfrom = '', $ordto = '', $stock = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    //Create search condition
    $condition = $where = '';
    $condition .= !empty($brand_model) ? (!empty($condition) ? ' AND pr.brand_id = :brand ' : ' pr.brand_id = :brand ') : '';
    $condition .= !empty($status) ? (!empty($condition) ? ' AND pr.status = :status ' : ' pr.status = :status ') : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ') : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .= !empty($stock) ? (!empty($condition) ? ' AND pr.deleted_at IS NULL ' : ' pr.deleted_at IS NULL ') : '';
    $where = !empty($condition) ? ' WHERE '.$condition : '';
    $sql = 'SELECT br.id As brand_id, br.name, COUNT( * ) As brand_count
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            GROUP BY pr.brand_id';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product group branch name
 * @param  string  $brand_model brand model
 * @param  string  $ordfrom     order date from
 * @param  string  $ordto       order date to
 * @param  string  $stock       stock
 * @param  integer $branch      branch id
 * @return array of data
 */
function getProductGroupBranchName($brand_model = '', $ordfrom = '', $ordto = '', $branch = '', $stock = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    //Create search condition
    $condition = $where = '';
    $condition .= !empty($brand_model) ? (!empty($condition) ? ' AND pr.brand_id = :brand ' : ' pr.brand_id = :brand ') : '';
    $condition .= !empty($status) ? (!empty($condition) ? ' AND pr.status = :status ' : ' pr.status = :status ') : '';
    $condition .= !empty($branch) ? (!empty($condition) ? ' AND pb.branch_id = :branch_id ' : ' pb.branch_id = :branch_id ') : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ') : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? (!empty($condition) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : ' DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ') : '';
    $condition .= !empty($stock) ? (!empty($condition) ? ' AND pr.deleted_at IS NULL ' : ' pr.deleted_at IS NULL ') : '';
    $where = !empty($condition) ? ' WHERE '.$condition : '';
    $sql = 'SELECT brn.id As branch_id, brn.name, COUNT( * ) As branch_count
            FROM `product` pr
            INNER JOIN `product_branch` pb ON pb.product_id = pr.id
            LEFT JOIN `branch` brn ON brn.id = pb.branch_id
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id '.$where.'
            GROUP BY pb.branch_id';
    $stmt = $connected->prepare($sql);
    if(!empty($brand_model)) $stmt->bindValue(':brand', (int)$brand_model, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    if(!empty($branch)) $stmt->bindValue(':branch_id', (int)$branch, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product data brand id
 * @param  string  $brand_id    brand model
 * @param  string  $ordfrom     order date from
 * @param  string  $ordto       order date to
 * @param  string  $status      status
 * @return array of data
 */
function getProductDataByBrandID($brand_id, $status = '', $ordfrom = '', $ordto = '', $slimit) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    if(!empty($slimit)) $limit = $slimit;
    $condition = ' WHERE pr.created_at is NOT NULL AND pr.brand_id = :brand ';
    $condition .= !empty($status) && 1 == $status ? ' AND pr.deleted_at IS NULL ' : '';
    $condition .= !empty($status) && 2 == $status ? ' AND pr.deleted_at IS NOT NULL ' : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.deleted_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.' ORDER BY pr.brand_id ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand', (int)$brand_id, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR in function getProductDataByBrandID: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product stock by brand id
 * @param  integer  $brand_id brand id
 * @param  string  $ordfrom  order date from
 * @param  string  $ordto    order data to
 * @param  string  $stock    stock number
 * @return array of data
 */
function getProductStockDataByBrandID($brand_id, $ordfrom = '', $ordto = '', $stock = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $condition = ' WHERE pr.brand_id = :brand ';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .= !empty($stock) ? ' AND pr.deleted_at IS NULL ' : '';
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name
            FROM `product` pr
            INNER JOIN `product_storage` ps ON pr.storage_id = ps.id
            INNER JOIN `product_color` pc ON pr.color_id = pc.id
            INNER JOIN `maker` mk ON pr.maker_id = mk.id
            INNER JOIN `brand` br ON pr.brand_id = br.id '.$condition.' ORDER BY pr.created_at DESC';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand', (int)$brand_id, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR in getProductStockDataByBrandID: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * get product stock by branch id
 * @param  integer  $brand_id brand id
 * @param  string  $ordfrom  order date from
 * @param  string  $ordto    order data to
 * @param  integer  $branch_id branch id
 * @param  string  $stock    stock number
 * @return array of data
 */
function getProductStockDataByBranchID($brand_id, $ordfrom = '', $ordto = '', $branch = '', $stock = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $condition = ' WHERE pb.branch_id = :branch ';
    $condition .= !empty($brand_id) ? (!empty($condition) ? ' AND pr.brand_id = :brand ' : ' pr.brand_id = :brand ') : '';
    $condition .= !empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .=  !empty($ordfrom) && empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) >= :ordfrom ' : '';
    $condition .=  empty($ordfrom) && !empty($ordto) ? ' AND DATE_FORMAT( pr.created_at, \'%Y-%m-%d\' ) <= :ordto ' : '';
    $condition .= !empty($stock) ? ' AND pr.deleted_at IS NULL ' : '';
    $sql = 'SELECT pr.*, ps.name As storage_name, pc.name As color_name, mk.name As maker_name, br.name As brand_name
            FROM `product` pr
            INNER JOIN `product_branch` pb ON pb.product_id = pr.id
            LEFT JOIN `branch` brn ON brn.id = pb.branch_id
            LEFT JOIN `product_storage` ps ON pr.storage_id = ps.id
            LEFT JOIN `product_color` pc ON pr.color_id = pc.id
            LEFT JOIN `maker` mk ON pr.maker_id = mk.id
            LEFT JOIN `brand` br ON pr.brand_id = br.id '.$condition.' ORDER BY pr.created_at DESC ';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':branch', (int)$branch, PDO::PARAM_INT);
    if(!empty($brand_id)) $stmt->bindValue(':brand', (int)$brand_id, PDO::PARAM_INT);
    if(!empty($ordfrom) && !empty($ordto)) {
      $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
      $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    }
    if(!empty($ordfrom) && empty($ordto)) $stmt->bindValue(':ordfrom', (string)$ordfrom, PDO::PARAM_STR);
    if(empty($ordfrom) && !empty($ordto)) $stmt->bindValue(':ordto', (string)$ordto, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR in getProductStockDataByBranchID: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * @author CHHOM CHHUNMENG
 * get total of row from table
 * @param $sql sql statement
 * @param string $kwd keyword
 * @param string $where condition
 * @return total row of data
 */
function countTotalData($sql, $kwd = '', $where = '') {
  global $debug, $connected, $total_data;
  if(!empty($where))  $sql .= ' '.$where;
  try {
    $st = $connected->prepare($sql);
    if(!empty($kwd))  $st->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    $st->execute();
    $row = $st->fetch();
    $total_data = $row['total'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function countTotalData Errors: '.$e->getMessage();
  }

  return;
}

/**
 * @author CHHOM CHHUNMENG
 * get data from table
 * @param string $sql sql statement
 * @param string $orderBy order by field name
 * @param string $kwd keyword
 * @param string $where condition
 * @param string $slimit limit from user
 * @return array of data
 */
function getDataFromSearch($sql, $orderBy, $kwd = '', $where = '', $slimit = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  if(!empty($slimit)) $limit = $slimit;
  if(!empty($where))  $sql .= ' '.$where;
  if(!empty($orderBy))  $sql .= ' ORDER BY '.$orderBy.' DESC ';
  try {
    $stmt = $connected->prepare($sql.' LIMIT :offset,:limit');
    if(!empty($kwd))  $stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getDataFromSearch Errors: '.$e->getMessage();
  }

  return;
}

/**
 * @author: CHHOM CHHUNMENG
 * get data from product
 * @param $imei imei number of phone
 * @return array of data
 */
function getProductDataByImei($imei, $branch_id, $staus) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pr.imei, pr.title, st.name AS storage_name, clr.name AS color_name, pr.price, pr.description
            FROM `product` pr
            INNER JOIN `product_storage` st ON pr.storage_id = st.id
            INNER JOIN `product_color` clr ON pr.color_id = clr.id
            LEFT JOIN `product_branch` pb ON pb.product_id = pr.id
            WHERE pr.deleted_at IS NULL 
            AND pb.branch_id IS NOT NULL 
            AND pb.branch_id = :branch_id 
            AND pr.imei = :imei';
    
    if ($staus == 1) {
        $sql .= ' AND pr.status = 1 AND pr.is_cutting = 1 ';
    } elseif ($staus == 2) {
        $sql .= ' AND pr.is_cutting = 2';
    }
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':imei', (string)$imei, PDO::PARAM_STR);
    $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
    $stmt->execute(); 
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rows) {
        $rows['quantity'];
        if ($rows['description'] == '') $rows['description'] = 'Original';
    }
    return $rows;
      
  } catch (PDOException $e) {
      echo 'Function getListName Errors: '.$e->getMessage();
      return false;
  }
  return $result;
}

/**
 * @created: 27-12-2015
 * @author CHHOM CHHUNMENG
 * edit color data
 * @return bool
 */
function getProductBranchId($product_id, $branch_id='') {
  global $debug, $connected;
  $result = true;
  try {
    $condition = '';
    if($branch_id) $condition = '  AND br.id = :branch_id ';

    $sql = 'SELECT br.name As branch_name
            FROM `branch` br INNER JOIN `product_branch` pbr ON br.id = pbr.branch_id
            WHERE pbr.product_id = :product_id '.$condition;
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    if(!empty($branch_id))  $stmt->bindValue(':branch_id', $branch_id, PDO::PARAM_INT);

    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['branch_name'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductBranchId Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * get product transferred history in detail
 * @param  string  $unique_key [description]
 * @return array of data
 */
function getProductTransferHistoryDetail($unique_key) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT pt.*, br.name As branch_name, pr.title, pr.price, str.name As storage_name, clr.name As color_name,
              mkr.name As maker_name, brd.name As brand_name
            FROM `product_transfer` pt
            INNER JOIN `product` pr ON pr.id = pt.product_id
            INNER JOIN `branch` br ON pt.branch_id = br.id
            LEFT JOIN `product_storage` str ON str.id = pr.storage_id
            LEFT JOIN `product_color` clr ON clr.id = pr.color_id
            LEFT JOIN `maker` mkr ON mkr.id = pr.maker_id
            LEFT JOIN `brand` brd ON brd.id = pr.brand_id
            WHERE pt.unique_key = :unique_key';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':unique_key', (string)$unique_key, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function getProductTransferHistoryDetail Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * get product stock summary by branch & brand_id
 * @param  integer  $branch_id branch id
 * @param  string  $brand_id   brand id
 * @return array of data
 */
function getProductStockSummary($branch_id, $brand_id = '', $status = '') {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    //Create search condition
    $condition = '';
    $condition .= !empty($brand_id) ? ' AND pro.brand_id= :brand_id ' : '';
    $condition .= !empty($status) ? ' AND pro.status= :status ' : '';
    $sql = 'SELECT prb.branch_id As branch_id, brd.id AS brand_id, brd.name As brand_name
            FROM `product` pro
            INNER JOIN `brand` brd ON pro.brand_id = brd.id
            INNER JOIN `product_branch` prb ON prb.product_id = pro.id
            WHERE prb.branch_id = :branch_id '.$condition.'
            GROUP BY pro.brand_id';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':branch_id', (int)$branch_id, PDO::PARAM_INT);
    if(!empty($brand_id)) $stmt->bindValue(':brand_id', (int)$brand_id, PDO::PARAM_INT);
    if(!empty($status)) $stmt->bindValue(':status', (int)$status, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $rows_count = count($rows);
    for ($i=0; $i < $rows_count; $i++) {
      $rows[$i]['inStockYesterday']  = checkProductInStockYesterday($rows[$i]['branch_id'], $rows[$i]['brand_id']);
      $rows[$i]['outStockToday']     = checkProductOutStock($rows[$i]['branch_id'], $rows[$i]['brand_id']);
      $rows[$i]['newStockToday']     = checkProductNewStock($rows[$i]['branch_id'], $rows[$i]['brand_id']);
      $rows[$i]['inStockToday']      = checkProductInStock($rows[$i]['branch_id'], $rows[$i]['brand_id']);
      $rows[$i]['inStockYesterday'] += $rows[$i]['outStockToday'];
    }

    return $rows;

  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR: ' . $e->getMessage(); exit; }
  }

  return $result;
}

/**
 * check product in stock yesterday for summary report
 * @param  integer  $branch_id branch id
 * @param  string  $brand_id   brand id
 * @return number of stock balance yesterday
 */
function checkProductInStockYesterday($branch_id, $brand_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT COUNT(*) As inStockYesterday
            FROM `product` pro INNER JOIN `brand` brd ON brd.id = pro.brand_id
            INNER JOIN `product_branch` prb ON prb.product_id = pro.id
            INNER JOIN `branch` brn ON brn.id = prb.branch_id
            WHERE prb.branch_id = :branch_id AND pro.brand_id = :brand_id AND pro.status = 1 AND pro.deleted_at IS NULL AND DATE_FORMAT(pro.created_at, \'%Y-%m-%d\') < CURDATE()';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand_id', (string)$brand_id, PDO::PARAM_INT);
    $stmt->bindValue(':branch_id', (string)$branch_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['inStockYesterday'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkProductInStockYesterday Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * check product in new stock today for summary report
 * @param  integer  $branch_id branch id
 * @param  string  $brand_id   brand id
 * @return number of new stock today
 */
function checkProductNewStock($branch_id, $brand_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT COUNT(*) As newStockToday
            FROM `product` pro INNER JOIN `brand` brd ON brd.id = pro.brand_id
            INNER JOIN `product_branch` prb ON prb.product_id = pro.id
            INNER JOIN `branch` brn ON brn.id = prb.branch_id
            WHERE prb.branch_id = :branch_id AND pro.brand_id = :brand_id AND pro.status = 1 AND DATE_FORMAT(pro.created_at, \'%Y-%m-%d\') = CURDATE()';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand_id', (string)$brand_id, PDO::PARAM_INT);
    $stmt->bindValue(':branch_id', (string)$branch_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['newStockToday'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkProductNewStock Errors: '.$e->getMessage();
  }

  return $result;
}


/**
 * check product in stock sold out for summary report
 * @param  integer  $branch_id branch id
 * @param  string  $brand_id   brand id
 * @return number of stock sold out
 */
function checkProductOutStock($branch_id, $brand_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT COUNT(*) As outStockToday
            FROM `product` pro INNER JOIN `brand` brd ON brd.id = pro.brand_id
            INNER JOIN `product_branch` prb ON prb.product_id = pro.id
            INNER JOIN `branch` brn ON brn.id = prb.branch_id
            WHERE prb.branch_id = :branch_id AND pro.brand_id = :brand_id AND pro.status = 1 AND DATE_FORMAT(pro.deleted_at, \'%Y-%m-%d\') = CURDATE()';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand_id', (string)$brand_id, PDO::PARAM_INT);
    $stmt->bindValue(':branch_id', (string)$branch_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['outStockToday'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkProductOutStock Errors: '.$e->getMessage();
  }

  return $result;
}

/**
 * check product in stock for summary report
 * @param  integer  $branch_id branch id
 * @param  string  $brand_id   brand id
 * @return number of stock balance today
 */
function checkProductInStock($branch_id, $brand_id) {
  global $debug, $connected;
  $result = true;
  try {
    $sql = 'SELECT COUNT(*) As inStockToday
            FROM `product` pro INNER JOIN `brand` brd ON brd.id = pro.brand_id
            INNER JOIN `product_branch` prb ON prb.product_id = pro.id
            INNER JOIN `branch` brn ON brn.id = prb.branch_id
            WHERE prb.branch_id = :branch_id AND prb.branch_id = :branch_id AND pro.status = 1 AND pro.brand_id = :brand_id AND pro.deleted_at IS NULL';
    $stmt = $connected->prepare($sql);
    $stmt->bindValue(':brand_id', (string)$brand_id, PDO::PARAM_INT);
    $stmt->bindValue(':branch_id', (string)$branch_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetch();
    return $rows['inStockToday'];
  } catch(PDOException $e) {
    $result = false;
    if($debug)  echo 'Function checkProductInStock Errors: '.$e->getMessage();
  }

  return $result;
}

function getProcutNote($kwd, $s_offset, $s_limit) {
  global $debug, $connected, $total_data, $offset, $limit;
  $result = true;
  try {
    $condition = '';

    if(!empty($kwd)) $condition = ' WHERE note LIKE :kwd ';

    $sql = ' SELECT *, (SELECT COUNT(*) FROM (SELECT COUNT(*) FROM `note` '.$condition.' GROUP BY note) AS total_g) AS total FROM `note` '.$condition.' GROUP BY note LIMIT :offset, :limit ';
    $stmt = $connected->prepare($sql);

    if(!empty($kwd)) $stmt->bindValue(':kwd', '%'.$kwd.'%', PDO::PARAM_STR);
    $stmt->bindValue(':offset', (int)$s_offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$s_limit, PDO::PARAM_INT);
    $stmt->execute();
    $datas = $stmt->fetchAll();
    if(count($datas) > 0) $total_data = $datas[0]['total'];
    $dic = array();

    foreach($datas AS $data)
    {
      $dic[] = array('id' => $data["id"], 'text'=> $data['note']);
    }

    return $dic;
  } catch(PDOException $e) {
    $result = false;
    if ($debug) { echo 'ERROR in getProcutNote: ' . $e->getMessage(); exit; }
  }

  return $result;
}
