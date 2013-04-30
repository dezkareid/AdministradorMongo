<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Paradas extends CI_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->model('users');
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

  function agregar()
  {
    $this->agregaMenus();
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('autobus');
    $autobuses=$this->autobus->getAutobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('paradas/agrega_parada_view',$data);
    $this->load->view('footerParadas');
  } 

  function actualizarParada()
  {
    $this->verifica();
    $_id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('parada');
    $resultado=$this->parada->getParadas($_id);
    $indice= (int) $this->security->xss_clean($this->input->post('indice'));
    $tiempo= (float) $this->security->xss_clean($this->input->post('tiempo'));
    $latitud = $this->security->xss_clean($this->input->post('latitud'));
    $longitud = $this->security->xss_clean($this->input->post('longitud'));
    $parada= array('Latitud'=>$latitud,'Longitud'=>$longitud,'Tiempo'=>$tiempo);
    $resultado[0]['Paradas'][$indice-1]=$parada;
    $actulizo=$this->parada->actualizarParadas($_id,$resultado[0]['Paradas']);
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

  function agregarParada()
  {
    $this->verifica();
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
    //$resultado[0]['Paradas']=array_values($resultado[0]['Paradas']);
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
    $this->agregaMenus();
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('autobus');
    $autobuses=$this->autobus->getAutobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('paradas/edita_parada_view',$data);
    $this->load->view('footerParadas');
  } 

  function eliminar()
  {
    $this->agregaMenus();
    $this->load->view('menus/menu_acciones_view');
    $this->load->view('menus/menu_end_view');
    $this->load->model('autobus');
    $autobuses=$this->autobus->getAutobuses();
    $data= array('autobuses'=>$autobuses);
    $this->load->view('paradas/elimina_parada_view',$data);
  }

  function eliminarParada()
   {
      $this->verifica();
      $_id = $this->security->xss_clean($this->input->post('id'));
      $this->load->model('parada');
      $resultado=$this->parada->getParadas($_id);
      $indice= (int) $this->security->xss_clean($this->input->post('indice'));
      unset($resultado[0]['Paradas'][$indice-1]);
      $resultado[0]['Paradas']=array_values($resultado[0]['Paradas']);
      $actulizo=$this->parada->actualizarParadas($_id,$resultado[0]['Paradas']);
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

  
  function getNumeroParadas()
  {
    $this->verifica();
    $_id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('parada');
    $resultado=$this->parada->getParadas($_id);
    $final=sizeof($resultado[0]['Paradas']);
    echo json_encode($final);
  }

  function getParada()
  {
    $this->verifica();
    $_id = $this->security->xss_clean($this->input->post('id'));
    $indice = (int) $this->security->xss_clean($this->input->post('indice'));
    $this->load->model('parada');
    $resultado=$this->parada->getParadas($_id);
    echo json_encode($resultado[0]['Paradas'][$indice-1]);
  }

  function getParadas()
  {
    $this->verifica();
    $_id = $this->security->xss_clean($this->input->post('id'));
    $this->load->model('parada');
    $resultado=$this->parada->getParadas($_id);
    echo json_encode($resultado[0]['Paradas']);
  }
}

  function verifica()
  {

    $result=$this->users->logueado();
    if ($result<1)
      redirect('login', 'refresh');
      
  }
 

?>