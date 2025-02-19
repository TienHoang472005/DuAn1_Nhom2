<?php
class LoginUserController{
    public function login(){
        include 'app/Views/Users/login.php';
    }

    public function postLogin(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $loginModel = new LoginModel();
          $dataUsers = $loginModel->checkLogin();
          if($dataUsers){
              $_SESSION['users'] = [
                  'id' => $dataUsers->id,
                  'name' => $dataUsers->name,
                  'email' => $dataUsers->email
              ];
              header("Location: " . "?act" );
              exit;
          }else{
              $_SESSION['error'] = "Email hoặc Password không đúng!";
              header("Location: " . "?act=login");
              exit;
          }
      } 
  }
}