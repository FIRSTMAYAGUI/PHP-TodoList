<?php
 declare(strict_types=1);

function verify_input(string $username, string $pwd) //checking if the input fields are empty
{
    if(empty($username) || empty($pwd)){
       return true;
      } 
     else {
        return false;
      }
}

function verify_user_name(object $pdo, string $username) /* check if the entered user name is not already in the database */
{
    if(get_username($pdo, $username)){
        return true;
    }else{
        return false;
      }
}

function create_user(object $pdo, string $confirm_pwd, string $username, string $pwd)
{
    set_user($pdo, $confirm_pwd, $username, $pwd);
}
