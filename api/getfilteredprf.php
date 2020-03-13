<?php 
include "db.php";
    // if($_POST)
    // {

        
//Sarang Yesterday  13/03/2020
        if($_POST['dept'] && $_POST['condition'] == "history")
        {
            echo "Gotcha";
            if($cursor)
            {
                $i = 0;
                $ctr = 0;
                $p = 0;
            
                foreach($cursor as $doc)
                {
                    $c=$db->prfs->findOne(array("prf"=>$doc['prf']));
                    $arr[$i] =array($doc['prf'],$c['position'],$c['zone'],$c['department'],$doc['pos'],$doc['iid'],$doc['status']);
                    $i++;
                }
                
                echo json_encode($arr);
            }
        }

        if($_POST['dept'] == "All" && $_POST['condition'] != "history")
        {
            $cursor = $db->prfs->find(array("status"=>"open"));
            $i=0;
            foreach($cursor as $doc)
            {
                $arr[0]=$doc['prf'];
                $arr[1]=$doc['position'];
                $arr[2]=$doc['zone'];
                $arr[3]=$doc['department'];
                $arr[4]=$doc['pos'];
                $arr[5]=$doc['status'];
                $arr[6]=$doc['progress'];
                $arr2[$i] = $arr;
                $i=$i+1;
            }
            echo(json_encode($arr2));
        }
        else
        {
            $cursor = $db->prfs->find(array("department"=>$_POST['dept'],"status"=>"open"));
            $i=0;
            foreach($cursor as $doc)
            {
                $arr[0]=$doc['prf'];
                $arr[1]=$doc['position'];
                $arr[2]=$doc['zone'];
                $arr[3]=$doc['department'];
                $arr[4]=$doc['pos'];
                $arr[5]=$doc['status'];
                $arr[6]=$doc['progress'];
                $arr2[$i] = $arr;
                $i=$i+1;
            }
            echo(json_encode($arr2));
    
        }
       
        

?>