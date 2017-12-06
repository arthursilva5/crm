<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->library('form_validation');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado   

           $this->load->model('contas_model');
           $this->load->model('usuarios_oportunidades_model');
           $this->load->model('usuarios_contatos_model');
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	 public function index()
	 {

             
            $this->load->library('form_validation'); 
            
            $this->form_validation->set_rules('busca', '', 'required');                                                                  
            

            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/dashboard');
            
            if(strlen($this->input->post('busca')) < 3) {                
                $msg_erro = $this->lang->line('common_buscas_erro_minimo_caracters'); 
                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/dashboard');
            }
                
            
            
            //$data['busca_string'] = $this->input->post('busca');
            
             // contas
            $data['rows_contas'] = $this->contas_model->busca_contas_by_cliente_id($this->cliente_id, $this->input->post('busca'));
            //oportunidades
            $data['rows_potenciais'] = $this->usuarios_oportunidades_model->busca_oportunidades_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, $this->input->post('busca'));
            //contatos
            $data['rows_contatos'] = $this->usuarios_contatos_model->busca_contatos_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, $this->input->post('busca'));
            
            
	   $data['title'] = $this->lang->line('common_buscas_titulo');
	   
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('buscas/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
      

}

?>
