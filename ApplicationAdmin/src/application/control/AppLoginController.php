<?php

namespace application\control;

use application\model\Producteur;
use Illuminate\Contracts\Auth\Access\Authorizable;
use mf\auth\Authentification;
use \application\view\AppView as AppView;
use \mf\control\AbstractController;
use \application\auth\appAuthentification as appAuthentification;
use \tweeterapp\model\User;
use \mf\router\Router;
use tweeterapp\view\appView as ViewAppView;

class AppLoginController extends AbstractController
{

    public function login()
    {
        $formulaireConnexion = new AppView("");
        $formulaireConnexion->setAppTitle('Se connecter');
        $formulaireConnexion->render('renderLogin');
    }

    public function checkLogin()
    {
        if (isset($_POST['submit'])) {
            $authentification = new appAuthentification();
            $authentification->loginUser($_POST['mail'], $_POST['password']);
            if($authentification->logged_in){

            }
        }
    }

    public function logOut()
    {
        if (isset($_SESSION['user_login'])) {
            $authentification = new Authentification();
            $authentification->logout();
        }
    }

    // public function signUp(){
    //         $formulaireSignUp = new AppView("");
    //          $formulaireSignUp->setAppTitle('Sign Up');
    //          $formulaireSignUp->render('renderSignup');
    // }

    // public function checkSignUp(){
    //     if (isset($_POST['login_button'])) {
    //         //récuperer les données du formulaire : 
    //             $fullname = $_POST['fullname'];                                       //faire le filtrage plustard 
    //             $username = $_POST['username'];
    //             $password = $_POST['password'];
    //             $password_verify = $_POST['password_verify'];
    //             if($password === $password_verify){
    //                 $authentification = new TweeterAuthentification();
    //                 $authentification->createUser($username,$password,$fullname);       //comment mettre le level ?
    //             }
    //     }
    // }

}
