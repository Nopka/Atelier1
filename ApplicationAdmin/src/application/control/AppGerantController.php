<?php

namespace application\control;

use mf\utils\HttpRequest;
use \tweeterapp\model\Tweet as Tweet;
use \tweeterapp\model\User as User;
use \tweeterapp\view\TweeterView as tweeterView;
use \mf\router\Router;


class TweeterController extends \mf\control\AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * récuperer les données depuis le modèle tweet
     * instancier la vue correspondante
     * appeller la vue
     */
    public function viewHome()
    {
        $tweets = Tweet::select()->get();
        $vue = new TweeterView($tweets);
        $vue->setAppTitle('Accueil');
        $vue->render('renderHome');
    }


    /* Méthode viewTweet : 
     *  
     * Réalise la fonctionnalité afficher un Tweet correspondant à un certain id
     *
     */

    public function viewTweet()
    {
        //récuperer l'id du tweet depuis l'url
        $id_tweet = $this->request->get;                                   //recuperer l'id passé en GET
        $tweet = Tweet::select()->where('id', '=', $id_tweet)->first();         //récuperer l'objet tweet correspondant depuis le modèl
        $vue_tweet = new tweeterView($tweet);                           //instancier une vue corresponsante en lui fournissant les données recupéré depuis le model
        $vue_tweet->setAppTitle('Tweet');
        $vue_tweet->render('renderViewTweet');                         //appeller la vue
    }


    /* Méthode viewUserTweets :
     *
     * Réalise la fonctionnalité afficher les tweet d'un utilisateur
     *
     */

    public function viewUserTweets()
    {
        $requet = new HttpRequest();
        $id_user = $requet->get;
        $user = User::where('id', '=', $id_user)->first();
        $tweets = $user->tweets()->get();
        $viewTweets = new tweeterView($tweets);
        $user_fullname = $user['fullname'];
        $viewTweets->setAppTitle("Tweets de $user_fullname");
        $viewTweets->render('rendreUserTweets');
    }

    public function viewFormulaire()
    {
        $viewformulaire = new tweeterView("");
        $viewformulaire->setAppTitle('Tweet something...');
        $viewformulaire->render('renderPostTweet');
    }

    public function viewFollowers()
    {
        $userUsername = $_SESSION['user_login'];
        $user = User::where('username', '=', $userUsername)->first();
        $followers = $user->followedBy()->get();
        $viewFollowers = new tweeterView($followers);
        $viewFollowers->setAppTitle('Followers');
        $viewFollowers->render('renderFollowers');
    }
    public function dataForm()
    {
            $data = filter_var($_POST['tweet'], FILTER_SANITIZE_SPECIAL_CHARS);
            $nv_tweet = new Tweet();
            $nv_tweet->text = $data;
            $nv_tweet->author = 2;          
            $nv_tweet->score = 0;
            if($nv_tweet->save() >0){
                $route = new Router();
                $route->executeRoute('maison');
            }
    }
}
