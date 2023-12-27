<!DOCTYPE html>
<html>
<head>
   <style>
     
      th
      {
        padding: 20px;
        border: 1px solid black;
        height:100px;
        background-color:aquamarine;
        width:20px;
      }
      
      td
      {
        padding: 10px;
        border: 1px solid black;
        font-size: 12px;
        background-color:DarkSeaGreen;
        white-space:pre-wrap; 
        word-wrap:break-word
      }

   </style>

</head>

<body>
   <table style="border: 1px solid black; ">
   <tr >
      <th> Unique id </th>
      <th> first name </th>
      <th> last name</th>
      <th> email </th>
      <th> password </th>
      <th> birthday </th>
      <th> course</th>
      <th> education </th>
      <th> state </th>
      <th> address </th>
      <th> edit </th>
      <th> delete </th>
   </tr>
</body>
</html>

<?php
   
   require 'connect_object.php';
   $db = new database('localhost','root','123456','object');
   $db->toconnect();

  
  
  
   // deleting concept 
   $ide=$_GET['id'];
   
   if(isset($ide))
   { 
    $tab3="stu";
    $condition3="id='$ide'";
    $newcol4=array("*");
    $r=$db->fetchdatatoform($tab3,$newcol4,$condition3);
    $newemail=$r['email'];
    $newcondition="email='$newemail'";
    $newtable="times";
    $db->deletedata($tab3,$condition3);
    $db->deletedata($newtable,$newcondition);
    header("Refresh:0; url=show_object.php");
   }
   
   
   
   
   // showing concept
   
  else
  {
   $tab="stu";
   $col=array("*");
   $condition="";
   $result=$db->fetchdatatoform($tab,$col,$condition);

   if(mysqli_num_rows($result)>0)                         // if no. of rows are not empty 
     {
        while($row=mysqli_fetch_assoc($result))           // fetching data row by row 
        { 
          echo 
            "<tr>
             <td>".$row['id']."</td>
             <td>".$row['fname']."</td>
             <td>".$row['lname']."</td>
             <td>".$row['email']."</td>
             <td>".$row['password']."</td>
             <td>".$row['dob']."</td>
             <td>".$row['course']."</td>
             <td>".$row['education']."</td>
             <td>".$row['state']."</td>
             <td>".$row['address']."</td>
             <td> <a href='form_object.php?id=$row[id]'> <input type='submit' value='Edit'> </a> </td>
             <td> <a onclick='return confirm()' href='show_object.php?id=$row[id]'> <input type='submit' value='Delete'> </a> </td> 
             </tr>" ;
        }
      } 
   }

   $db->todisconnect();
?>