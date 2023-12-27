<?php
    
   // connection requirement
   require 'connect_object.php';
   $db = new database('localhost','root','123456','object');

   //connection function called
   $db->toconnect();

   // fetching values from form
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $birthday = $_POST['birthday'];
   $course = $_POST['course'];
   $education = $_POST['education'];            // array fetching values from checkbox
   $new = implode(",", $education);             // implode function makes a string of elements of array
   $state = $_POST['state'];
   $address = $_POST['address'];

   // requirements for insertion and updation
   $table="stu";
   $columns = array("fname","lname","email","password","dob","course","education","state","address");
   $rows =array("$fname","$lname","$email","$password","$birthday","$course","$new","$state","$address");

   if(isset($_POST['editId']))
   {
      $ied = $_POST['editId'];
      $tab2="stu";
      $condition2="id='$ied'";
      $db->update($tab2,$condition2,$columns,$rows); // update function called
   }
   
   
   else
   {
   // insertion function called
   $db-> insertdata($table,$columns,$rows);
   }

   $db->todisconnect();
?>



<!-- button to table-->
<html>
<head>
</head>
<body>
   <br>
   <a href="show_object.php"><button type="button" style="background-color:aqua; display:inline-block; margin-right:auto; margin-left:auto; color:black;">Click here</button></a>
</body>
</html>