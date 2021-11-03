<?php

namespace application\model;
class Compte extends \Illuminate\Database\Eloquent\Model{

    protected $table= 'compte';
    protected $primaryKey= 'id';

    public function producteur(){
       return $this->belongsTo('application\model\Producteur','mail');                   
    }




 









}
