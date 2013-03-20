<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Paradas extends CI_Controller {
 
  function __construct(){
    parent::__construct();
  }
 

  function index()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_parada_view');
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
    $this->load->model('autobus');
    $autobuses=$this->autobus->getAutobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('paradas/agrega_parada_view',$data);
    $this->load->view('footer');
  } 

  function agregarParada()
  {
     $_id = $this->security->xss_clean($this->input->post('id'));
     $this->load->model('parada');
    $resultado=$this->parada->getParadas($_id);
    //unset($resultado[0]['Paradas'][1]);
    $indice= (int) $this->security->xss_clean($this->input->post('indice'));
    $tiempo= (int) $this->security->xss_clean($this->input->post('tiempo'));
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $paradas=array();
    $parada= array('Latitud'=>$latitud,'Longitud'=>$longitud,'Tiempo'=>$tiempo);
    $resultado[0]['Paradas']=array_values($resultado[0]['Paradas']);
    $final=sizeof($resultado[0]['Paradas']);
    for ($i=0;$i<$indice-1;$i++) 
    {
      array_push($paradas, $resultado[0]['Paradas'][$i]);
    }

    array_push($paradas, $parada);

    for ($i=$indice-1;$i<$final;$i++) 
    {
      array_push($paradas, $resultado[0]['Paradas'][$i]);
    }
   
    $actulizo=$this->parada->actualizarParadas($_id,$paradas);
    $exito=null;
    if($actulizo)
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
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('paradas/edita_parada_view');
    $this->load->view('footer');
  } 

  function eliminar()
  {
    $this->load->view('encabezados');
    $this->load->view('menus/menu_begin_view');
    $this->load->view('menus/menu_usuario_view');
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->view('paradas/elimina_parada_view');
    $this->load->view('footer');
  } 
  
}

 

?>