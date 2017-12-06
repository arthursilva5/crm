<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	
	 public function index()
	 {
           
           $this->load->model('usuarios_oportunidades_model');
           $data['tipo1'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 1);
           $data['tipo2'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 2);
           $data['tipo3'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 3);
           $data['tipo4'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 4);
           $data['tipo5'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 5);
           $data['tipo6'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 6);
           $data['tipo7'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 7);
           $data['tipo8'] = $this->usuarios_oportunidades_model->get_total_oportunidade_by_client_id($this->cliente_id, 8);
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           

	   $data['title'] = $this->lang->line('common_dashboard_title');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('dashboard',$data);
	   $this->load->view('templates/footer');
	 }
	
}

?>
