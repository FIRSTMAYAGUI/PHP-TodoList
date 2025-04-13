<?php
declare(strict_types=1);

function verify_inputs(string $username, string $userpwd){
    if(empty($username)  || empty($userpwd)) {
        return true;
    } else {
        return false;
    }
}

function verify_if_username_is_wrong(bool|array $result){
    if(!$result){
        return true;
    }else{
        return false;
      }
}
function verify_if_the_password_wrong(string $userpwd, string $hashedpwd){
    if(!password_verify($userpwd, $hashedpwd)){
        return true;
    }else{
        return false;
    }
}

?>