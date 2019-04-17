<?php

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function generateAutoIncrementNumber($table_name, $col_primary_key) {
    $value = "1 0 0 0";
    $query = DB::getInstance()->query("SELECT MAX(" . $col_primary_key . ") AS last_insert FROM " . $table_name . "");
    $trail = 1;
    foreach ($query->results() as $query) {
        $trail += $query->last_insert;
    }
    switch ($trail) {
        case $trail:
            if ($trail >= 1 && $trail < 10) {
                $data = (explode(' ', $value, 4));
                $value = $data[0] . $data[1] . $data[2] . $trail;
                break;
            }
        case $trail:
            if ($trail >= 10 && $trail < 100) {
                $data = (explode(' ', $value, 4));
                $value = $data[0] . $data[1] . $trail;
                break;
            }
        case $trail:
            if ($trail >= 100 && $trail < 1000) {
                $data = (explode(' ', $value, 4));
                $value = $data[0] . $trail;
                break;
            }
        case $trail:
            if ($trail >= 1000) {
                $value = $trail;
                break;
            }

        default:
            $value = $trail;
            break;
    }
    return $value;
}

function getLastInsertId($table_name, $col_primary_key) {
    $query = DB::getInstance()->query("SELECT MAX(" . $col_primary_key . ") AS last_insert FROM " . $table_name . "");
    foreach ($query->results()as $query) {
        $query->last_insert;
    }
    return $query->last_insert;
}

function getProductName($id_stock) {
//    $values = array();
    $make = '';
    $model = '';
    $manufacturer = '';
    $chasis = '';
    $engine = '';
    $plate = '';
    $product_query = DB::getInstance()->query("SELECT * FROM stock s, stock_name n WHERE s.id_stock_name = n.id_stock_name AND s.id_stock = $id_stock");
    foreach ($product_query->results() as $product_query) {
        $make = $product_query->stock_make;
        $model = $product_query->stock_model;
        $manufacturer = $product_query->stock_manufacturer;
        $chasis = $product_query->chasis_number;
        $engine = $product_query->engine_number;
        $plate = $product_query->plate_number;
    }
    return $make . ' ' . $model . ' CHS  ' . $chasis . ' EGN ' . $engine . ' PLT ' . $plate;
}

function getProuctPrice($table, $stock_id, $id_price_type) {
    $price = 0;
    try {
        $sales_query = DB::getInstance()->query("SELECT * FROM stock_prices WHERE id_stock =  $stock_id AND id_stock_price_type = $id_price_type");
        foreach ($sales_query->results() as $sales_query) {
            $price = $sales_query->stock_price;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $price;
}

function selectSum($table_name, $column, $where) {
    $query = DB::getInstance()->query("SELECT SUM(" . $column . ")AS total FROM " . $table_name . " WHERE " . $where . " ");
    foreach ($query->results() as $value) {
        $value->total;
    }
    return $value->total;
}

function submissionReport($type, $message) {
    if ($type == 'success') {
        $alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">' . $message . '</p></div>';
    } elseif ($type == 'error') {
        $alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">' . $message . '</p>
              </div>';
    }
    return $alert;
}

function countEntries($table_name, $column, $where) {
    try {
        $query = DB::getInstance()->query("SELECT COUNT(" . $column . ")AS total FROM " . $table_name . " WHERE " . $where . " ");
        foreach ($query->results() as $value) {
            $value->total;
        }
        return $value->total;
    } catch (Exception $e) {
        return $e;
    }
}

 function renameUploadedFile($filename,$file_ext){
        $file = array();

          $file =explode('.',$filename);
          $new_file_name =$file[0].'-'.date('H-i-s').'.'.$file_ext;
          return $new_file_name;
}
