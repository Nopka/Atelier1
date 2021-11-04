<?php
namespace LeHangarLocal\control;

use LeHangarLocal\model\Categorie;
use LeHangarLocal\model\Producteur;
use LeHangarLocal\view\LeHangarView;
use mf\utils\HttpRequest;
use mf\router\Router;


class LeHangarController extends \mf\control\AbstractController{
          public function __construct(){
               parent::__construct();               
          }

          public function viewHome(){
               $lesCategories = Categorie::select()->get(); //SELECT * FROM Categorie
               $vue = new LeHangarView($lesCategories);
               $vue->setAppTitle('Accueil');
               $vue->render('renderHome');
          }
          public function viewProducteurs(){
               $lesProducteurs = Producteur::select()->get();
               $vue = new LeHangarView($lesProducteurs);
               $vue->setAppTitle('Producteurs');
               $vue->render('renderProducteurs');
          }
          public function viewCategorie(){
               $request = new HttpRequest();
               $categorie = $request->get;
               $laCategorie = Categorie::select()->where('id','=',$categorie)->first();
               $elementsCategorie =$laCategorie->produits()->get();
               $vue = new LeHangarView($elementsCategorie);
               $vue->setAppTitle("$laCategorie->nom");
               $vue->render('renderUneCategorie');
          }
          public function viewElementsProducteur(){
               $request = new HttpRequest();
               $producteur = $request->get;
               $leProducteur = Producteur::select()->where('id','=',$producteur)->first();
               $elementsProducteur = $leProducteur->produits()->get();
               $vue = new LeHangarView($elementsProducteur);
               $vue->setAppTitle("$leProducteur->nom");
               $vue->render('renderElementsProducteur');
          }
     }

?>