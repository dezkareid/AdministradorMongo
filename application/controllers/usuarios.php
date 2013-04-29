<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Usuarios extends CI_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->model('users');
  }
 
  function verifica()
  {

    $result=$this->users->logueado();
    switch ($result) {
      case 0:
        redirect('login', 'refresh');
        break;
      case 1:
        redirect('home', 'refresh');
        break;
    } 
  }


  function agregar()
  {

    $this->verifica();
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('usuarios/agrega_usuario_view');
    $this->load->view('footer');
  } 

  function consultarUsuario()
  {
    $this->verifica();
    $id = $this->security->xss_clean($this->input->post('id'));
    $datos=$this->users->getUsuario($id);
    echo json_encode($datos);
  }

  function guardaUsuario()
  {
    $this->verifica();
    $usuario = $this->security->xss_clean($this->input->post('usuario'));
    $password = $this->security->xss_clean($this->input->post('password'));
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $correo = $this->security->xss_clean($this->input->post('correo'));
    $acceso = $this->security->xss_clean($this->input->post('acceso'));
    $data = array('Usuario' => $usuario,'Password' => sha1($password), 'Nombre'=> $nombre, 'Correo'=> $correo, 'Acceso'=> $acceso);
    $this->load->model('users');
    $exito=null;
    if($this->users->agrega($data))
    {
      $exito= array("Men"=>1);
    }
    else
    {
      $exito= array("Men"=>0);
    }
      
    echo json_encode($exito);
  }

  function editar()
  { 
    $this->verifica();
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $usuarios=$this->users->getUsuarios();
    $data= array('usuarios'=>$usuarios);
    $this->load->view('usuarios/edita_usuario_view',$data);
    $this->load->view('footer');
  }

  function actualizarUsuario()
  {
    $this->verifica();
    $id = $this->security->xss_clean($this->input->post('id'));
    $usuario = $this->security->xss_clean($this->input->post('usuario'));
    $password = $this->security->xss_clean($this->input->post('password'));
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $correo = $this->security->xss_clean($this->input->post('correo'));
    $acceso = $this->security->xss_clean($this->input->post('acceso'));    
    $exito=null;
    if($this->users->actualizaUsuario($id,$usuario,$password,$nombre,$correo,$acceso))
    {
      $exito= array("Men"=>1);
    }
    else
    {
      $exito= array("Men"=>0);
    }
      
    echo json_encode($exito);
  }

  function eliminar()
  {
    $this->verifica();
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $usuarios=$this->users->getUsuarios();
    $data= array('usuarios'=>$usuarios);
    $this->load->view('usuarios/elimina_usuario_view',$data);
    $this->load->view('footer');
  } 

  function eliminarUsuario()
  {

    $this->verifica();
    $id = $this->security->xss_clean($this->input->post('id'));
    $exito=null;
    if($this->users->eliminaUsuario($id))
    {
      $exito= array("Men"=>1);
    }
    else
    {
      $exito= array("Men"=>0);
    }
      
    echo json_encode($exito);
  
  }
  
}

 

?>