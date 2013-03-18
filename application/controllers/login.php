<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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

		/*$datos=$this->mongo_db->get('DependenciasC');
		//$this->mongo_db->from('DependenciasC');
		//$contador=$this->mongo_db->get();
		$data = array('usuario' => 'Jhon Locke','mensaje' => 'Has encontrado la escotilla!', 'datos'=>$datos );
		//json_encode($data);*/
		$this->load->view('encabezados');
		$this->load->view('login_view');
		$this->load->view('footer');
		//$this->load->
	}

    public function process(){
        // Load the model
        $this->load->model('users');
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        if($this->users->login($username,$password))
        	redirect('home');
        else
        {
        $this->load->view('encabezados');
		$this->load->view('login_view');
		$this->load->view('footer');
        }
        // Prep the query
        // Validate the user can login
       /* $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $this->index();
        }else{
            // If user did validate, 
            // Send them to members area
            redirect('home');
        } */ 
      
    }

	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>