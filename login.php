<?php
if($_POST)
{
    include 'db.php';
    $userid = $_POST['userid'];
    $password = $_POST['pwd'];    
    $collection = $db->User;
    $cursor = $collection->findOne(array("uid" => $userid, "password" => $password));
    if($cursor)
    {
        $collection = $db->session;
        $session_id = $_COOKIE['sessionid'];
        $session_id = md5(uniqid(mt_rand(), true));
        $end_time = '31536000';
        $result = $collection->insertOne(array('username'=>$userid,'sessionid' => $session_id,'expiry' => $end_time, 'session_data' => 'a:0:{}'));  
        setcookie("sessionid", $session_id);
        $designation = $cursor['role'];
        echo $designation;
    }
    else
    {
        echo "404";
    }
}
else
{
    header("refresh:0;url=notfound.html");
}
?>