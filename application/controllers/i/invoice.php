<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->model('clientes_faturas_model'); 
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated();
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
           
           if(! $this->clientes_model->check_dados_preenchidos($this->cliente_id) ){
                $msg = '<font color=blue><h5>'.$this->lang->line('common_faturas_preencha_os_dados').'</h5></font>';
                $this->session->set_flashdata('msg', $msg);
                redirect('i/myaccount');   
           }
           
           if(!$this->clientes_faturas_model->get_fatura_by_cliente_id($this->cliente_id, 'u')){
                $msg_erro = '<font color=red>'.$this->lang->line('common_faturas_nenhuma_encontrada').'</font>';
                $this->session->set_flashdata('msg_erro', $msg_erro);                
                redirect('i/plan');                
           }          
                      
	 }
	
	
	 public function index()
	 {                      
           
           $data['fatura_nao_paga'] = $this->clientes_faturas_model->get_fatura_by_cliente_id($this->cliente_id, 'u');
           $data['dados_cliente'] = $this->clientes_model->get_cliente_by_id($this->cliente_id);
           $data['plano_atual'] = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id);
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           

	   $data['title'] = $this->lang->line('common_faturas_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('faturas/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
	 public function payment_type()
	 {
           
           $this->load->model('clientes_faturas_model'); 
           
           $data['fatura_nao_paga'] = $this->clientes_faturas_model->get_fatura_by_cliente_id($this->cliente_id, 'u');
           $data['dados_cliente'] = $this->clientes_model->get_cliente_by_id($this->cliente_id);
           
                        
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           

	   $data['title'] = $this->lang->line('common_faturas_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('faturas/tipo_pagamento',$data);
	   $this->load->view('templates/footer');
	 }         
         
	
              
	
}

?>
