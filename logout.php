<?php
// if($_POST)
// {
    include 'db.php';
    $sessiondb = $db->session;
    $user = $_COOKIE['sessionid'];
    $criteria = array("sessionid"=>$user);
    $sessiondb->deleteMany($criteria);
    setcookie("sessionid"," ");
// }
// else
// {
//     echo "Some Error Occured";
// }
?>