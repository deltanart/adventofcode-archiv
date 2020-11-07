<?php
function encrypter($Value, $Salt){
    return sha1($Salt . $Value . $Salt);
}

function is_Correct_Hash($Hash, $Value, $Salt){
    return $Hash === encrypter($Value, $Salt) ? TRUE : FALSE;
}

$Value = "MySecretString";
$Salt = "SuperSalty";

$Hash = encrypter($Value, $Salt);
if(is_Correct_Hash($Hash, $Value, $Salt)){
    echo "True\n";
}else{
    echo "False\n";
} 