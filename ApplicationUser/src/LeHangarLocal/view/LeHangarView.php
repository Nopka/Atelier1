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
                    $uneCategorie = $route->urlFor('elementsCategorie', [['id', $categorie->id]]);
                    $viewCategorie .="
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/Poivrons-rouges.jpg' alt='image'>
                              <p>
                                   <a href=".$uneCategorie.">$categorie->nom</a>
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
                    $unProducteur = $route->urlFor('elementsProducteur',[['id',$producteur->id]]);
                    $viewProducteurs .="
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/images.png' alt='image'>
                              <p>
                                   <a href=".$unProducteur.">
                                        $producteur->nom<br>
                                        $producteur->localisation
                                   </a>
                              </p>
                         </section>
                    ";
               }
               $viewProducteurs .="</article>";
               return $viewProducteurs;
          }
          private function renderUneCategorie(){
               $elements = $this->data;
               $elementsCategorie ="<article><h2 id='titre_article'>Les différents produits de la catégorie </h2>";
               foreach ($elements as $unElement) {
                    $elementsCategorie .= "
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/Poivrons-rouges.jpg' alt='image'>
                              <p>
                                   <div class='nomElement'>$unElement->nom</div>
                                   <div class='descElement'>$unElement->description</div>
                                   <div class='tarifElement'>$unElement->tarif_unitaire</div>

                                   <div>$unElement->id_producteur</div>
                              </p>
                         </section>
                    ";
               }
               return $elementsCategorie;
          }
          private function renderElementsProducteur(){
               $elements = $this->data;
               $elementsProducteur="<article><h2 id='titre_article'>Les différents produits du producteur </h2>";
               foreach ($elements as $unElement) {
                    $elementsProducteur .= "
                         <section>
                              <img src='http://localhost/LP-CIASIE_dev/Ateliers/Atelier1/ApplicationUser/html/img/Poivrons-rouges.jpg' alt='image'>
                              <p>
                                   <div class='nomElement'>$unElement->nom</div>
                                   <div class='descElement'>$unElement->description</div>
                                   <div class='tarifElement'>$unElement->tarif_unitaire</div>

                                   <div>$unElement->id_producteur</div>
                              </p>
                         </section>
                    ";
               }
               return $elementsProducteur;
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
                    case 'renderUneCategorie':
                         $content = $this->renderUneCategorie();
                         break;
                    case 'renderElementsProducteur':
                         $content = $this->renderElementsProducteur();
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