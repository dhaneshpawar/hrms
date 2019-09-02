<?php

if($_POST)
{
    $department = $_POST['deptchoice'];
    $prfno = $_POST['prfno'];
    include 'db.php';
    $collection = $db->prfinfo;
    $result = $collection->findOne(array("department"=>$department , "prfno"=>$prfno));
    if($result)
    {
        $user = $_COOKIE['sessionid'];
        $collection = $db->session;
        $cursor = $collection->findOne(array("sessionid" => $user));
        if($result['userid'] == $cursor['username'])
        {
            echo "success";
        }
        else
        {
            echo "denied";
        }
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