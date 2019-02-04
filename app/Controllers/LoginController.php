<?php
namespace App\Controllers;

use Framework\Controller;


/**
 * Class LoginController
 */
include "../DB/DBconnection.php";
include "../Model/mechanic.php";
include "../Model/client.php";
include "../Model/appointment.php";
include "../Model/intervention.php";
include "../Model/appointment_intervention.php";
class LoginController extends Controller
{
    public function signup()
    {
        return $this->view(pages/signup.hmml);
    }
    public function mechanic()
    {
        return $this->view(pages/mechanic.hmml);
    }
    public function loginAction()
    {


        return $this->view("login/login.html");
        $a = array();
        $result = $conn->query("SELECT * FROM mechanic");
        while($row = $result->fetch_array())
        {
            $mechanic=new mechanic($row['id'], $row['firstName'], $row['lastName'], $row['cnp'], $row['phone'], $row['userName'], $row['password'], $row['activ']);
            array_push($a,$mechanic);

        }

        $p = array();
        $result = $conn->query("SELECT * FROM client");
        while($row = $result->fetch_array())
        {
            $client=new client($row['id'], $row['firstName'], $row['lastName'], $row['cnp'], $row['phone'], $row['address'], $row['id_mechanic']);
            array_push($p,$client);

        }
        $_SESSION["clients"]=$p;


        $ap = array();
        $result = $conn->query("SELECT * FROM appointment");
        while($row = $result->fetch_array())
        {
            $appointment=new Appointment($row['id'], $row['id_client'], $row['data_'], $row['startHour'], $row['endHour'], $row['id_mechanic']);
            array_push($ap,$appointment);

        }
        $_SESSION["appointments"]=$ap;

        $interv = array();
        $result = $conn->query("SELECT * FROM intervention");
        while($row = $result->fetch_array())
        {
            $intervention=new Intervention($row['id'], $row['name'], $row['price']);
            array_push($interv,$intervention);

        }
        $_SESSION["interventions"]=$interv;


        $app_interv = array();
        $result = $conn->query("SELECT * FROM appointment_intervention");
        while($row = $result->fetch_array())
        {
            $intervention=new Appointment_Intervention($row['id'], $row['id_appointment'], $row['id_intervention']);
            array_push($app_interv,$intervention);

        }
        $_SESSION["appointments_interventions"]=$app_interv;

        if(isset($_POST["login"]))
        {
            $_SESSION['userName'] = $_POST['userName'];

            if(strlen($_POST["userName"])==0 || strlen($_POST["password"])==0 )
            {
                $err="Completeaza toate campurile!";
                header("location:../Views/login/login.php?err=$err");
            }
            else
            {
                $u=null;
                foreach($a as $mechanic)
                    if($mechanic->userName==$_POST["userName"] && $mechanic->password==$_POST["password"])
                        $u=$mechanic;
                if($u!=null)
                {
                    if($u->activ==0)
                    {
                        $err="Cont inactiv!";
                        header("location:../Views/login/login.php?err=$err");
                    }
                    else
                    {
                        unset($_SESSION['userName']);

                        $_SESSION["currentmechanic"]=$_POST["userName"];
                        $currentmechanic=$_SESSION["currentmechanic"];
                        $_SESSION["clients"]=$p;
                        header("location:../Views/pages/mechanicPage.html");
                    }

                }
                else

                    {
                        $err="Username sau parola incorecta!";
                        header("location:../Views/login/login.html?err=$err");
                    }

            }
        }
        if(isset($_POST["signup"]))
        {

            $this->signup();
        }
        $conn->close();
    }


}
