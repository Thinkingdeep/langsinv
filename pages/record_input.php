<?php
require_once('core/init.php');
if (Input::exists() && Input::get('new_customer')=='new_customer') {

    // if (Input::get('new_customer')) {
        $name = Input::get('customer_name');
        $address = Input::get('customer_address');
        $telephone = Input::get('customer_telephone');
        $email = Input::get('customer_email');
        echo 'success'.$email;
        if(DB::getInstance()->checkRows("SELECT * FROM clients WHERE name='$name' AND address = '$address' AND telephone = '$telephone'"
                . " AND email = '$email' AND id_client_type = 1")){
    echo '< h1>Error</hi>';
            
        }else{
            $arrayClient = array("name"=>$name,"address"=>$address,"telephone"=>$telephone,"email"=>$email,"id_client_type"=>1);
            DB::getInstance()->insert('clients',$arrayClient);
        }
    // }
}

