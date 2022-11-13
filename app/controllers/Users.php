<?php
  class Users extends Controller {
    public function __construct(){
      //to make sure we are referring to User when putting userModel
      $this->userModel = $this->model('User');
    }
    public function login(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'EmailError' => '',
          'PasswordError' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['EmailError'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['PasswordError'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['EmailError'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['EmailError']) && empty($data['PasswordError'])){
          // Validated
          // Check and set logged in user
          $UserHasLoggedIn = $this->userModel->login($data['email'], $data['password']);

          if($UserHasLoggedIn){
            // Create Session
            $this->StartASession($UserHasLoggedIn);
          } else {
            $data['PasswordError'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'EmailError' => '',
          'PasswordError' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }
    public function registration(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data


        // Initilize 
        //trim is for those we want to edit 
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'EmailError' => '',
          'PasswordError' => '',
          'confirm_PasswordError' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['EmailError'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['EmailError'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['PasswordError'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['PasswordError'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_PasswordError'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_PasswordError'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['EmailError']) && empty($data['name_err']) && empty($data['PasswordError']) && empty($data['confirm_PasswordError'])){
          //Validated
          
          //Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // registration User
          if($this->userModel->registration($data)){
            // flash('registration_success', 'You are registrationed and can log in');
            redirect('users/login');
          } else {
            die('error');
          }

        }else {
          // Load view with errors
          $this->view('users/registration', $data);
        
        }
         } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'EmailError' => '',
          'PasswordError' => '',
          'confirm_PasswordError' => ''
        ];

        // Load view
        $this->view('users/registration', $data);
      }
      }
    



    public function StartASession($user){
      $_SESSION['user_id'] = $user->id;

      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;



      redirect('menus');
    }

    public function logout(){

      unset($_SESSION['user_id']);

      unset($_SESSION['user_email']);

      unset($_SESSION['user_name']);

      session_destroy();



      redirect('users/login');
    }
  }