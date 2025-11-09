<?php

namespace app\Controllers;

use app\Models\Contact;

class HomeController extends Controller{

    public function index(){

        $contactModel = new Contact();

        $contacts = $contactModel->all();

        return $this->view('home',[
            'title' => 'Home',
            'content' => 'This is the home page',
            'contacts' => $contacts
        ]);
    }

}