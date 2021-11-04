<?php
//Initialisation de l'affichae des erreurs

use LeHangarLocal\model\Categorie;
use LeHangarLocal\model\Produit;
use mf\router\Router;

ini_set('display_errors', '1');

//Initialisation de la session
session_start();

//Require des autoloader
require_once '../vendor/autoload.php';
require_once('src/mf/utils/AbstractClassLoader.php');
require_once('src/mf/utils/ClassLoader.php');

//config database
$config = parse_ini_file("conf/config.ini");
/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */


$loader = new mf\utils\ClassLoader('src');
$loader->register();


$ctrl = new \LeHangarLocal\control\LeHangarController();

$router = new Router();
$router->addRoute('default','/home/','\LeHangarLocal\control\LeHangarController','viewHome');

$router->run();

?>