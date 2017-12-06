<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->library('form_validation');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página            
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	
        public function getCidades($id) {

                $this->load->model('cidades_model');

                $cidades = $this->cidades_model->get_cidades_by_uf($id);

                if( empty ( $cidades ) ) 
                    return '{ "nome": "'.$this->lang->line('common_meusdados_label_cidades_nao_encontrada').'" }';

                echo json_encode($cidades);

                return;

            }         
         
	 public function index()
	 {
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           

	   $data['title'] = $this->lang->line('common_configuracoes_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         /* ---------> GRUPOS do sistema <---------- */         
         
	 public function groups()
	 {
           
           $this->load->model('tipos_grupos_model');  
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           $data['grupos_lista'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);                     
           
	   $data['title'] = $this->lang->line('common_configuracoes_grupos_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/grupos',$data);
	   $this->load->view('templates/footer');
	 }         
         
         
         
         public function groups_add()
         {
     
            $this->load->model('tipos_grupos_model');
            
            if(!$this->tipos_grupos_model->set_grupo($this->cliente_id, $this->input->post('titulo_grupo'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/groups');                   
            }
            else {

                //$msg = 'Resposta enviada com sucesso.';
                //$this->session->set_flashdata('msg', $msg);
                redirect('i/config/groups');                   
            }
                         
         }
         
         public function groups_edit()
         {
     
            $this->load->model('tipos_grupos_model');
            
            if(!$this->tipos_grupos_model->set_grupo_update($this->cliente_id, $this->input->post('group_id'), $this->input->post('titulo_grupo'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/groups');                   
            }
            else 
                redirect('i/config/groups');                   
                         
         }
         
         public function groups_delete()
         {
     
            $this->load->model('tipos_grupos_model');
            
            // se tiver usuários associados ao grupo não deixa deletar
            if(!$this->tipos_grupos_model->get_grupo_total_usuarios_by_id($this->input->post('group_id'))){ 
                 $msg_erro = $this->lang->line('common_configuracoes_grupos_erro_excluir');
                 $this->session->set_flashdata('msg_erro', $msg_erro);

                 redirect('i/config/groups');                 
            }
            
            if(!$this->tipos_grupos_model->remove_grupo($this->cliente_id, $this->input->post('group_id'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/groups');                   
            }
            else
                redirect('i/config/groups');                   
                         
         } 
         
         
         
         /* ---------> INDUSTRIAS do sistema <---------- */
         
	 public function industry()
	 {
           
           $this->load->model('tipos_industrias_model');  
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           $data['lista_db'] = $this->tipos_industrias_model->get_industrias_by_cliente_id($this->cliente_id);                      
           
	   $data['title'] = $this->lang->line('common_configuracoes_industrias_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/industrias',$data);
	   $this->load->view('templates/footer');
	 }         
         
         
         
         public function industry_add()
         {
     
            $this->load->model('tipos_industrias_model');
            
            if(!$this->tipos_industrias_model->set_industria($this->cliente_id, $this->input->post('titulo_db'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/industry');                   
            }
            else {

                //$msg = 'Resposta enviada com sucesso.';
                //$this->session->set_flashdata('msg', $msg);
                redirect('i/config/industry');                   
            }
                         
         }
         
         public function industry_edit()
         {
     
            $this->load->model('tipos_industrias_model');
            
            if(!$this->tipos_industrias_model->set_industria_update($this->cliente_id, $this->input->post('tipodb_id'), $this->input->post('titulo_db'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/industry');                   
            }
            else 
                redirect('i/config/industry');                   
                         
         }
         
         public function industry_delete()
         {
     
            $this->load->model('tipos_industrias_model');
            
            if(!$this->tipos_industrias_model->remove_industria($this->cliente_id, $this->input->post('tipodb_id'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/industry');                   
            }
            else
                redirect('i/config/industry');                   
                         
         }         
         
              
         /* ---------> USUÁRIOS do sistema <---------- */
         
	 public function users()
	 {                        
           
           $this->load->model('tipos_grupos_model'); 
           
           $resultado = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
           if( empty($resultado) ){
                $msg_erro = $this->lang->line('common_configuracoes_grupos_erro_adicione_um_primeiro');                        
                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/config/groups');               
           }
           
           
           $data['lista_db'] = $this->clientes_model->get_usuarios_by_cliente_id($this->cliente_id);         

           $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
           
	   $data['title'] = $this->lang->line('common_label_usuarios');
	   
           
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/usuarios',$data);
	   $this->load->view('templates/footer');
	 }
         
         public function users_add()
         {
                $plano_atual = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id); 
                
                if($plano_atual->plano == 1){ // caso o plano seja gratis nao deixa cadastrar
                        $msg_erro = $this->lang->line('common_meuplano_sucesso_plano_gratis_recursos_erro');                        
                        $this->session->set_flashdata('msg_erro', $msg_erro);
                        redirect('i/plan');                    
                }
             
                $this->lang->load('email_messages', $this->session->userdata('default_lang')); // Linguagem de emails
                
                
	 	$this->form_validation->set_rules('nome', '', 'trim|required|max_length[145]');
	 	$this->form_validation->set_rules('sobrenome', '', 'trim|required|max_length[149]');
	 	$this->form_validation->set_rules('email', '', 'trim|required|min_length[6]|max_length[149]');
                $this->form_validation->set_rules('senha', '', 'trim|required|min_length[4]|max_length[32]');
                $this->form_validation->set_rules('usuario', '', 'trim|required|min_length[4]|max_length[15]');
                
	 	if ($this->form_validation->run() == FALSE)
	 	{
                        $msg_erro = $this->lang->line('pre_login_erro_cadastro');                        
                        $this->session->set_flashdata('msg_erro', $msg_erro);
                        redirect('i/config/users');
	 	}
	 	else 
	 	{
	 		if($this->clientes_model->check_login_duplicado() == 0) 
                        {	 	                             
                            if($this->input->post('tipo') == 1)
                                $chmod = 'rwxrwxrwx';
                            elseif($this->input->post('tipo') == 2)
                                $chmod = 'rwxrwxrrr';
                            
                            
                            
                            $cliente_usuario = $this->clientes_model->set_cliente_usuario($this->cliente_id, $chmod, $this->input->post('grupo_id') ); // cria usuario
                            $total_usuarios = $this->clientes_model->get_total_usuarios($this->cliente_id); // num total usuario 
                            $this->clientes_model->set_plano_num_usuarios_update($this->cliente_id, $total_usuarios); // atualiza numero total usuarios do plano                            
                            //$plano_atual = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id);                            
                            $novo_valor_plano = $this->clientes_model->get_valor_plano($plano_atual->plano, $total_usuarios);
                            
                            
                            $this->load->model('clientes_faturas_model');
                            $this->clientes_faturas_model->set_fatura_plano_update($this->cliente_id, $novo_valor_plano, $plano_atual->plano, $total_usuarios); // atualiza fatura                            


                            // envia email de boas vindas
                            $this->load->library('enviar_email');                                
                            $mensagem_email = '<h3>'.$this->lang->line('email_messages_signup_sucesso_linha_1').'</h3>';
                            $mensagem_email .= '<br /><br /> <strong>'.$this->lang->line('email_messages_signup_sucesso_linha_2').'</strong> '.$this->input->post('email');
                            $mensagem_email .= '<br /> '.$this->lang->line('email_messages_signup_sucesso_linha_3');
                            $mensagem_email .= '<br /><br /> '.$this->lang->line('email_messages_signup_sucesso_linha_4').' <a href="'.base_url().'"><br />http://crm.5lobos.com</a><br />'; 

                            $envia_email = $this->enviar_email->send_email($this->lang->line('email_label_endereco_email'),$this->lang->line('email_label_5lobos'), $this->input->post('email'), $this->lang->line('email_messages_signup_bem_vindo'), $mensagem_email); // envia um e-mail para o vendedor
                            if(!$envia_email) { $msg = '<font color=blue>'.$this->lang->line('common_configuracoes_usuarios_label_usuario_adicionado').'</font>'; }
                            else { $msg = '<font color=blue>'.$this->lang->line('common_configuracoes_usuarios_label_usuario_adicionado').'</font>'; }
                            //fim envia e-mail    
	 			
                                $this->session->set_flashdata('msg', $msg);
                                redirect('i/config/users');    
                                
                        }
                        else 
                        {
	 			$msg_erro = '<font color=red>'.$this->lang->line('pre_login_erro_email_em_uso').'</font>';
                                $this->session->set_flashdata('msg_erro', $msg_erro);
                                redirect('i/config/users');                          
                        }
  		
	 	}             
         }
         
         public function users_edit()
         {               
             
            $this->clientes_model->set_cliente_usuario_update($this->input->post('tipodb_id'), $this->input->post('tipo'), 1);
            redirect('i/config/users');                                            
         }         
	
         public function users_delete()
         {                            
            if(!$this->clientes_model->delete_usuario($this->cliente_id, $this->input->post('tipodb_id'))){
                $msg_erro = '<font color=red>'.$this->lang->line('common_configuracoes_usuarios_label_erro_deletar').'</font>';
                $this->session->set_flashdata('msg_erro', $msg_erro);                
                redirect('i/config/users');                                            
            }
            else{    
                
                $plano_atual = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id);
                $total_usuarios = $this->clientes_model->get_total_usuarios($this->cliente_id); // num total usuario 
                $this->clientes_model->set_plano_num_usuarios_update($this->cliente_id, $total_usuarios); // atualiza numero total usuarios do plano                            
                //$plano_atual = $this->clientes_model->get_plano_by_cliente_id($this->cliente_id);                            
                $novo_valor_plano = $this->clientes_model->get_valor_plano($plano_atual->plano, $total_usuarios);


                $this->load->model('clientes_faturas_model');
                $this->clientes_faturas_model->set_fatura_plano_update($this->cliente_id, $novo_valor_plano, $plano_atual->plano, $total_usuarios); // atualiza fatura                            


            }
         }          
         
         
         /* ---------> TIPOS DE CONTAS do sistema <---------- */
         
	 public function accounttype()
	 {

           $this->load->model('tipos_contas_model');
           $rows = $this->tipos_contas_model->get_tipos_contas_by_cliente_id($this->cliente_id);
           $data['lista_db'] = $rows;
           
   
           
	   $data['title'] = $this->lang->line('common_configuracoes_tipos_contas_label_titulo');
	   
           
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/tipos_contas',$data);
	   $this->load->view('templates/footer');
	 }         
         
         
         
         public function accounttype_add()
         {
     
            $this->load->model('tipos_contas_model');
            
            if(!$this->tipos_contas_model->set_tipo_conta($this->cliente_id, $this->input->post('titulo_db'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/accounttype');                   
            }
            else {

                //$msg = 'Resposta enviada com sucesso.';
                //$this->session->set_flashdata('msg', $msg);
                redirect('i/config/accounttype');                   
            }
                         
         }
         
         public function accounttype_edit()
         {
     
            $this->load->model('tipos_contas_model');
            
            if(!$this->tipos_contas_model->set_tipo_conta_update($this->cliente_id, $this->input->post('tipodb_id'), $this->input->post('titulo_db'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/accounttype');                   
            }
            else 
                redirect('i/config/accounttype');                   
                         
         }
         
         public function accounttype_delete()
         {
     
            $this->load->model('tipos_contas_model');
            
            if(!$this->tipos_contas_model->remove_tipo_conta($this->cliente_id, $this->input->post('tipodb_id'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/accounttype');                   
            }
            else
                redirect('i/config/accounttype');                   
                         
         } 
         
         
         /* ---------> CONFIGURACOES NOTIFICACOES do sistema <---------- */
         
	 public function notifications()
	 {           
             
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_notificacoes_model'); 
           
           $data['rows'] = $this->configuracao_notificacoes_model->get_notificacao_by_cliente_id($this->cliente_id);                      
           
	   $data['title'] = $this->lang->line('common_configuracoes_notificacoes_titulo');
	   
           
            
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/notificacoes',$data);
	   $this->load->view('templates/footer');
	 }         
                  
         
         public function notifications_edit()
         {
     
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();             
             
            $this->load->model('configuracao_notificacoes_model');
            
            if(!$this->configuracao_notificacoes_model->set_notificacao_update($this->cliente_id, $this->input->post('lead_notificar'), $this->input->post('lead_fechar_dia_antes'), $this->input->post('lead_fechar_dia_depois'), $this->input->post('email_adm_cadastros_notificar'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/notifications');                   
            }
            else 
                redirect('i/config/notifications');                   
                         
         }    
         
         /* ---------> CONFIGURACOES SERVIDOR E-MAIL <---------- */
         
	 public function email_server()
	 {           
             
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_servidor_email_model'); 
                                
	   $data['title'] = $this->lang->line('common_configuracoes_servidor_email_titulo');
	   
           $data['rows'] = $this->configuracao_servidor_email_model->get_servidor_email_by_cliente_id($this->cliente_id);                      
           
            
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/servidor_email',$data);
	   $this->load->view('templates/footer');
	 }  
         
         
	 public function email_server_edit()
	 {           
             
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_servidor_email_model'); 
                                
	   $data['title'] = $this->lang->line('common_configuracoes_servidor_email_titulo');	                        
           
            if(!$this->configuracao_servidor_email_model->set_servidor_email_update($this->cliente_id, $this->input->post('usar_ssl'), $this->input->post('smtp_host'), $this->input->post('smtp_porta'), $this->input->post('usuario_email'), $this->input->post('senha_email'))){
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/config/email_server');                   
            }
            else 
                redirect('i/config/email_server');           

	 }   
         
	 public function ajax_email_server_test()
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
            $mensagem_email = '<h3>'.$this->lang->line('email_messages_teste_servidor_linha_1').'</h3>';
            $mensagem_email .= '<br /><br /> '.$this->lang->line('email_messages_teste_servidor_linha_2').' <br /><br /><br /><a href="'.base_url().'"><br />http://crm.5lobos.com</a><br />'; 
           
            $email_testa = $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $this->session->userdata('usuario'), $this->input->post('email_para'), $this->lang->line('email_messages_teste_servidor_assunto'), $mensagem_email);
            if(!$email_testa)
                $resultado['erro'] = 1;                             
            else 
                $resultado['erro'] = 0; 
            
            
            
            
            echo json_encode($resultado); 

	 }     
         
         
         /* ---------> CONFIGURACOES E-MAIL ANIVERSÁRIO <---------- */     
         
	 public function email_birthday()
	 {           
             
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_newsletters_model'); 
           
           $data['rows'] = $this->configuracao_newsletters_model->get_newsletter_aniversario($this->cliente_id);                      
           
	   $data['title'] = $this->lang->line('common_configuracoes_aniversario_email_titulo');
	   
           
            
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('config/email_aniversario',$data);
	   $this->load->view('templates/footer');
	 }          
         
         
	 public function ajax_email_birthday_edit()
	 {           
             
             
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_plan_access(3); // confere se tem acesso a essa página             
            $this->login_validate->check_root_config_chmod();
            
           $this->load->model('configuracao_newsletters_model');
           
           $mensagem_email = $this->input->post('editor1');
           
           if($this->input->post('editor1') != ''){
                if(!$this->configuracao_newsletters_model->set_newsletter_aniversario_update($this->cliente_id, $this->input->post('nome_email'), $this->input->post('assunto_email'), $mensagem_email, $this->input->post('status'))){                    
                    $resultado['erro'] = 1;                            
                }
                else { 
                    $resultado['erro'] = 0;
                }
           }

           echo json_encode($resultado);
	 }  
         
         
}

?>