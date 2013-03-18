<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Dependencias extends CI_Controller {
 
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
    $this->load->view('dependencias/agrega_dependencia_view');
    $this->load->view('footer');
  } 

  function actualizarDependencia()
  {
    $_id = $this->security->xss_clean($this->input->post('id'));
    $unidad = $this->security->xss_clean($this->input->post('unidad'));
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $calle = $this->security->xss_clean($this->input->post('calle'));
    $colonia = $this->security->xss_clean($this->input->post('colonia'));
    $numero = $this->security->xss_clean($this->input->post('numero'));
    $cp = $this->security->xss_clean($this->input->post('cp'));
    $telefono = $this->security->xss_clean($this->input->post('telefono'));
    $pagina = $this->security->xss_clean($this->input->post('pagina'));
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $this->load->model('dependencia');
    $resultado=$this->dependencia->actualizarDependencia($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud);
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

  function agregarDependencia()
  {
    
    $_id = "UV0".$this->getId();
    $unidad = $this->security->xss_clean($this->input->post('unidad'));
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $calle = $this->security->xss_clean($this->input->post('calle'));
    $colonia = $this->security->xss_clean($this->input->post('colonia'));
    $numero = $this->security->xss_clean($this->input->post('numero'));
    $cp = $this->security->xss_clean($this->input->post('cp'));
    $telefono = $this->security->xss_clean($this->input->post('telefono'));
    $pagina = $this->security->xss_clean($this->input->post('pagina'));
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $this->load->model('dependencia');
    $resultado=$this->dependencia->agregar($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud);
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


  function consultarDependencia()
  {
    $id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('dependencia');
    $datos=$this->dependencia->getDependencia($id);
    echo json_encode($datos);
  }

  function getId()
  {
    $this->load->model('dependencia');
    $dependencia=$this->dependencia->getUltimoId();
    if(sizeof($dependencia)==0)
      return "1";
    $numero= substr($dependencia[0]['_id'],3, strlen($dependencia[0]['_id'])-1)  ;
    $numero= (int) $numero;
    ++$numero;
    return $numero;
  }
  
  function editar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('dependencia');
    $dependencias=$this->dependencia->getDependencias();
    $data= array('dependencias'=>$dependencias);
    $this->load->view('dependencias/edita_dependencia_view',$data);
    $this->load->view('footer');
  } 

  function eliminar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('dependencia');
    $dependencias=$this->dependencia->getDependencias();
    $data= array('dependencias'=>$dependencias);
    $this->load->view('dependencias/elimina_dependencia_view',$data);
    $this->load->view('footer');
  }

  function eliminarDependencia()
  {
    $id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('dependencia');
    $exito=null;
    if($this->dependencia->eliminaDependencia($id))
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