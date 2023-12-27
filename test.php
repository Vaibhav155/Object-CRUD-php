<?php

class employee                           // a named group of properties and functions
{                           
    public $n;                           
    public $s;                           // properties or variables

    function set($name,$salary)          // function or method
    {                                    
        $this->n=$name;                  // $this-> is a keyword that refers to the current object and used to access the properties and functions
        $this->s=$salary;
    }

    function get()
    {
        echo $this->n. "<br>" .$this->s;
    }
}


$emp1 = new employee();                  // object creation 
$emp1-> set('akshat','10000');           // calling function set and passing values
$emp1-> get();                           // calling function get


// echo date(" jS \of F Y h:i:s A") . "<br>";
?>

