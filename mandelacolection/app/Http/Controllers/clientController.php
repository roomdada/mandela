<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientController extends Controller
{
    public function accueil(){
        return view("accueil");
    }
    public function boutique(){
        return view("boutique");
    }
    public function panier(){
        return view("panier");
    }
    public function contact(){
        return view("contact");
    }
    public function propos(){
        return view("propos");
    }
}
