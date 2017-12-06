<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Erro404 extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->language_validate->verify(); // verifica a linguagem

           $this->lang->load('common', $this->session->userdata('default_lang'));
           $this->lang->load('header', $this->session->userdata('default_lang'));                         
                      
	 }
	
	
	 public function index()
	 {           
	   $data['title'] = $this->lang->line('common_label_erro_404_titulo');	 		 		  
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('erro404',$data);
	   $this->load->view('templates/footer');
	 }
	
}

?>
