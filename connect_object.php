<?php 

class database
{
  private $hostname;             // $hostname is a property of the Database class
  private $usern;
  private $pass;
  private $dbname;
  private $connection;      
   
  public function __construct($host,$username,$password,$databasename)
  {
    $this->hostname=$host;       // $hostname directly within the class methods, PHP would interpret it as a local variable instead of a class property. This would result in an error or unexpected behavior, as the variable would not have the intended value. By using $this->hostname, you ensure that you are accessing the class property and maintaining the correct scope within the class methods.
    $this->usern=$username;
    $this->pass=$password;
    $this->dbname=$databasename;
  }

  public function toconnect()   
  {
  $this->connection = mysqli_connect($this->hostname, $this->usern, $this->pass, $this->dbname);
  if(!$this->connection)
    {
        die("connection failed". mysqli_connect_error());
    }
    //  echo "connection successfull";
  }

  public function todisconnect()
  {
    mysqli_close($this->connection);
  }

  public function exequery($query)
  {
    return mysqli_query($this->connection,$query);
  }

  public function insertdata($table,$columns,$rows)
  {
    $c = "`". implode("`,`",$columns). "`";
    $v="'". implode("', '",$rows). "'";                  // implode will seperate each element by ','  but first element will have empty on left side and last element will have empty on right side that's why additional "'" is used before and after implode
    
    $sql1= "INSERT INTO $table ($c) VALUES ($v)";
    $res=$this->exequery($sql1);
    if (!$res) {
      die("Error in insertion of data" . mysqli_error($this->connection));
    }
    // echo "successfull insertion of data";
  }

  public function fetchdatatoform($tab1,$col1,$condition1)
  { 
    $v1= implode(",",$col1);
    if(!empty($condition1))
    {
      $alpha=0;
      $sql3 = "select $v1 from $tab1 where $condition1";             // to bring data from db based on that id
      $result = $this->exequery($sql3);            // this runs the above query against db
      if (mysqli_num_rows($result) > 0)                              // to check that particular row is not empty
      {                
        $row = mysqli_fetch_assoc($result);                          // fetching values in that row
        return $row;
      }
      else
      {
        return $alpha;
      }
    }
    else 
    {
      $sql3 = "select $v1 from $tab1";  
      $result = $this->exequery($sql3);
      return $result;
    }
  }

  public function update($tab2,$condition2,$columns,$rows)
  {
   $u=array();
   for($i=0;$i<count($columns);$i++)                             // could also take rows in place of columns because number of rows and columns will be same because they are in pair
   {
      $u[]="`".$columns[$i]. "`" . "=" . "'" .$rows[$i]. "'";    // making pairs like fname=$fname
   }
   $ustr= implode(",",$u);
    
    $sql4 = "update $tab2 set $ustr where $condition2";
    $res = $this->exequery($sql4);
    if ($res) {
       //echo " entries successfully updated";
    }
  }

  public function deletedata($tab3,$condition3)
  {
    $sql5="delete from $tab3 where $condition3";
    $this->exequery($sql5);

  }
}
?>





