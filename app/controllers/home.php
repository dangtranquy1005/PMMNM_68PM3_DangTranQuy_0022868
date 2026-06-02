<?php
require_once '../app/core/Controller.php';
class home extends Controller
{
  public function index()
  {
    $this->view('home/index');
  }

  public function about()
  {
    echo "Đây là trang giới thiệu";
  }
  public function login(){
   $this->view('home/login', [], null); 
  }
  public function logout(){
   $this->view('home/logout', [], null);
  }
}