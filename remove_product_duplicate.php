<?php
/**
 * remove_product_duplicate.php
 * CLI / background script that deduplicates products by IMEI.
 * Updated for PHP 8.x
 */
session_start();
require_once __DIR__ . '/setup.php';
require_once __DIR__ . '/admin_setting.php';

function getProductDuplicateAndDelete(): mixed
{
    global $debug, $connected;
    $result = 0;
    try {
        $sql  = "SELECT p.imei, COUNT(*) AS total FROM `product` p GROUP BY p.imei HAVING total >= 2";
        $stmt = $connected->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $key => $val) {
            $imei = trim($val['imei']);

            // Fetch all duplicates, newest first
            $sql1  = "SELECT * FROM `product` WHERE imei LIKE :imei ORDER BY id DESC";
            $stmt1 = $connected->prepare($sql1);
            $stmt1->bindValue(':imei', '%' . $imei . '%', PDO::PARAM_STR);
            $stmt1->execute();
            $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows1 as $k => $pex) {
                if ($k === 0) {
                    // Keep the newest — normalise IMEI
                    $sql2  = "UPDATE `product` SET `imei` = :imei WHERE `product`.`id` = :pid";
                    $stmt2 = $connected->prepare($sql2);
                    $stmt2->bindValue(':pid',  (int)$pex['id'], PDO::PARAM_INT);
                    $stmt2->bindValue(':imei', $imei,           PDO::PARAM_STR);
                    $stmt2->execute();

                    // Sync note table
                    $sql3  = "UPDATE `note` SET `imei` = :imei WHERE `note`.`imei` = :wimei";
                    $stmt3 = $connected->prepare($sql3);
                    $stmt3->bindValue(':wimei', $val['imei'], PDO::PARAM_STR);
                    $stmt3->bindValue(':imei',  $imei,       PDO::PARAM_STR);
                    $stmt3->execute();

                    // Sync order_item table
                    $sql4  = "UPDATE `order_item` SET `imei` = :imei WHERE `order_item`.`imei` = :wimei";
                    $stmt4 = $connected->prepare($sql4);
                    $stmt4->bindValue(':wimei', $val['imei'], PDO::PARAM_STR);
                    $stmt4->bindValue(':imei',  $imei,       PDO::PARAM_STR);
                    $stmt4->execute();
                } else {
                    // Delete the older duplicate
                    $sql5  = "DELETE FROM `product` WHERE `product`.`id` = :pid";
                    $stmt5 = $connected->prepare($sql5);
                    $stmt5->bindValue(':pid', (int)$pex['id'], PDO::PARAM_INT);
                    $stmt5->execute();
                }
            }
        }

        echo "Successful";
        return $rows;
    } catch (\Exception $e) {
        $result = 0;
        if ($debug) {
            echo 'ERROR: getProductDuplicateAndDelete ' . $e->getMessage();
            exit;
        }
    }
    return $result;
}

getProductDuplicateAndDelete();
