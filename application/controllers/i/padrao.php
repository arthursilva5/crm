<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Padrao extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->language_validate->verify(); // verifica a linguagem
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           $this->check_isvalidated_ok();   
                      
	 }
	
	
	 public function index()
	 {
                      
           if($this->session->flashdata('msg_erro')){
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           }
           elseif($this->session->flashdata('msg')){
               $data['msg'] = $this->session->flashdata('msg');
           } 
           

	   $data['title'] = '';
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('landing_page',$data);
	   $this->load->view('templates/footer');
	 }
         
	 public function commissions()
	 {
                      
           if($this->session->flashdata('msg_erro')){
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           }
           elseif($this->session->flashdata('msg')){
               $data['msg'] = $this->session->flashdata('msg');
           } 
           

	   $data['title'] = '';
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('page_indicacoes',$data);
	   $this->load->view('templates/footer');
	 }         
         
	 public function contact()
	 {
                      
           if($this->session->flashdata('msg_erro')){
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           }
           elseif($this->session->flashdata('msg')){
               $data['msg'] = $this->session->flashdata('msg');
           } 
           

	   $data['title'] = '';
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('contato',$data);
	   $this->load->view('templates/footer');
	 }
         
	 public function contact_send()
	 {
                      
             
            $this->load->library('form_validation'); 
            

            $this->form_validation->set_rules('nome', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/padrao/contact');

            
            // envia email de boas vindas
            $this->lang->load('email_messages', 'english');
            $this->load->library('enviar_email');
            $mensagem_email = '---<br />'.$this->input->post('nome').'<br /> --- <br />';
            $mensagem_email .= '---<br />'.$this->input->post('email').'<br /> --- <br />';
            $mensagem_email .= '---<br />'.$this->input->post('mensagem').'<br /> --- <br />';

            $this->enviar_email->send_email($this->input->post('email'), $this->input->post('nome'), $this->lang->line('common_fatura_informacoes_empresa_email'), $this->lang->line('email_messages_contato_via_site'), $mensagem_email); // envia um e-mail para o vendedor
            //fim envia e-mail             
            
            $msg = '<font color=blue><h5>'.$this->lang->line('email_messages_contato_via_site_enviado').'</h5></font>';
            $this->session->set_flashdata('msg', $msg);
            redirect('i/padrao/contact');  
           
	 }          
	 
	
         public function check_isvalidated_ok(){
                if($this->session->userdata('validated')){
	 		redirect('i/dashboard');
	 	}
         }
	
}

?>
