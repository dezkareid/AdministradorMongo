<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Dependencias extends CI_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->model('users');
    $this->load->library('Validador');
  }
  

  function actualizarDependencia()
  {
    $this->verifica();
    $_id = $this->security->xss_clean($this->input->post('id'));
    $_id = $this->validador->limpieza($_id);
    $unidad = $this->security->xss_clean($this->input->post('unidad'));
    $unidad = $this->validador->limpieza($unidad);
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $nombre = $this->validador->limpieza($nombre);
    $calle = $this->security->xss_clean($this->input->post('calle'));
    $calle = $this->validador->limpieza($calle);
    $colonia = $this->security->xss_clean($this->input->post('colonia'));
    $colonia = $this->validador->limpieza($colonia);
    $numero = $this->security->xss_clean($this->input->post('numero'));
    $numero = $this->validador->limpieza($numero);
    $cp = $this->security->xss_clean($this->input->post('cp'));
    $cp = $this->validador->limpieza($cp);
    $telefono = $this->security->xss_clean($this->input->post('telefono'));
    $telefono = $this->validador->limpieza($telefono);
    $pagina = $this->security->xss_clean($this->input->post('pagina'));
    $pagina = $this->validador->limpieza($pagina);
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $this->load->model('dependencia');
    $exito=null;
    if($this->validador->validaActualizarDependencia($unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud))
    {
    
      $resultado=$this->dependencia->actualizarDependencia($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud);
    
      if($resultado)
      {
        $exito= array("Men"=>1);
      }
      else
      {
        $exito= array("Men"=>0);
      }
    }
    else
      $exito= array("Men"=>2);
    echo json_encode($exito);
  }

  function agregar()
  { 
    $this->agregaMenus();
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('dependencias/agrega_dependencia_view');
    $this->load->view('footerDependencias');
  }
  
  function agregarDependencia()
  {
    $this->verifica();
    $_id = "UV0".$this->getId();
    $unidad = $this->security->xss_clean($this->input->post('unidad'));
    $unidad = $this->validador->limpieza($unidad);
    $nombre = $this->security->xss_clean($this->input->post('nombre'));
    $nombre = $this->validador->limpieza($nombre);
    $calle = $this->security->xss_clean($this->input->post('calle'));
    $colonia = $this->security->xss_clean($this->input->post('colonia'));
    $numero = $this->security->xss_clean($this->input->post('numero'));
    $numero = $this->validador->limpieza($numero);
    $cp = $this->security->xss_clean($this->input->post('cp'));
    $cp = $this->validador->limpieza($cp);
    $telefono = $this->security->xss_clean($this->input->post('telefono'));
    $telefono = $this->validador->limpieza($telefono);
    $pagina = $this->security->xss_clean($this->input->post('pagina'));
    $pagina = $this->validador->limpieza($pagina);
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $this->load->model('dependencia');
    $exito=null;
    if($this->validador->validaActualizarDependencia($unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud))
    {
      $resultado=$this->dependencia->agregar($_id,$unidad, $nombre, $calle, $colonia, $cp,$numero,$pagina,$telefono,$latitud, $longitud);
      if($resultado)
      {
        $exito= array("Men"=>1);
      }
      else
      {
        $exito= array("Men"=>0);
      }
    }else
      $exito= array("Men"=>2);
    echo json_encode($exito);
  }

  function agregaMenus(){
    $result=$this->users->logueado();
    if ($result<1)
      redirect('login', 'refresh');
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    if($result==2)
      $this->load->view('menus/menu_usuario_view');
  }

  function consultarDependencia()
  {
    $this->verifica();
    $id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('dependencia');
    $datos=$this->dependencia->getDependencia($id);
    echo json_encode($datos);
  }

  function getId()
  {
    $this->verifica();
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
    $this->agregaMenus();
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('dependencia');
    $dependencias=$this->dependencia->getDependencias();
    $data= array('dependencias'=>$dependencias);
    $this->load->view('dependencias/edita_dependencia_view',$data);
    $this->load->view('footerDependencias');
  } 

  function eliminar()
  {
    $this->agregaMenus();
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
    $this->verifica();
    $id = $this->security->xss_clean($this->input->post('id'));
    $id= $this->validador->limpieza($id);
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

  function verifica()
  {

    $result=$this->users->logueado();
    if ($result<1)
      redirect('login', 'refresh');
      
  }


}

 

?>