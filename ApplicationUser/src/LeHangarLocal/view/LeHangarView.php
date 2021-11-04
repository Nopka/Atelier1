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
               return '<header class="theme1"><h1>LeHangar.Local</h1>';
          }
          private function renderMenu(){
               return '
               <nav id="menu">
                    <ul>
                         <li>Accueil</li>
                         <li>Producteur</li>
                         <li>Panier</li>
                    </ul>
               </nav>
           ';
          }
          private function renderHome(){
               $route = new Router();
               $lesCategories = $this->data;
               $viewCategorie = "<article><h2>Les différentes catégories de produits</h2>";
               foreach ($lesCategories as $categorie) {
                    $viewCategorie .="
                         <section>
                              <img src='' alt='image'>
                              <p>$categorie->nom</p>
                         </section>
                    ";
               }
               $viewCategorie .= "</article>";
               return $viewCategorie;
          }

          protected function renderBody($selector)
          {
               $header = $this->renderHeader();
               $menu = $this->renderMenu();

               switch ($selector){
                    case 'renderHome':
                         $content = $this->renderHome();
                         break;
               }
               $body = <<<EOT
                    ${header}
                    ${menu}
                    ${content}
               EOT;
               return $body;
          }
     }
?>