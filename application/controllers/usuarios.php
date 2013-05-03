<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Usuarios extends CI_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->model('users');
    $this->load->library('Validador');
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
    $id= $this->validador->limpieza($id);
    $datos="Error";
    if(!$this->validador->estaVacia($id))
      $datos=$this->users->getUsuario($id);
    echo json_encode($datos);
  }

  function guardaUsuario()
  {
    $this->verifica();
    $usuario = $this->security->xss_clean($this->input->post('usuario'));
    $usuario = $this->validador->limpieza($usuario);
    $password = $this->security->xss_clean($this->input->post('password'));
    $password = $this->validador->limpieza($password);
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $nombre = $this->validador->limpieza($nombre);
    $correo = $this->security->xss_clean($this->input->post('correo'));
    $correo = $this->validador->limpieza($correo);
    $acceso = $this->security->xss_clean($this->input->post('acceso'));    
    $acceso = $this->validador->limpieza($acceso);    
    $exito=null;
    if($this->validador->validaActualizarUsuario($usuario,$password,$nombre,$correo,$acceso,0)){
      $data = array('Usuario' => $usuario,'Password' => sha1($password), 'Nombre'=> $nombre, 'Correo'=> $correo, 'Acceso'=> $acceso);
      $registros=$this->users->getNumUsuarios($usuario);
      if(empty($registros))
        if($this->users->agrega($data))
        {
          $exito= array("Men"=>1);
        }
        else
        {
          $exito= array("Men"=>0);
        }
      else
        $exito= array("Men"=>3);
    }
    else
     $exito= array("Men"=>2); 
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
    $id= $this->validador->limpieza($id);
    $usuario = $this->security->xss_clean($this->input->post('usuario'));
    $usuario = $this->validador->limpieza($usuario);
    $password = $this->security->xss_clean($this->input->post('password'));
    $password = $this->validador->limpieza($password);
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $nombre = $this->validador->limpieza($nombre);
    $correo = $this->security->xss_clean($this->input->post('correo'));
    $correo = $this->validador->limpieza($correo);
    $acceso = $this->security->xss_clean($this->input->post('acceso'));    
    $acceso = $this->validador->limpieza($acceso);
    $exito=null;
    if($this->validador->validaActualizarUsuario($usuario,$password,$nombre,$correo,$acceso,1)){
      $registros=$this->users->getNumUsuarios($usuario);
      if(sizeof($registros)==1){
        $mi_Id=(string) $registros[0]['_id'];
        if(strcmp($mi_Id,$id)==0)
          if($this->users->actualizaUsuario($id,$usuario,$password,$nombre,$correo,$acceso))
          {
            $exito= array("Men"=>1);
          }
          else
          {
            $exito= array("Men"=>0);
          }
        else
          $exito= array("Men"=>3);
      }
      else
        $exito= array("Men"=>3);
    }else
      $exito= array("Men"=>2);
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
    $id= $this->validador->limpieza($id);
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