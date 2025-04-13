<?php

ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
    "lifetime" => 1800,
    "domain" => "localhost",
    "path" => "/",
    "secure" => true,
    "httponly" => true
]);

 session_start();

 function regenerate_session_id_loggedin(){
   session_regenerate_id(true);

   $userid = $_SESSION["User_id"]; /* sets the $userid variable to the user's id from the database if the user is logged in*/

   $newsessionId = session_create_id();
   $sessionid = $newsessionId . "_" . $userid; /* we could use the $result variable which is in the Login handler.php file but it is only accessible in that file, thats why we create a new variable (which is $userid) and append it with the new session id */

   session_id($sessionid);

   $_SESSION["last_regeneration"] = time();
}
function session_id_regeneration(){
   session_regenerate_id(true);
       $_SESSION["last_regeneration"] = time();
}


 if(isset($_SESSION["User_id"]))/* check if the user is logged in */
 {
    if (!isset($_SESSION["last_regeneration"])){

        regenerate_session_id_loggedin();/* appends the user's id once we regenerate the user's id once the user is logged into the website */
    
     } else{
        $interval = 60 * 30;
        if(time() - $_SESSION["last_regeneration"] >= $interval){
    
            regenerate_session_id_loggedin();
        }
     }
 } else {
    if (!isset($_SESSION["last_regeneration"])){

        session_id_regeneration();
    
     } else{
        $interval = 60 * 30;
        if(time() - $_SESSION["last_regeneration"] >= $interval){
    
            session_id_regeneration();
        }
     }
 }

 if (!isset($_SESSION["last_regeneration"])){

    session_id_regeneration();

 } else{
    $interval = 60 * 30;
    if(time() - $_SESSION["last_regeneration"] >= $interval){

        session_id_regeneration();
    }
 }


