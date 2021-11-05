<?php 
     namespace LeHangarLocal\model;

     class Panier{

          public static function ajouterPanier($idProduit,$quantite){
               if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = array();
               }
               $_SESSION['panier'][]=[$idProduit,$quantite];
               
          }
     }
?>