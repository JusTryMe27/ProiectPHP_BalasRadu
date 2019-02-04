<?php
namespace App\Models;

use Framework\Model;
class Client extends Model
{
    private $id;
    private $firstName;
    private $lastName;
    private $cnp;
    private $phone;
    private $address;
    private $id_mechanic;

    function __construct($id, $firstName, $lastName, $cnp, $phone, $address, $id_mechanic)
    {
        $this->id=$id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->cnp=$cnp;
        $this->phone=$phone;
        $this->address = $address;
        $this->id_mechanic = $id_mechanic;

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