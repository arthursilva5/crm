<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página
                     
            $this->load->library('form_validation'); 
            
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	
	 public function index()
	 {
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           
           $plano_cliente = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id);
           
           $data['plano_escolhido'] = $plano_cliente->plano;
           

	   $data['title'] = $this->lang->line('common_plano_label_titulo_meu_plano');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('meuplano/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
	 
         
         public function change()
         {
             
             
	 	$this->form_validation->set_rules('plano', '', 'required');                                       
                
	 	if ($this->form_validation->run() == FALSE)
	 	{
                    redirect('i/plan');
                }             
                else {
                    if(!$this->clientes_model->set_cliente_plano_update($this->cliente_id, $this->input->post('plano'))){ // muda o plano
                        $msg_erro = $this->lang->line('common_meuplano_sucesso_plano_gratis_atualizar_erro');
                        $this->session->set_flashdata('msg_erro', $msg_erro);

                        redirect('i/plan');                        
                    }
                    else {
                        $msg = $this->lang->line('common_meuplano_sucesso_plano_atualizado');
                        $this->session->set_flashdata('msg', $msg);

                        redirect('i/plan');
                    }
                }
            
                                 
                         
         }                       
	
}

?>
