<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->model('users');
  }
 

  function index(){
    if(!$this->session->userdata('logueo'))
   {

     redirect('login', 'refresh');

   }

    $session_data = $this->session->userdata('logueo');
    $user = $session_data['user'];
    $pass = $session_data['pass'];
    $result=$this->users->loged($user,$pass);
      
      if ($result==0)
        redirect('login', 'refresh');
      
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
      if($result==2)        
        $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('home_view');
    $this->load->view('footer');
  } 

}

 

?>