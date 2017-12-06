<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página
                     
            $this->load->library('form_validation'); 
            
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	
	 public function index()
	 {           
           $this->load->model('tipos_estagio_venda_model');
           
	   $data['title'] = $this->lang->line('common_newsletter_titulo');	              
           
           
           $data['tipos_estagio_venda_db'] = $this->tipos_estagio_venda_model->get();
           
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('newsletter/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
	 public function ajax_send_email_test()
	 {
            
                    
             
             header('Content-type: application/json');
             
             $this->lang->load('email_messages', $this->session->userdata('default_lang'));
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_servidor_email_model'); 
           $row_conf_email = $this->configuracao_servidor_email_model->get_servidor_email_by_cliente_id($this->cliente_id);
           
            // envia email
            $this->load->library('enviar_email'); 
            
            if($this->input->post('editor1') != '' || $this->input->post('email_para') != ''){
                $mensagem_email = $this->input->post('editor1');
                            
                $email_testa = $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $this->input->post('nome_email'), $this->input->post('email_para'),  $this->input->post('assunto_email'), $mensagem_email);
                if(!$email_testa)
                    $resultado['erro'] = 1;                             
                else 
                    $resultado['erro'] = 0; 
                            
            }
            else {
                $resultado['erro'] = 1;
            }

            
            
            echo json_encode($resultado); 
            
	 } 
         
	 public function ajax_send_emails_now()
	 {
            
                    
             
             header('Content-type: application/json');
             
             $this->lang->load('email_messages', $this->session->userdata('default_lang'));
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_servidor_email_model'); 
           $row_conf_email = $this->configuracao_servidor_email_model->get_servidor_email_by_cliente_id($this->cliente_id);
           
            // envia email
            $this->load->library('enviar_email'); 
            $this->load->model('usuarios_contatos_model');
            
            if($this->input->post('editor1') != ''){
                $mensagem_email = $this->input->post('editor1');
                    
                $rows = $this->usuarios_contatos_model->get_all_contatos_newsletter_by_usuario_id($this->session->userdata('userid'), $this->cliente_id);

                foreach ($rows as $key => $row) //redefine a data
                { 
                    //envia os emails
                    if($row->email != NULL ){
                        $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $this->input->post('nome_email'), $row->email,  $this->input->post('assunto_email'), $mensagem_email);
                    }
                    if($row->email_secundario != NULL){
                        $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $this->input->post('nome_email'), $row->email_secundario,  $this->input->post('assunto_email'), $mensagem_email);
                    }                    
                }                                                
                $resultado['erro'] = 0;
                            
            }
            else {
                $resultado['erro'] = 1;
            }
                        
            echo json_encode($resultado); 
            
	 }          
         
	
}

?>
