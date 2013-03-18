<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$datos=$this->mongo_db->get('DependenciasC');
		//$this->mongo_db->from('DependenciasC');
		//$contador=$this->mongo_db->get();
		$data = array('usuario' => 'Jhon Locke','mensaje' => 'Has encontrado la escotilla!', 'datos'=>$datos );
		//json_encode($data);
		$this->load->view('welcome_message',$data);
		//$this->load->
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */