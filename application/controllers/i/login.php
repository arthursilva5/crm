<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
           

            $this->load->library('language_validate');
            $this->language_validate->verify(); // verifica a linguagem
           
            $this->load->library('form_validation');         
           
           $this->lang->load('pre_login', $this->session->userdata('default_lang'));
           $this->lang->load('header', $this->session->userdata('default_lang'));                      
                                 
                      
	 }
	
	
	 public function index()
	 {
           $this->check_isvalidated_ok();
           
           if($this->session->flashdata('msg_erro')){
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           }
           elseif($this->session->flashdata('msg')){
               $data['msg'] = $this->session->flashdata('msg');
           } 
           

	   $data['title'] = 'Login';
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('login',$data);
	   $this->load->view('templates/footer');
	 }
         
         //cadastrar
	 public function signup()
	 {
           
           if($this->session->flashdata('msg_erro')){
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           }
           elseif($this->session->flashdata('msg')){
               $data['msg'] = $this->session->flashdata('msg');
           } 
           

	   $data['title'] = $this->lang->line('pre_login_inscrever');
           //$data['validated'] = 0;
	 		 	
	   $this->load->helper('form'); // carrega o formulario
           
           
           if($this->uri->segment(2) != '')
               $data['plano_escolhido'] = $this->uri->segment(2);
           else
               $data['plano_escolhido'] = 0;
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('signup',$data);
	   $this->load->view('templates/footer');
	 }     
         
	 public function signup_now()
	 {		
                $this->lang->load('email_messages', $this->session->userdata('default_lang')); // Linguagem de emails
                
                
	 	$this->form_validation->set_rules('nome', '', 'trim|required|max_length[145]');
	 	$this->form_validation->set_rules('sobrenome', '', 'trim|required|max_length[149]');
	 	$this->form_validation->set_rules('email', '', 'trim|required|min_length[6]|max_length[149]');
                $this->form_validation->set_rules('senha', '', 'trim|required|min_length[4]|max_length[32]');
                $this->form_validation->set_rules('usuario', '', 'trim|required|min_length[4]|max_length[15]');
                $this->form_validation->set_rules('usuario_quantidade', '', 'trim|required|min_length[1]');
                //$data['validated'] = 0;                               
                
	 	if ($this->form_validation->run() == FALSE)
	 	{
                        $data['msg_erro'] = $this->lang->line('pre_login_erro_cadastro');
	 		$data['title'] = $this->lang->line('pre_login_inscrever');
                                                                        
	 		$this->load->view('templates/header',$data);
	 		$this->load->view('login',$data);
	 		$this->load->view('templates/footer');
	 	}
	 	else 
	 	{
	 		if($this->clientes_model->check_login_duplicado() == 0) // cadastra EFETUA COM SUCESSO
                        {
	 	 
                        $cliente_id = $this->clientes_model->set_cliente(); // cadastra o cliente

                        $cliente_usuario = $this->clientes_model->get_first_cliente_usuario_by_id($cliente_id);

                        // envia email de boas vindas
                        $this->load->library('enviar_email');                                
                        $mensagem_email = '<h3>'.$this->lang->line('email_messages_signup_sucesso_linha_1').'</h3>';
                        $mensagem_email .= '<br /><br /> <strong>'.$this->lang->line('email_messages_signup_sucesso_linha_2').'</strong> '.$cliente_usuario->email.' / '.$cliente_usuario->usuario;
                        $mensagem_email .= '<br /> '.$this->lang->line('email_messages_signup_sucesso_linha_3');
                        $mensagem_email .= '<br /><br /> '.$this->lang->line('email_messages_signup_sucesso_linha_4').' <a href="'.base_url().'"><br />http://crm.5lobos.com</a><br />'; 

                        $envia_email = $this->enviar_email->send_email($this->input->post('email_label_endereco_email'), $this->input->post('email_label_5lobos'), $this->input->post('email'), $this->lang->line('email_messages_signup_bem_vindo'), $mensagem_email); // envia um e-mail para o vendedor
                        if(!$envia_email) { $data['msg'] = '<font color=blue><h3>'.$this->lang->line('pre_login_sucesso_cadastro').'</h3></font>'; }
                        else { $data['msg'] = '<font color=blue><h3>'.$this->lang->line('pre_login_sucesso_cadastro_email').'</h3></font>'; }
                        //fim envia e-mail    


                        // efetua login
                        $result = $this->clientes_model->check_validar_login();
                        if($result){
                            $msg = '<font color=blue><h5>'.$this->lang->line('pre_login_sucesso_cadastro_ok_login').'</h5></font>';
                            $this->session->set_flashdata('msg', $msg);
                            redirect('i/dashboard');                                    
                        }
                                
                        }
                        else 
                        {
	 			$this->form_validation->set_message('existe_username', 'Usuário já existe.');
	 			$this->form_validation->set_message('existe_email', 'E-mail já cadastrado.');
	 			
	 			$data['title'] = $this->lang->line('pre_login_inscrever');
	 			$data['msg_erro'] = '<font color=red>'.$this->lang->line('pre_login_erro_email_em_uso').'</font>';
	 			$this->load->view('templates/header',$data);
	 			$this->load->view('signup', $data);
	 			$this->load->view('templates/footer');                            
                        }
  		
	 	}
	 		

         }         
	 
	 public function signin(){
	 	
	 	$this->load->helper('form'); // carrega o formulario
	 	$this->load->library('form_validation');
	 	
	 	$this->check_isvalidated_ok();
	 	// Validate the user can login
	 	$result = $this->clientes_model->check_validar_login();
	 	
	 	$this->form_validation->set_rules('usuario', 'Login', 'trim|required');
	 	$this->form_validation->set_rules('senha', 'Senha', 'trim|required');

                
	 	if ($this->form_validation->run() == FALSE)
	 	{
	 		$data['title'] = $this->lang->line('header_label_login');                        
	 		$this->load->view('templates/header',$data);
	 		$this->load->view('login');
	 		$this->load->view('templates/footer');
	 	}
	 	else {
		 	// Now we verify the result
		 	if(!$result){
		 		// If user did not validate, then show them login page again
		 		$data['msg_erro'] = $this->lang->line('pre_login_erro_usuario_senha_incorreto');
                                $this->session->set_flashdata('msg_erro', $data['msg_erro']);
                                redirect('i/login');
		 	}else{
                            redirect('i/dashboard');                            
		 	}
	 	}
	 }
	 private function check_isvalidated(){
	 	if(! $this->session->userdata('validated')){
	 		redirect('i/login');
	 	}
	 }
         
         public function check_isvalidated_ok(){
                if($this->session->userdata('validated')){
	 		redirect('i/dashboard');
	 	}
         }
	 
	 public function logout(){
	 	$this->session->sess_destroy();
	 	redirect('/');
	 }
	 
	
}

?>
