<?php 
    include "db.php";
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    $digit13 = explode("-",$_POST['id']);

    $findcandidate = $db->interviews->findOne(array("prf"=>$digit13[0] , "pos"=>$digit13[1] , "iid"=>$digit13[2] , "rid"=>$digit13[3] , "intvmail"=>$cursor['mail']));
    // echo(json_encode($findcandiate['members']));


    $members = $findcandidate['members'];
    $arr = array();
    $i=0;
    if($findcandidate)
    {
        foreach($members as $d)
        {
            // echo "Mail".$d;
            $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
            $arr[$i]=array($getselectednames['full_name'],$d);
            $i++;
        }
         echo json_encode($arr);
    }
    else
    {
        echo "nooooooo";
    }

?>