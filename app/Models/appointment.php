<?php
/**
 * Created by PhpStorm.
 * User: Radu
 * Date: 04-Feb-19
 * Time: 13:21
 */

namespace App\Models;


use Framework\Model;

class Appointment extends Model
{
    private $id;
    private $id_client;
    private $data;
    private $startHour;
    private $endHour;
    private $id_mechanic;

    function __construct($id, $id_client, $data, $startHour, $endHour, $id_mechanic)
    {
        $this->id=$id;
        $this->id_client = $id_client;
        $this->data = $data;
        $this->startHour=$startHour;
        $this->endHour=$endHour;
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