<?php
function getDB(){
    $connection = (mysqli_connect('localhost','root','','sarc_db')) or die(mysql_error());
    
    return $connection;
}

function generateAuthCode($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function throw_error($error){
$err = array("status"=>"fail","error"=>"$error");
    
    echo json_encode($err);
    http_response_code(500);
    exit();
}

?>