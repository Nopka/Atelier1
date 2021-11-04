<?php 
     namespace LeHangarLocal\view;

     use mf\utils\HttpRequest;
     use \mf\router\Router;


     class LeHangarView extends \mf\view\AbstractView{

          //Appelle le constructeur de la classe parent
          public function __construct($data){
               parent::__construct($data);
          }
          

          private function renderHeader(){
               return '<header id="titre"><h1>LeHangar.Local</h1></header> <main id="container">';
          }
          private function renderFooter(){
               return '</main><footer></footer>';
          }
          private function renderMenu(){
               $route = new Router();
               return '
               <nav id="menu">
                    <ul>
                         <li><a href='.$route->urlFor("accueil",[]).'>Accueil</a></li>
                         <li><a href='.$route->urlFor("producteurs",[]).'>Producteurs</a></li>
                         <li><a href='.$route->urlFor("panier",[]).'>Panier</a></li>
                    </ul>
               </nav>
           ';
          }
          private function renderHome(){
               $route = new Router();
               $lesCategories = $this->data;
               $viewCategorie = "<article><h2 id='titre_article'>Les différentes catégories de produits</h2>";
               foreach ($lesCategories as $categorie) {
                    $viewCategorie .="
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/Poivrons-rouges.jpg' alt='image'>
                              <p>
                                   $categorie->nom<br>
                              </p>
                         </section>
                    ";
               }
               $viewCategorie .= "</article>";
               return $viewCategorie;
          }
          private function renderProducteurs(){
               $route = new Router();
               $lesProducteurs = $this->data;
               $viewProducteurs ="<article><h2 id='titre_article'>Les différents producteurs</h2>";
               foreach ($lesProducteurs as $producteur) {
                    $viewProducteurs .="
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/images.png' alt='image'>
                              <p>
                                   $producteur->nom<br>
                              </p>
                         </section>
                    ";
               }
               $viewProducteurs .="</article>";
               return $viewProducteurs;
          }

          protected function renderBody($selector)
          {
               $header = $this->renderHeader();
               $menu = $this->renderMenu();
               $footer = $this->renderFooter();

               switch ($selector){
                    case 'renderHome':
                         $content = $this->renderHome();
                         break;
                    case 'renderProducteurs':
                         $content = $this->renderProducteurs();
                         break;
               }
               $body = <<<EOT
                    ${header}
                    ${menu}
                    ${content}
                    ${footer}
               EOT;
               return $body;
          }
     }
?>