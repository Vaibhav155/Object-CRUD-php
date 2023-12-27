<?php

  require 'connect_object.php';
  $db = new database('localhost','root','123456','object');
  $db->toconnect();
  
  $time=date("y-m-d h:i:s");
  // echo $time;
  // die;

  //fetching values from login.php
  $checkemail=$_POST['email'];
  $checkpassword=$_POST['password'];

  // requirement for checking
  $tabv="stu";
  $colv=array("*");
  $conditionv="`email`='$checkemail' AND `password`='$checkpassword'";
  
  // calling function to verify
  $v=$db->fetchdatatoform($tabv,$colv,$conditionv);
  $newfname = $v['fname'];    
  $newlname = $v['lname'];
  $newemail = $v['email'];
  $newbirthday = $v['dob'];
  $newaddress = $v['address'];
  $newcourse = $v['course'];
  $neweducation = $v['education'];   
  
  
  if($v==0)
  {
   header("refresh:0; url=login.php?error=t"); 
  }
  
  else
  { 
    //echo " login successfull";
    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
    <title>User Profile Dashboard</title>
    <style>
    /* CSS styles for the dashboard layout */
    body {
     font-family: Arial, sans-serif;
     background-color: #9ed4d4;
    }
    .container {
     max-width: 800px;
     margin: 0 auto;
     padding: 20px;
     background-color: #9ed4d4;
     width:100%;
    }
    h1 {
     text-align: center;
    }
    .profile-card {
     background-color: lightgray;
     padding: 20px;
     border-radius: 5px;
     margin-bottom: 20px;
     border: 1px solid black;
    }
    .profile-card h2 {
     margin-top: 0;
     text-align: center;
    }
    .profile-card p {
     margin: 0;
     text-align: center;
    }
    .profile-card .info {
     margin-top: 10px;
    }
    .hi{
     text-align: center;
     display: block;
    }
    </style>
    </head>
    <body>
    <div class="container">
    <h1>User Profile Dashboard</h1>
  
    <div class="profile-card">
    <h2><?php echo $newfname ."\n". $newlname; ?></h2>
    <p>Email: <?php echo $newemail; ?>" </p>
    <p>Birthday: <?php echo $newbirthday; ?></p>
    <div class="info">
      <p>Location: <?php echo $newaddress; ?> </p>
      <p>Education: <?php echo $neweducation; ?></p>
      <p>Main Skill: <?php echo $newcourse; ?> </p>
    </div>
    </div>
    </div>
    </body>
    </html> 
   
   
    <?php 
    $colv2=array("email","password","intime","count");
    $tablev2="times";
    $conditionv2="`email`='$checkemail' AND `password`='$checkpassword'";
    $v2=$db->fetchdatatoform($tablev2,$colv2,$conditionv2);
   
    
    if($v2==0)
    { if($v2==0)
      
      $ri=$v2['count'];
      $ri++;
      
      $rowv2=array("$checkemail","$checkpassword","$time","$ri");
      $db->insertdata($tablev2,$colv2,$rowv2);
      
      echo " <a class='hi' href='login.php?e=$checkemail'> <input type='submit' value='logout'> </a>";
    }

    else
    { 
      $showemail=$v2['email'];
      // $password=$v2['password'];
      $ru+=$v2['count'];
      $ru++; 
      $colv3=array("intime","count");
      $rowv3=array("$time","$ru");
      $db->update($tablev2,$conditionv2,$colv3,$rowv3);
     
      echo " <a class='hi' href='login.php?e=$showemail' > <input type='submit' value='logout'> </a>";
   }
  }
?>


