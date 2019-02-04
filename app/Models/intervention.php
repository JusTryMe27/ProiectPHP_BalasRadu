<?php
namespace App\Models;

use Framework\Model;
class Intervention extends Model
{
    private $id;
    private $name;
    private $price;

    function __construct($id, $name, $price)
    {
        $this->id=$id;
        $this->name = $name;
        $this->price = $price;
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

