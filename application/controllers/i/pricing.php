<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->language_validate->verify(); // verifica a linguagem
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
                     
                      
	 }
	
	
	 public function index()
	 {
           

	   $data['title'] = $this->lang->line('pre_login_label_planos');
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('planos',$data);
	   $this->load->view('templates/footer');
	 }
	 
	
         public function check_isvalidated_ok(){
                if($this->session->userdata('validated')){
	 		redirect('i/dashboard');
	 	}
         }
	
}

?>
