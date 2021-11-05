<?php 
     namespace LeHangarLocal\model;

     class Panier{

          public static function GetAllProduits() {
               if(isset($_SESSION["panier"])){
                    return $_SESSION["panier"];
               }else{
                    return null;
               }
          }

          public static function ajouterPanier($idProduit, $infoProduit, $quantite){
               if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = array();
               }
               $_SESSION['panier'][$idProduit]=[$infoProduit, $quantite];
               
          }
          public static function supprimerDuPanier($idProduit){
               unset($_SESSION['panier'][$idProduit]);
          }

          
     }
?>