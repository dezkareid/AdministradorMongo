<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

		$this->load->view('encabezados');
		$this->load->view('login_view');
		$this->load->view('footer');
	}

    public function process(){
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
       
    }

	
}


?>