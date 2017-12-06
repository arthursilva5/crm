<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
           
                      
	 }
	
	
	 public function index()
	 {
           $data['title'] = $this->lang->line('common_meusdados_titulo'); // titulo
           
           $data['usuario'] = $this->clientes_model->get_usuario_by_id($this->session->userdata('userid'));
           $data['cliente'] = $this->clientes_model->get_cliente_by_id($this->cliente_id);
           
           $this->load->model('cidades_model');
           $this->load->model('uf_model');
           $data['uf'] = $this->uf_model->get_uf_all();
           $data['cidades'] = $this->cidades_model->get_cidades_all();
           
           if($this->cidades_model->get_cidade_estado_nome_por_perfil_id($this->cliente_id))
                $data['local_atual'] = $this->cidades_model->get_cidade_estado_nome_por_perfil_id($this->cliente_id);
           else
               $data['local_atual'] = array();

           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('meusdados/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
	 public function update_client()
	 {		                
                
                $this->load->library('form_validation'); 
	 	$this->form_validation->set_rules('nome_razao', '', 'trim|required');
	 	$this->form_validation->set_rules('email', '', 'trim|required|min_length[6]|max_length[149]');                
                $this->form_validation->set_rules('cnpj_cpf', '', 'trim|required|min_length[1]|max_length[100]');
                
	 	if ($this->form_validation->run() == FALSE)
	 	{
                        $data['msg_erro'] = $this->lang->line('common_meusdados_erro_atualizar');	 		                                                                        
	 		$this->session->set_flashdata('msg_erro', $data['msg_erro']);
                        redirect('i/myaccount'); 
	 	}
	 	else 
	 	{	 
                        $this->clientes_model->set_cliente_dados_update($this->cliente_id); //atualiza
                        $data['msg'] = $this->lang->line('common_meusdados_sucesso_atualizacao');	 		                                                                        
	 		$this->session->set_flashdata('msg', $data['msg']);                        
                        redirect('i/myaccount'); 
                }

         } 
         
	 public function update_user()
	 {		                
                
                $this->load->library('form_validation'); 
	 	$this->form_validation->set_rules('nome', '', 'trim|required|max_length[145]');
	 	$this->form_validation->set_rules('email', '', 'trim|required|max_length[50]');
	 	$this->form_validation->set_rules('data_nasc', '', 'trim|required|max_length[50]');                
                
	 	if ($this->form_validation->run() == FALSE)
	 	{
                        $data['msg_erro'] = $this->lang->line('common_meusdados_erro_atualizar');	 		                                                                        
	 		$this->session->set_flashdata('msg_erro', $data['msg_erro']);
                        redirect('i/myaccount'); 
	 	}
	 	else 
	 	{	 
                        if(!$this->clientes_model->set_cliente_usuario_update($this->session->userdata('userid'), '', 0)){//tenta atualizar
                            $data['msg_erro'] = $this->lang->line('common_meusdados_erro_atualizar');	 		                                                                        
                            $this->session->set_flashdata('msg_erro', $data['msg_erro']);
                            redirect('i/myaccount');                             
                        }
                        $data['msg'] = $this->lang->line('common_meusdados_sucesso_atualizacao');	 		                                                                        
	 		$this->session->set_flashdata('msg', $data['msg']);                        
                        redirect('i/myaccount'); 
                }

         }         
              
	
}

?>
