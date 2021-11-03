<?php

namespace application\view;

use Illuminate\Contracts\Auth\Authenticatable;
use mf\auth\Authentification;
use \mf\router\Router as Router;
use mf\utils\HttpRequest;
use tweeterapp\auth\TweeterAuthentification;
use tweeterapp\model\Tweet;
use application\auth\appAuthentification;
use application\model\CommandeProduit;

class AppView extends \mf\view\AbstractView
{

    public function __construct($data)
    {
        parent::__construct($data);
    }

    private function renderHeader()
    {
        return '<header>
                  <h1 id="titre">LeHongard.local</h1>
                </header>';
    }

    private function renderFooter()
    {
        return "FOOTER";
    }

    protected function renderLogin()
    {
      
        $route = new Router();
      
        $formulaire_connexion = '
        <section>
        <form method=post action='.$route->urlFor('checklogin', []).' >
        <label for="email">Adresse email</label>
        <input type=text id="email" name="mail" placeholder="Veuillez saisir votre email"><br/>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Veuillez saisir votre mot de passse">
        <button type="submit" name="submit">Se connecter</button>
        </form>
        </section>
        ';
        return $formulaire_connexion;
    }


    protected function renderCommandesProduit()
    {    
        $HtmlCommandeProduit = "";
        $produits = $this->data;                                    //la liste de tout les produit commandé concernant un certain producteur
        foreach($produits as $produit){                             
             $id = $produit->id;       
             $nom_produit = $produit->nom;
             $id_commande = CommandeProduit::select('id')->where('id_produit','=',$id)->get();
             echo $id_commande."<br/>";
             $HtmlCommandeProduit .="
             <section style = 'border : 3px solid'>
             <p>le nom du produit : $nom_produit</p>
             <p>quantité commandée pour ce produit :</p>
             </section>";
        }
            return $HtmlCommandeProduit;
    }
    protected function renderBody($selector)
    {
       $authentification = new appAuthentification();
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        switch ($selector) {
            case 'renderLogin':
                $content = $this->renderLogin();
                break;
            case 'renderCommandesProduit':
                $content = $this->renderCommandesProduit();
                break;
            default:
                echo "error";
        }
         
        if ($authentification->logged_in) {
            $body = <<<EOT
${header}                            
${content}
${footer}
EOT;
        } else {
            $body = <<<EOT
        ${header}                                     
        ${content}
        ${footer}
        EOT;
        }
        return $body;
    }
}
