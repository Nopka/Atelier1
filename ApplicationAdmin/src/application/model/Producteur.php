<?php

namespace application\model;
class Producteur extends \Illuminate\Database\Eloquent\Model{

    protected $table= 'producteur';
    protected $primaryKey= 'id';

    public function produits(){
       return $this->hasMany('application\model\Produit','id_producteur');                  
    }

    public function commandesProduit(){
        return $this->hasMany('application\model\CommandeProduit','');
    }

}
