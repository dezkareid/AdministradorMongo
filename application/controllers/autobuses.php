<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Autobuses extends CI_Controller {
 
  function __construct(){
    parent::__construct();
  }
 

  function index()
  {
    $this->load->view('encabezados');
    $this->load->view('menu_begin_view');
    $this->load->view('menu_autobus_view');
    $this->load->view('menu_acciones_view');
    $this->load->view('menu_end_view');
    $this->load->view('footer');
  } 

  function agregar()
  {
    $this->load->view('encabezados');
    $this->load->view('menu_begin_view');
    $this->load->view('menu_autobus_view');
    $this->load->view('menu_acciones_view');
    $this->load->view('menu_end_view');
    $this->load->view('autobus/agrega_autobus_view');
    $this->load->view('footer');
  } 

  function editar()
  {
    $this->load->view('encabezados');
    $this->load->view('menu_begin_view');
    $this->load->view('menu_autobus_view');
    $this->load->view('menu_acciones_view');
    $this->load->view('menu_end_view');
    $this->load->view('autobus/edita_autobus_view');
    $this->load->view('footer');
  } 

  function eliminar()
  {
    $this->load->view('encabezados');
    $this->load->view('menu_begin_view');
    $this->load->view('menu_autobus_view');
    $this->load->view('menu_acciones_view');
    $this->load->view('menu_end_view');
    $this->load->view('autobus/elimina_autobus_view');
    $this->load->view('footer');
  } 
  
}

 

?>