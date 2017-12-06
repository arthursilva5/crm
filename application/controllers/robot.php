<?php

class Robot extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
	 }
	
	
	 public function index()
	 {
             return FALSE;
	 }
         
	 public function backup_db() // faz backup do banco de dados
	 {             
            // Load the DB utility class
            $this->load->dbutil();

            // Backup your entire database and assign it to a variable
            $backup =& $this->dbutil->backup(); 

            // Load the file helper and write the file to your server
            $this->load->helper('file');
            write_file(PATH_BACKUP_DATABASE.mt_rand().date("d_m_Y_H_i_s").'5lobos_crm.gz', $backup); 

            // Load the download helper and send the file to your desktop
            //$this->load->helper('download');
            //force_download('mybackup.gz', $backup);  
            
            return TRUE;
             
	 } 
         
         
	 public function notifications()
	 {        
             
           $this->lang->load('header', 'english');
           $this->lang->load('common', 'english'); 
           $this->lang->load('email_messages', 'english');
             
            $this->load->model('usuarios_oportunidades_model');
            $this->load->library('enviar_email');
            $rows = $this->usuarios_oportunidades_model->get_oportunidades_notificacao();
            
            if($rows == 0){
                return FALSE;
            }            
            foreach ($rows as $key => $row) //redefine os produtos
            {
                // envia email de boas vindas
                                
                $mensagem_email = '<h3>'.$this->lang->line('email_messages_notificacoes_assunto_email').'</h3>';
                $mensagem_email .= '<br /><br /> '.$this->lang->line('email_messages_notificacoes_msg_linha1').' <strong>'.$row->nome_potencial.'</strong>';
                $mensagem_email .= '<br /> '.$this->lang->line('email_messages_notificacoes_msg_linha2').' <strong>'.$row->proximo_passo.'</strong> <br /> ';
                $mensagem_email .= $this->lang->line('email_messages_notificacoes_msg_linha3').' <strong>'.$row->data_expectativa_fechar.'</strong> (YYYY-mm-dd) <br />';                
                $mensagem_email .= $this->lang->line('email_messages_notificacoes_msg_linha4').' <strong>'.$row->valor.'</strong><br />';                

                $this->enviar_email->send_email($this->lang->line('email_label_endereco_email'), $this->lang->line('email_label_5lobos'), $row->email, $row->nome_potencial.' - '.$this->lang->line('email_messages_notificacoes_assunto_email'), $mensagem_email); // envia um e-mail para o vendedor
                //fim envia e-mail 
            }              
           
            return TRUE;
             
	 }
         
         // Envia e-mail de aniversário para quem possuir configurado o e-mail
	 public function notifications_birthday()
	 {             
             
           $this->lang->load('header', 'english');
           $this->lang->load('common', 'english'); 
           $this->lang->load('email_messages', 'english');
           
           $this->load->model('configuracao_newsletters_model');
           $this->load->model('usuarios_contatos_model');
           $this->load->model('configuracao_servidor_email_model');
           $this->load->library('enviar_email');
           
           $rows = $this->configuracao_newsletters_model->get_newsletter_aniversario_by_status(1); // retorna clientes que configuraram pra enviar emails de niver
           
           if($rows == 0){
               return FALSE;
           }
                foreach ($rows as $key => $row) //redefine os produtos
                 {                     
                    $plano_atual = $this->clientes_model->get_plano_by_cliente_id($row->cliente_id);
                    if($plano_atual->plano >= 4) // confere se tem acesso a este recurso
                    {
                        $cliente = $this->clientes_model->get_cliente_by_id($row->cliente_id);
                        $row_conf_email = $this->configuracao_servidor_email_model->get_servidor_email_by_cliente_id($row->cliente_id);

                        $contatos = $this->usuarios_contatos_model->get_all_contatos_newsletter_aniversarios_hoje_by_cliente_id($row->cliente_id);
                        foreach ($contatos as $key => $contato_usar) //envia os e-mails
                        {                            
                            
                            //envia os emails
                            if($contato_usar->email != NULL ){
                                $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $row->nome_email, $contato_usar->email,  $row->assunto_email, $row->mensagem);
                            }
                            if($contato_usar->email_secundario != NULL){
                                $this->enviar_email->send_email_client($row_conf_email->smtp_host, $row_conf_email->usar_ssl, $row_conf_email->smtp_porta, $row_conf_email->usuario_email, $row_conf_email->senha_email, $row_conf_email->usuario_email, $row->nome_email, $contato_usar->email_secundario,  $row->assunto_email, $row->mensagem);
                            }                             
                            
                            
                            
                        } 
  
                    }
                 }
           }            
         
         //Envia email para os clientes que estao com a fatura vencida 
         // ATENCAO: Rodar este a cada semana para nao enxer o saco do cliente
	 public function financeiro()
	 {             
             
           $this->lang->load('header', 'english');
           $this->lang->load('common', 'english'); 
           $this->lang->load('email_messages', 'english');
           
           $this->load->model('clientes_faturas_model'); 
           $this->load->library('enviar_email');
           
           $rows = $this->clientes_faturas_model->getFaturasVencidas(); // retorna faturas vencidas
           
           if($rows == 0){
               return FALSE;
           }
                foreach ($rows as $key => $row) //redefine os produtos
                 {                     
                    
                    $cliente = $this->clientes_model->get_cliente_by_id($row->cliente_id);
                    $fatura = $this->clientes_faturas_model->get_fatura_by_cliente_id($row->cliente_id, 'u');
                     
                    // envia email de boas vindas

                    $mensagem_email = '<h3>'.$this->lang->line('email_messages_notificacoes_fatura_assunto_email').'</h3>';
                    $mensagem_email .= '<br /><br /> '.$this->lang->line('email_messages_notificacoes_fatura_msg_linha1').' <strong>'.$fatura->valor.' ('.$fatura->data_vencimento.')</strong>';
                    $mensagem_email .= '<br /> '.$this->lang->line('email_messages_notificacoes_fatura_msg_linha2').'<br /> ';            

                    $this->enviar_email->send_email($this->lang->line('email_label_endereco_email'), $this->lang->line('email_label_5lobos'), $cliente->email, $this->lang->line('email_messages_notificacoes_fatura_assunto_email'), $mensagem_email); // envia um e-mail para o vendedor
                    //fim envia e-mail                                        
                 }
           } 
           
           
        
         
}