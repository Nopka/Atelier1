<?php

require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';
require_once 'vendor/autoload.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

session_start();

$config = parse_ini_file("conf/config.ini");
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection($config); 
$db->setAsGlobal();            
$db->bootEloquent();         

//Les alias
use application\model\Producteur as Producteur;
use application\model\Produit as Produit;
use application\model\CommandeProduit as CommandeProduit;
use application\view\AppView;
use application\model\Compte;
use Illuminate\Contracts\Auth\Authenticatable;
use mf\auth\Authentification;
use mf\router\Router;
use application\control\AppProducteurController;
// $id_produit = CommandeProduit::select()->where('id','=',1)->first();
// echo $id_produit->id_produit;                                //id de la commande correspondant au produit 69

// $id_producteur = Produit::select()->where('id',"=",$id_produit->id_produit)->first();
// echo $id_producteur->id_producteur;

// $id_producteur = Producteur::select()->where('id','=',$id_producteur->id_producteur)->first();
// echo $id_producteur->nom;
// echo $id_producteur->mail;



AppView::addStyleSheet('/html/scss/style.css');


//Ajout des routes : 
$router = new Router();
$router->addRoute('login','/login/','\application\control\AppLoginController','login');
$router->addRoute('checklogin','/checklogin/','\application\control\AppLoginController','checkLogin');
$router->addRoute('logout','/logout/','\application\control\AppLoginController','logOut');
$router->addRoute('commandeproduit','/commandeproduit/','\application\control\AppProducteurController','viewCommandeProduit');
$router->setDefaultRoute('/login/');
$router->run();

// print_r(\mf\router\Router::$routes);

// $password = "password";
// $authentification = new Authentification();
// $compte = new Compte();
// $compte->mail = "jbattista0@goo.ne.jp";
// $hashed_password = $authentification->hashPassword($password);
// $compte->password = $hashed_password;
// $compte->role = "producteur";


?>