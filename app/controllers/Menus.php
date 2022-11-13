<?php
  class Menus extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
    //to make sure that you only have access to this page if you're 
    // logged in. if not, redirect. 

      //we need this in the constructor to be used.
      $this->menuModel = $this->model('Menu');
      $this->userModel = $this->model('User');
    }

    public function index(){
   
      //here we are calling the getmenus and returning the data to pass it to the view 
      $menus = $this->menuModel->getMenus();
    
      //associating the result of the query inside the data 
      $data = [
        'menus' => $menus
      ];
      //passing the result of the query to be displayed 
      $this->view('menus/index', $data);

      
    }


    public function find(){
      //search box function. Still needs work 
      $menus = $this->menuModel->findMenu();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
      $data = [
        'find'=>$menus,
      ];
    }
      $this->view('menus/index', $data);
  }


    public function add(){
      //to add menu item
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //if the form is submitted (post request)

        //we are associating the entries to these values 
        $data = [
          'title' => trim($_POST['title']),
          'description' => trim($_POST['description']),
          'price'=> trim($_POST['price']),
          'user_id' => $_SESSION['user_id'],
        ];


            
            $this->menuModel->addMenu($data);
            
            
            // ){
            redirect('menus');
          // } else {
            // die('Something went wrong');
        //   }
        // } else {
          // Load view with errors
          $this->view('menus/add', $data);
        }

      // } else {
        $data = [
          'title' => '',
          'description' => '',
          'price' => ''
        ];
  
        $this->view('menus/add', $data);
      }
    

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array


        $data = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'description' => trim($_POST['description']),
          'price'=> trim($_POST['price']),
          'user_id' => $_SESSION['user_id'],
          
        ];


        // Make sure no errors

          if($this->menuModel->updateMenu($data)
          
        );
          
          
          // {
            // flash('post_message', 'Post Updated');
            redirect('menus');


          $this->view('menus/edit', $data);
        }


        // Get existing post from model
        $menu = $this->menuModel->getMenuById($id);

        // Check for owner
        if($menu->user_id != $_SESSION['user_id']){
          redirect('menus');
        }

        $data = [
          'id' => $id,
          'title' => $menu->title,
          'description' => $menu->description,
          'price'=> $menu->price
        ]; 
  
        $this->view('menus/edit', $data);
      }
    

    public function show($id){
      //after clicking on the item, 
      //call the getmenuitem method and get user by id method
      //they both have to return true to be stored inside data 
      $menu = $this->menuModel->getMenuById($id);
      $user = $this->userModel->getUserById($menu->user_id);

      $data = [
        'menu' => $menu,
        'user' => $user
      ];
      //pass them to the view 
      $this->view('menus/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $menu = $this->menuModel->getMenuById($id);
        
        // to check if youre the user. 
        //if the user id is not equal to the session id stored, do not proceed 
        if($menu->user_id != $_SESSION['user_id']){
          redirect('menus');
        }
          //if the deletion returns successfully 
        if($this->menuModel->deleteMenu($id)){
          //go baack 
          redirect('menus');

      }
    }
  }
  
}