<?php
/**
 * Created by PhpStorm.
 * User: Radu
 * Date: 03-Feb-19
 * Time: 15:10
 */


namespace App\Controllers;
use Framework\Controller;

include "../DB/conexiuneBD.php";
include "../Model/mechanic.php";

include "../DB/conexiuneBD.php";
include "../Model/mechanic.php";

class SignupController extends Controller
{
    public function signupAction()
    {
        return $this->view("pages/signup.html");

        $result = $conn->query("SELECT * FROM mechanic");
        while($row = $result->fetch_array())
        {
            //$_SESSION['msg'] .= $row['id']." ".$row['firstName']." ".$row['lastName']." ".$row['cnp']." ".$row['phone']." ".$row['userName']." ".$row['password']." ".$row['activ']."<br />";

            $mechanic=new mechanic($row['id'], $row['firstName'], $row['lastName'], $row['cnp'], $row['phone'], $row['userName'], $row['password'], $row['activ']);
            array_push($a,$mechanic);

        }

        if(isset($_POST["ok"]))
        {
            $_SESSION['firstName'] = $_POST['firstName'];
            $_SESSION['lastName'] = $_POST['lastName'];
            $_SESSION['cnp'] = $_POST['cnp'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['userName'] = $_POST['userName'];
            $_SESSION['password'] = $_POST['password'];

            if(strlen($_POST["firstName"])==0 || strlen($_POST["lastName"])==0  || strlen($_POST["cnp"])==0 || strlen($_POST["phone"])==0 || strlen($_POST["userName"])==0 || strlen($_POST["password"])==0 || strlen($_POST["matchingPassword"])==0)
            {
                $err="Completeaza toate campurile!";
                header("location:../Views/signup.php?err=$err");
            }
            else
                if(strlen($_POST["password"])<5)
                {
                    $err="Parola trebuie sa contina cel putin 5 caractere!";
                    header("location:../Views/signup.php?err=$err");
                }
                else
                    if($_POST["password"]!=$_POST["matchingPassword"])
                    {
                        $err="Parolele introduse nu se potrivesc!";
                        header("location:../Views/signup.php?err=$err");
                    }
                    else
                    {
                        $ok=true;
                        foreach($a as $user)
                            if($user->userName==$_POST["userName"])
                                $ok=false;
                        if($ok==false)
                        {
                            $err="Acest username exista deja!";
                            header("location:../Views/signup.php?err=$err");
                        }
                        else
                        {
                            $ok2=true;
                            foreach($a as $user)
                                if($user->cnp==$_POST["cnp"])
                                    $ok2=false;
                            if($ok2==false)
                            {
                                $err="CNP invalid!";
                                header("location:../Views/signup.php?err=$err");
                            }
                            else
                            {
                                unset($_SESSION['firstName']);
                                unset($_SESSION['lastName']);
                                unset($_SESSION['cnp']);
                                unset($_SESSION['phone']);
                                unset($_SESSION['userName']);
                                unset($_SESSION['password']);

                                $stmt = $conn->prepare("INSERT INTO mechanic(firstName, lastName, cnp, phone, userName, password, activ) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                //declare parameters
                                $firstName=$_POST["firstName"];
                                $lastName=$_POST["lastName"];
                                $password=$_POST["password"];
                                $userName=$_POST["userName"];
                                $cnp=$_POST["cnp"];
                                $phone=$_POST["phone"];
                                $activ=0;


                                $stmt->bind_param("ssssssi", $firstName,  $lastName, $cnp, $phone, $userName, $password, $activ);
                                $stmt->execute();
                                $stmt->close();



                                $err="Utilizator adaugat cu succes!";

                                header("location:../Views/login.php?err=$err");


                            }
                        }
                    }

        }

        if(isset($_POST["cancel"]))
        {
            unset($_SESSION['firstName']);
            unset($_SESSION['lastName']);
            unset($_SESSION['cnp']);
            unset($_SESSION['phone']);
            unset($_SESSION['userName']);
            unset($_SESSION['password']);

            header("location:../Views/login.php");
        }
        $conn->close();
    }



}