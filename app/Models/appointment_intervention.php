<?php
/**
 * Created by PhpStorm.
 * User: Radu
 * Date: 04-Feb-19
 * Time: 13:20
 */

namespace App\Models;


use Framework\Model;

class Appointment_intervention extends Model
{
    private $id;
    private $id_appointment;
    private $id_intervention;

    function __construct($id, $id_appointment, $id_intervention)
    {
        $this->id=$id;
        $this->id_appointment = $id_appointment;
        $this->id_intervention = $id_intervention;
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