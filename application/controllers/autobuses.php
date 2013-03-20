<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Autobuses extends CI_Controller {
 
  function __construct(){
    parent::__construct();
  }
 

  function index()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('footer');
  } 

  function agregar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('autobuses/agrega_autobus_view');
    $this->load->view('footer');
  } 

  function agregarAutobus()
  {
    $_id = "AU0".$this->getId();
    $linea = $this->security->xss_clean($this->input->post('linea'));
    $descripcion = $this->security->xss_clean($this->input->post('descripcion'));
    $trayecto = $this->security->xss_clean($this->input->post('trayecto'));
    $primeraSalida = $this->security->xss_clean($this->input->post('primeraSalida'));
    $ultimaSalida = $this->security->xss_clean($this->input->post('ultimaSalida'));
    $tiempoEspera = $this->security->xss_clean($this->input->post('tiempoEspera'));
    $this->load->model('autobus');
    $resultado=$this->autobus->agregar($_id,$linea, $descripcion, $trayecto, $primeraSalida, $ultimaSalida, $tiempoEspera);
    $exito=null;
    if($resultado)
    {
      $exito= array("Men"=>1);
    }
    else
    {
      $exito= array("Men"=>0);
    }

    echo json_encode($exito);
  }

  function consultarAutobus()
  {
    $id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('autobus');
    $datos=$this->autobus->getAutobus($id);
    echo json_encode($datos);
  }

  function editar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('autobus');
    $autobuses=$this->autobus->getAutobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('autobuses/edita_autobus_view',$data);
    $this->load->view('footer');
  } 

  function eliminar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('autobus');
    $autobuses=$this->autobus->getautobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('autobuses/elimina_autobus_view',$data);
    $this->load->view('footer');
  } 

  function eliminarAutobus()
  {
    $id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('autobus');
    $exito=null;
    if($this->autobus->eliminaAutobus($id))
    {
      $exito= array("Men"=>1);
    }
    else
    {
      $exito= array("Men"=>0);
    }
      
    echo json_encode($exito);
  }

  function getId()
  {
    $this->load->model('autobus');
    $autobus=$this->autobus->getUltimoId();
    if(sizeof($autobus)==0)
      return "1";
    $numero= substr($autobus[0]['_id'],3, strlen($autobus[0]['_id'])-1)  ;
    $numero= (int) $numero;
    ++$numero;
    return $numero;
  }
  
}

 

?>