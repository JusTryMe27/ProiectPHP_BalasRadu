<?php
namespace App\Models;

use Framework\Model;
class Mechanic extends Model
{
    private $id;
    private $firstName;
    private $lastName;
    private $cnp;
    private $phone;
    private $userName;
    private $password;
    private $activ;
    function __construct($id, $firstName, $lastName, $cnp, $phone, $userName, $password, $activ)
    {
        $this->id=$id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->cnp=$cnp;
        $this->phone=$phone;
        $this->userName = $userName;
        $this->password = $password;
        $this->activ=$activ;
    }

    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this->$property;
        }
    }

    public function __set($property ,$value)
    {
        if(property_exists($this, $property))
        {
            $this->$property=$value;
        }
    }
}
?>