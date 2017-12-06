<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redefinir_senha extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->helper('form'); // carrega o formulario
            $this->load->library('form_validation');  
            
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
	 }
	
	
	 public function index()
	 {           
           
	    $data['title'] = $this->lang->line('common_resetar_senha_titulo');
            $data['validated'] = 0;
            $this->form_validation->set_rules('user_email', '', 'trim|required|min_length[2]|');
            
            
            if ($this->form_validation->run() == FALSE)
            {
                
            }
            else 
            {
               $this->load->model('senhas_tmp_model');
               if($this->senhas_tmp_model->set_pedido_senha($this->input->post('user_email'))){ // cria a senha no banco de dados
               
                    $usuario_id = $this->clientes_model->get_usuario_id_by_email_or_usuario($this->input->post('user_email')); // pega o ID de acordo com o email ou usuário
                    $dados_u = $this->clientes_model->get_usuario_by_id($usuario_id);

                    $data['pedido_feito'] = 's';
                    $data['email_senha'] = substr($dados_u->email, 0, 5).'...'; 
               }
               else {
                   $data['msg_erro'] = $this->lang->line('common_resetar_senha_erro_usuario_nao_encontrado'); 
               }
               
            }
	 	
               $this->load->view('templates/header',$data);
               $this->load->view('senha/redefinir',$data);
               $this->load->view('templates/footer');             

	 }
         
	 public function alterar($key = '')
	 {         
           $this->load->model('senhas_tmp_model');  
           $data['title'] = $this->lang->line('common_resetar_senha_titulo');
           $data['validated'] = 0;
           
           if( !$this->senhas_tmp_model->get_usuario_id_by_pass_key($key) || !$this->senhas_tmp_model->check_valid_pass_key($key) ){
               //redirect(base_url());
               $data['msg'] = $this->lang->line('common_resetar_senha_erro_codigo_ja_usado');
               $this->load->view('templates/header',$data);
               $this->load->view('senha/redefinir',$data);
               $this->load->view('templates/footer');               
               return 0;
           }
             
	    
            $dados_senha = $this->senhas_tmp_model->get_usuario_id_by_pass_key($key);

            $usuario = $this->clientes_model->get_usuario_by_id($dados_senha->usuario_id);           
            $data['usuario'] = $usuario->usuario;
            $data['passkey'] = $key;
           
            $this->form_validation->set_rules('senha', '', 'trim|required|min_length[2]|');
            
            
            if ($this->form_validation->run() == FALSE)
            {
                
            }
            else {
 
                $this->clientes_model->set_usuario_nova_senha($dados_senha->usuario_id);
                $this->senhas_tmp_model->set_status_by_pass_key($key, 0);
                $data['msg'] = $this->lang->line('common_resetar_senha_sucesso_redefinida');
            }
            $this->load->view('templates/header',$data);
            $this->load->view('senha/redefinir_agora',$data);
            $this->load->view('templates/footer');            

	 }         
}

?>
