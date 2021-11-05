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
               $http_req = new HttpRequest();
               $lesCategories = $this->data;
               $viewCategorie = "<article><h2 class='titre_article'>Les différentes catégories de produits</h2>";
               foreach ($lesCategories as $categorie) {
                    $uneCategorie = $route->urlFor('elementsCategorie', [['id', $categorie->id]]);
                    $viewCategorie .="
                         <section>
                              <img src='".$http_req->root."/html/img/Poivrons-rouges.jpg' alt='image'>
                              <div>
                                   <a href=".$uneCategorie.">$categorie->nom</a>
                              </div>
                         </section>
                    ";
               }
               $viewCategorie .= "</article>";
               return $viewCategorie;
          }
          private function renderProducteurs(){
               $route = new Router();
               $http_req = new HttpRequest();
               $lesProducteurs = $this->data;
               $viewProducteurs ="<article><h2 class='titre_article'>Les différents producteurs</h2>";
               foreach ($lesProducteurs as $producteur) {
                    $unProducteur = $route->urlFor('elementsProducteur',[['id',$producteur->id]]);
                    $viewProducteurs .="
                         <section>
                              <img src='".$http_req->root."/html/img/images.png' alt='image'>
                              <div>
                                   <a href=".$unProducteur.">
                                        $producteur->nom<br>
                                        $producteur->localisation
                                   </a>
                              </div>
                         </section>
                    ";
               }
               $viewProducteurs .="</article>";
               return $viewProducteurs;
          }
          private function renderUneCategorie(){
               $route = new Router();
               $http_req = new HttpRequest();
               $elements = $this->data;
               $elementsCategorie ="<article><h2 class='titre_article'>Les différents produits de la catégorie </h2>";
               $idCategorie = filter_var($_GET['id'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               foreach ($elements as $unElement) {
                    $ajouterPanier = $route->urlFor('elementsCategorie',[['id',$idCategorie],['id_element',$unElement->id]]);
                    $elementsCategorie .= "
                         <section>
                              <img src='".$http_req->root."/html/img/Poivrons-rouges.jpg' alt='image'/>
                              <div>
                                   <div class='nomElement'>$unElement->nom</div>
                                   <div class='descElement'>$unElement->description</div>
                                   <div class='tarifElement'>$unElement->tarif_unitaire</div>
                                   <form class='formulairePanier' action=".$ajouterPanier." method='POST'>
                                        <input name='quantite' type='number' value='0'></input>
                                        <button type='submit' name='submit'>Ajouter au Panier</button>
                                   </form>
                              </div>
                         </section>
                    ";
               }
               return $elementsCategorie;
          }
          private function renderElementsProducteur(){
               $route = new Router();
               $http_req = new HttpRequest();
               $elements = $this->data;
               $elementsProducteur="<article>
               <h2 class='titre_article'>Informations sur le producteur</h2>
               
               <h2 class='titre_article'>Les différents produits du producteur </h2>";
               $idProducteur = filter_var($_GET['id'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
               
               foreach ($elements as $unElement) {
                    $ajouterPanier = $route->urlFor('elementsProducteur',[['id',$idProducteur],['id_element',$unElement->id]]);
                    $elementsProducteur .= "
                         <section>
                              <img src='".$http_req->root."/html/img/Poivrons-rouges.jpg' alt='image'>
                              <div>
                                   <div class='nomElement'>$unElement->nom</div>
                                   <div class='descElement'>$unElement->description</div>
                                   <div class='tarifElement'>$unElement->tarif_unitaire</div>
                                   <form class='formulairePanier' action=".$ajouterPanier." method='POST'>
                                        <input name='quantite' type='number' value='0'></input>
                                        <button type='submit' name='submit'>Ajouter au Panier</button>
                                   </form>
                              </div>
                         </section>
                    ";
               }
               return $elementsProducteur;
          }

          private function renderPanier() {
               $route = new Router();
               $http_req = new HttpRequest();
               $elements = $this->data;
               $elementsProducteur="<article><h2 class='titre_article'>Les articles du panier</h2>";
               foreach ($elements as $id => $unElement) {
                    $tarif_unitaire = floatval($unElement[0]["tarif_unitaire"]);
                    $quantite = $unElement[1];
                    $supprimerPanier = $route->urlFor('panier',[['id',$id]]);
                    $elementsProducteur .= "
                         <section>
                              <img src='".$http_req->root."/html/img/Poivrons-rouges.jpg' alt='image'>
                              <div>
                                   <h3 class='nomElement'>".$unElement[0]["nom"]."</h3>
                                   <div class='descElement'>".$unElement[0]["description"]."</div>
                                   <div class='tarifElement'>".$tarif_unitaire." &#8364/unité</div>
                                   <div class=''>Nombre : ".$quantite."</div>
                                   <div class=''>".$tarif_unitaire*$quantite." &#8364</div>
                                   <a href=".$supprimerPanier."><button>Retirer</button></a>
                              </div>
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
                    case 'renderPanier':
                         $content = $this->renderPanier();
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