<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="./public/css/w3.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>


</head>
<style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>

<body>


  <!-- Modal Structure -->
  <div id="modal1" class="modal" style="width:90%">
    <div class="modal-content">
        
      <table style="border-radius:5px solid black;">
        <tr id="modalheader" >
                  
          <th>Instance ID	</th>
          <th>Instance Name	</th>
          <th>Submissiong Date	</th>
          <th>Requester	</th>
          <th>Position Details</th>	
          <th>Production Line	</th>
          <th>Hiring Type	</th>
          <th>Classification 100</th>	
          <th>Classification 110	</th>
          <th>Classification 111	</th>
          <th>Zone	</th>
          <th>Branch	</th>
          <th>Cost Center Name</th>	
          <th>Cost Center Code	</th>
          <th>Department	</th>
          <th>Location	</th>
          <th>Number of Position Open </th>	
          <th>Workforce Classification	</th>
          <th>Request Type	</th>
          <th>Employee Code & 8ID	</th>
          <th>Employee Name	</th>
          <th>New Joiner 8 ID	</th>
          <th>New Joiner Name	</th>
          <th>Required Date	</th>
          <th>Reporting To	</th>
          <th>Budget CTC in INR </th>	
          <th>Internal Posting Recommended	</th>
          <th>Status	</th>
          <th>Next Handler</th>
        </tr>
        
        <tr  id="modalrow">
        <!-- td will go here -->
        </tr>
      </table>
      
    </div>

  </div>

<div class="w3-sidebar blue w3-bar-block" style="width:15%;border: 5px solid white;">

<h3 class="w3-bar-item"><a href="/thyssenkrup/"><center>Home</center></a></h3> <br><br>
  <a href="/thyssenkrup/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/thyssenkrup/hrnew.php" class="w3-bar-item w3-button white">Create New Instance</a> <br>
  <a href="/thyssenkrup/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/thyssenkrup/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/thyssenkrup/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/thyssenkrup/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/thyssenkrup/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/thyssenkrup/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>


</div>
<div style="margin-left:15%">

    <nav>
        <div class="nav-wrapper blue darken-1">
        <a href="/thyssenkrup/">
            <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
            </a> 
      
            <a href="#!" class="brand-logo center">thyssenkrupp</a>
            <div id="logoutuser" class="row">
          <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
        </div>
          </div>
        </nav>
        <br><br>
          
          <select id='rgchoice' class="dropdown-trigger btn blue darken-1 " style="width:19%">
          <option value="" disabled selected style="color: white">Select Department</option>
          </select>
          <br>
        <br>

 <div class="row">

<div class="col s12  blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          <th>Instance ID</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Status</th>
          <th>Initiate</th>
      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<br>
<center>
<button class="button" id="kindlybtn">Kindly Enter the email IDs for below PRF</button>
</center>
<br>
<div class="col s7 offset-m3 blue lighten-4" id="selectedrow">
  <table class="striped">
    <thead>
      <tr>
          <th>Instance ID</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Status</th>
      </tr>
    </thead>

    <tbody id='rawdata'>
    <td id="oniid"></td>
    <td id="onpos"></td>
    <td id="onzone"></td>
    <td id="ondept"></td>
    <td id="onnpos"></td>
    <td id="onsts"></td>
      
    </tbody>
  </table>
</div> 
</div>
<br>

 

<div class="row" id="dumpdiv">
    <div class="col s4 offset-m5">
      <div class="card white darken-1">
        <div class="card-content blue-text">
          <span class="card-title"><b><center>Upload Email Dump</center></b></span>
<script>


function showmodal(x)
{
  $("#modalrow").text("")      
  $.ajax({
    url:'http://localhost/thyssenkrup/api/getfullprf.php',
    type:'POST',
    data:
    {
      'prf':x
    },
    success:function(para)
    {
      para = JSON.parse(para)
      console.log("this is asdassd",para)
      for(let i=0;i<para.length;i++)
      {
        var str = '<td>'+para[i]+'</td>'
        $("#modalrow").append(str)      
      }
    }
  })
}



$('#kindlybtn').hide();
$('#selectedrow').hide();


$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/thyssenkrup/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/thyssenkrup/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("/thyssenkrup/")
}
} 

})

});

var id;

function xyz(x)
{

  $('#kindlybtn').show();
  $('#selectedrow').show();

  $(document.getElementById(x)).attr("disabled","disabled")
  j=x
  // alert(j)
  var res = j.split("*");
  id='#'+res[0];
  // alert("Here - "+res[0])
  window.prf = res[0]
  window.position = res[1]
  window.zone = res[2]
  window.dept = res[3]
  window.pos =res[4]
  window.status = res[5]
 
  console.log("position  - ",window.position );

 
  // <td id="oniid">one</td>
  //   <td id="onpos">one</td>
  //   <td id="onzone">one</td>
  //   <td id="ondept">one</td>
  //   <td id="onnpos">one</td>
  //   <td id="onsts">one</td>

    $("#oniid").html(res[0])
    $("#onpos").html(res[1])
    $("#onzone").html(res[2])
    $("#ondept").html(res[3])
    $("#onnpos").html(res[4])
    $("#onsts").html(res[5])

  // data = {'prf':prf,'dept':dept,'pos':pos,'zone':zone,'posno':posno,'status':status}
  // alert(window.prf)
  $('#dumpdiv').fadeIn();
  $('#submitmaildump').fadeIn();
  $('#emailcollection').fadeIn();
  $('#submitmail').fadeIn();
  $(document).scrollTop($(document).height());
  positionapp = encodeURIComponent(window.position.trim())
  document.getElementById('forms').action = 'uploademails.php?prf='+window.prf+'&'+'position='+window.position+'&'+'pos='+window.pos+"&"+'dept='+window.dept;

  }
</script>
          <center>
          <form id="forms" method="POST" enctype="multipart/form-data">
                            
                         <br><br>
                                    
                                    <label class="custom-file-upload" id="prof">
                                        <a class="btn blue darken-1">
                                        <input id="uploadcsv" type="file" accept=".csv"  required  name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
                                    </label>
                                    <br><br><br>
                            <button type="submit" onclick="showupdump()" class="btn blue darken-1" name="submit" id="submit" value="Upload"><i class="material-icons right">send</i>Upload</button>
                           
                            
                        </form>

          </center>
                        



        </div>

      </div>
      <center><p style="color:red" id="uploaddump">Please wait uploading email dump ...</p></center>
       <center><b id='unsentmails'>Mails not sent to the following candidates . Please reinitiate the round</b>
  <div id="get"></div>
    </div>
  </div>
 
  
  <div class="row" >
      
      <p style="color: green;text-align: center;margin-left:18%;" id="creatinggrp">Creating Group...! </p>
      <p style="color: green;text-align: center;margin-left:18%;" id="groupcreated">Group Created Successfully </p>
      <p style="color: red;text-align: center;margin-left:18%;" id="groupnotcreated">Unable to create group </p>
          
  </div>
  

  <div class="row" id="emailcollection">
    <div class="input-field col s4 offset-m5 blue-text">
      <i class="material-icons prefix">email</i>
      <input id="email" onfocus="addText(this)" type="text" class="validate" placeholder="Enter Email">
    </div>
  </div>
  <div class="row">
  <div class="input-field col s4 offset-m5 center">
    <button  class="btn waves-effect waves-light blue darken-1" id="submitmail" >Submit Mail
      <i class="material-icons right">send</i>
    </button>
  </div>
  </div>

  </div>
  
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
  input[type="file"]{
    display:none;
  }
</style>
<script>


  function readURL(input) {
  var f = $('#uploadcsv').val().split('.')
      var x=f[1]
      if(x=='csv')
      {
        var f = $('#uploadcsv').val()
      
      $('#myfile0').text(f)
      }
      else
      {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
      }
}

$('#dumpdiv').hide();
$('#emailcollection').hide();
$('#edump').hide();
$('#submitmaildump').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#unsentmails').hide()

$('#emaildump').change(function()
{
      var f = $('#emaildump').val()
      var filesplit=f.split(".")
      checkfile=filesplit[1]
      if(checkfile=="csv")
      {
        $('#myfile').replaceWith(f);
      }
      else
      {
        alert("Invalid File Format")
      }
      
        
})


//Gives unique values from set
function removeusingSet(arr) { 
            let outputArray = Array.from(new Set(arr)) 
            return outputArray 
        } 




  var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr
var txt="<div class='row'><div class='input-field col s4 offset-m5  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);
}
var arr=[]
var dept=[]
$(document).ready(function(){
  $('.modal').modal();

 $("#uploaddump").hide()
 $.ajax({
    url:'http://localhost/thyssenkrup/api/getprfdump.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      console.log(para+"<br>")
      para=JSON.parse(para)
      // window.data=para
      // para=['1001','Developer','North','Sales','5','ongoing']
      console.log("this is length : "+para[0][3])
       i=0;
      for(let i=0;i<=para.length;i++)
      {
        arr[i]=para[i];
        // dept[i] = para[i][3]
      }
      dept[0]="All"
      for(let i =1 ;i<para.length;i++)
      {
        dept[i] = para[i][3]
      }
      uniquedept = removeusingSet(dept);
      for(i=0;i<uniquedept.length;i++)
      {
        var str = '<option value="'+uniquedept[i]+'"  style="color: white">'+uniquedept[i]+'</option>'
         $('#rgchoice').append(str);
      }
      
      console.log("unique : "+ uniquedept)
      for(let j=0;j<arr.length-1;j++)
      {
        
        if(arr[j][6] == "initiated")
        {
          var x='<tr id="rows" style="background-color:orange;"><td id="prf" value="'+arr[j][0]+'"><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
        }else
        {
          var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'" ><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
          
        }
       $('#rawdata').append(x);
      }
     
    },
  })
  

})
$('#submitmail').click(function()
{
  $('#emailcollection').fadeOut(600)
  $('#creatinggrp').fadeIn(600)


  var arr1=[]
  arr1[0]= $('#email').val()
  for(let i =1;i<ctr;i++)
  {
    var x = '#email'+i
    arr1[i] = $(x).val()
    arr1= arr1.filter(function(entry) { return entry.trim() != ""; });
  }
  
  $.ajax({
    url : 'http://localhost/thyssenkrup/api/sendmail.php',

    type:'POST',

    data:{'emails':arr1,
      'prf':window.prf,
      'dept':window.dept,
      'pos':window.pos,
      'status':window.status,
      'position':window.position
    },
    success : function(para)
    {
      //para=JSON.parse(para);
      // console.log("this is ",para[0]);
     
      if(para == "sent")
      {
        $('#groupcreated').show();
      // alert("This is 2 : "+id)
      $(id).attr('disabled','disabled')
      $(id).text('Initiated')
      console.log("sent")
      $('#creatinggrp').fadeOut(600)
      window.setTimeout(function(){location.reload()},1000)


      }
      else{
        para=JSON.parse(para);
        console.log("This is : ",para)
        $('#creatinggrp').fadeOut(100)
        $('#unsentmails').fadeIn(500)
        for(i=0;i<para.length;i++)
        {
          s2="<b style='color:red;'>"+(i+1)+". "+para[i]+"<b><br>";
          $("#get").append(s2);
          $("#submitmail").hide();
        }
      }
      

    },
  })
})

function showupdump()
{
 
  if($('#uploadcsv').val() == "")
  {
    alert('Please Upload a File..!')
  }
  else
  {
    $("#uploaddump").fadeIn()
  }
}

$('#rgchoice').change(function(){

$("#prfno").empty()   
var ap1 = "<option disabled selected style='color: white'>Select PRF</option>"
$("#prfno").append(ap1)    
$('#rawdata').empty();


$.ajax({
url:"http://localhost/thyssenkrup/api/getfilteredprf.php",
type:"POST",
data: {"dept": $('#rgchoice').val()},
success:function(arr)
{ 
  
  arr=JSON.parse(arr);
  console.log("this are prflist = ",arr)
  for(let j=0;j<arr.length;j++)
  {
    
    if(arr[j][6] == "initiated")
    {
      var x='<tr id="rows" style="background-color:orange;"><td id="prf" value="'+arr[j][0]+'"><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
    }
    else
    {
      var x='<tr id="rows"><td id="prf" value="'+arr[j][0]+'" ><b class="modal-trigger" href="#modal1" id="'+arr[j][0]+'" onclick=showmodal(this.id) style="cursor:pointer">'+arr[j][0]+'</b></td><td id="pos">'+arr[j][1]+'</td><td id="zone">'+arr[j][2]+'</td><td id="dept">'+arr[j][3]+'</td><td id="posno">'+arr[j][4]+'</td><td id="status">'+arr[j][5]+'</td><td><a id="'+arr[j][0]+"*"+arr[j][1]+"*"+arr[j][2]+"*"+arr[j][3]+"*"+arr[j][4]+"*"+arr[j][5]+'" class="btn green darken-1" onclick="xyz(this.id)">Initiate</a></td></tr>'
    }

    $('#rawdata').append(x);
  }
}

})

})


</script>
</html>
 
<?php
            }
            else
            {
                header("refresh:0;url=notfound.html");
            }
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>
       