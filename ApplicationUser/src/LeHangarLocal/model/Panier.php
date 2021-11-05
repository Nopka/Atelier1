<?php 
     namespace LeHangarLocal\model;

     class Panier{

          public static function ajouterPanier($idProduit, $infoProduit, $quantite){
               if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = array();
               }
               $_SESSION['panier'][$idProduit]=[$infoProduit, $quantite];
               
          }

          public static function GetAllProduits() {
               return $_SESSION["panier"];
          }
     }
?>