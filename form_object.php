<!DOCTYPE html>
<html>

<head>
  <title> REGISTRATION PORTAL </title>
  <link rel="icon" href="images/1.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      background-color: white;
      text-align: center;
      background-image: url(images/3.webp);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      backdrop-filter: blur(10px);
    }
      
    .alpha {
      display: block;
      margin-left: auto;
      margin-right: auto;
      border: 4px solid black;
      width: 520px;
      background-color: grey;
      font-weight: bolder;
      opacity: 0.7;
      background-size: cover;
    }

    /*    img{
          display: block;
          width: 100px;
          height: 100px;
          margin: auto;
          } 
    */
  </style>
</head>

<body>

  <form class="alpha" method="post" action="insert_object.php">
  
  
<?php                   // from here concept to show data of a user on form if already registered starts

$id = $_GET['id'];      // fetching id from edit button in show_object.php
$tab1="stu";
$col1=array("*");
$condition1="id='$id'";
if (isset($id)) 
{ 
    require 'connect_object.php';
    $db = new database('localhost','root','123456','object');
    $db->toconnect();

    $r=$db->fetchdatatoform($tab1,$col1,$condition1);                  // fetchdatatoform function called by passing id and storing what it returns in r
    $work = array();
    $newfname = $r['fname'];                                          // storing values in new variables to display on form 
    $newlname = $r['lname'];
    $newemail = $r['email'];
    $newpassword = $r['password'];
    $newbirthday = $r['dob'];
    $newcourse = $r['course'];
    $neweducation = $r['education'];                // it is a string seperated by commas
    $work = explode(",", $neweducation);            // work is an array that store values after comma is removed 
    $newstate = $r['state'];
    $newaddress = $r['address'];

    $db->todisconnect();
?>

    <input type="hidden" name="editId" id="editId" value="<?php echo $id; ?>">  <!-- just to send id on insert.php via _post -->      <!-- the value of $id will be stored in value attribute via echo because it is html we can't directly write $id it will consider it as a string -->

<?php 
}
?>       

  
  <H1 style="text-align: center; color: black; padding: 10px;"><u>REGISTRATION FORM</u></H1>
    <!-- <img src="images/1.jpg" alt="an image"> <br> -->

    <label for="fname"> FIRST NAME </label> <br>
    <input type="text" id="fname" name="fname" value="<?php echo $newfname; ?>" ><br> 

    <label for="lname"> LAST NAME </label> <br>
    <input type="text" id="lname" name="lname" value="<?php echo $newlname; ?>" ><br>

    <label for="email"> E-MAIL </label> <br>
    <input type="email" id="email" name="email"  value="<?php echo $newemail; ?>" ><br>

    <label for="password"> PASSWORD </label><br>
    <input type="password" id="password" name="password" value="<?php echo $newpassword; ?>"><br><br>

    <label for="birthday">BIRTHDAY</label><br>
    <input type="date" id="birthday" name="birthday"  value="<?php echo $newbirthday; ?>" max="<?= date('Y-m-d'); ?>"><br><br>       



    <label> COURSE</label><br>
    <input type="radio" id="course" name="course" value="HTML" <?php if ($newcourse == "HTML") echo "checked";  ?>>                  
    <label for="html">HTML</label>
    <input type="radio" id="course" name="course" value="CSS" <?php if ($newcourse == "CSS") echo "checked";  ?>>
    <label for="css">CSS</label>
    <input type="radio" id="course" name="course" value="JS" <?php if ($newcourse == "JS") echo "checked";  ?>>
    <label for="js">JS</label><br><br>



    <label> EDUCATION </label> <br>
    <input type="checkbox" id="educatiom" name="education[]" value="BTECH" <?php if (in_array("BTECH", $work)) echo "checked";  ?>>   
    <label for="btech">BTECH</label>
    <input type="checkbox" id="education" name="education[]" value="MBA" <?php if (in_array("MBA", $work)) echo "checked";  ?>>
    <label for="mba">MBA</label>
    <input type="checkbox" id="education" name="education[]" value="MTECH" <?php if (in_array("MTECH", $work)) echo "checked";  ?>>
    <label for="mtech">MTECH</label>
    <input type="checkbox" id="education" name="education[]" value="BCA" <?php if (in_array("BCA", $work)) echo "checked";  ?>>
    <label for="bca">BCA</label><br><br>


    <label for="state">Choose a state:</label>
    <select id="state" name="state">
      <option value="none">Select an Option</option>
      <option value="Haryana" <?php if ($newstate == "Haryana") echo "selected";  ?> >Haryana</option>                                 
      <option value="Uttar Pradesh" <?php if ($newstate == "Uttar Pradesh") echo "selected";  ?>>Uttar Pradesh</option>
      <option value="Rajasthan" <?php if ($newstate == "Rajasthan") echo "selected";  ?>>Rajasthan</option>
      <option value="Punjab" <?php if ($newstate == "Punjab") echo "selected";  ?>>Punjab</option>
    </select> <br><br>



    <label>ADDRESS</label><br>
    <textarea name="address" id="address" rows="3" cols="30"> <?php echo $newaddress; ?> </textarea><br><br>                           <!--  textrea doesnt have value attribute that why it is passed in between tags  -->


    <input type="submit" name="submit" value="submit" onclick="return validate()">
    <input type="reset" value="reset ">

  </form>
</body>


<script>
  
  function validate() {

    var fname = document.getElementById("fname");                                
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var birthday = document.getElementById("birthday");
    var state = document.getElementById("state");
    var course = document.querySelector('input[name="course"]:checked');      
    var checkboxes = document.getElementsByName("education[]");
    var isChecked = true;
    var address = document.getElementById("address");
    var addressvalue = address.value.trim();

    if (fname.value == "") {
      alert("first name can't be empty");
      return false;
    } else if (!fname.value.match(/^[A-Za-z\s]*$/)) {
      alert("Numbers or special character are not allowed in the first name");
      return false;
    } else if (lname.value == "") {
      alert("last name can't be empty");
      return false;
    } else if (!lname.value.match(/^[A-Za-z\s]*$/)) {
      alert("Numbers or special character are not allowed in the last name");
      return false;
    } else if (email.value == "") {
      alert("email can't be empty");
      return false;
    } else if (!email.value.match(/^[a-zA-Z]+[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+[.]+[a-zA-Z0-9]+(?:\.[a-zA-Z0-9-]+)*$/)) {
      alert("wrong format of email");
      return false;
    } else if (password.value == "") {
      alert("password can't be empty");
      return false;
    } else if (!password.value.match('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')) {
      alert("wrong format of password");
      return false;
    } else if (birthday.value == "") {
      alert("date can't be empty");
      return false;
    } else if (course == null) {
      alert("select a radio: course");
      return false;
    } else if (state.value == "none") {
      alert(" please select a state");
      return false;
    } else if (addressvalue.length == 0) {
      alert(" enter address");
      return false;
    } else if (isChecked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
          isChecked = false;
          break;
        }
      }

      if (isChecked) {
        alert("Please select at least one checkbox: education");
        return false;
      }

    } else {
      return true;
    }
  }

</script>
</html>