<?php
/**
 * Created by PhpStorm.
 * User: Radu
 * Date: 03-Feb-19
 * Time: 14:41
 */

namespace App\Controllers;
use Framework\Controller;


class MechanicController extends Controller
{
    public function mechanicAction()
    {
        return $this->view("pages/mechanic.html");
    }
}
