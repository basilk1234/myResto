<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    //here we have the main pages for the applicatpon 
    public function index(){
      if(isLoggedIn()){
        redirect('menus');
      }

      $data = [
        'title' => 'myResto Admin',
        'description' => 'Administration tool to manage menu items'
      ];
     //pass the data to the pages view 
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'My Resto Menu administrator'
      ];
      //pass data to abot 
      $this->view('pages/about', $data);
    }
  }