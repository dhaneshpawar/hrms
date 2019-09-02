<?php

include 'db.php';
$user = $_COOKIE['sessionid'];
$len = strlen($user);
if($len > 1)
{
    echo "404";
}
else
{
    $collection = $db->session;
    $cursor = $collection->findOne(array("sessionid" => $user));
    if($cursor['username'])
    {
        $collection = $db->login;
        $cursor = $collection->findOne(array("userid" => $cursor['username']));
        $designation = $cursor['designation'];
        echo $designation;
    }
}

?>