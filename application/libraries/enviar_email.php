<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Enviar_email {
	
         
         public function send_email($from, $from_name, $to, $subject, $message)
         {
            $CI =& get_instance();
            
            
            $message_header = '<a href="'.base_url().'" target="_blank"><img border="0" src="http://www.5lobos.com/pub/marca_5lobos_crm_p.png" /></a> <br /><br />';
            $message_footer = '<br /><br /> <a href="'.base_url().'" target="_blank"><br />http://crm.5lobos.com</a><br />';
            
            $email_config = Array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_user' => 'automatic@5lobos.com',
                'smtp_pass' => '2shNA29ak&n@',
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'smtp_timeout' => 5
            );             
            
            $CI->load->library('email', $email_config);
            
            //$CI->load->library('email');
            //$CI->email->initialize($config);            

            $CI->email->from($from, $from_name);
            $CI->email->to($to);

            $CI->email->subject($subject);
            $CI->email->message($message_header.$message.$message_footer);	
            $result = $CI->email->send();
            
            if(!$result){
                $erros = $this->email->print_debugger();
                return FALSE;
            }
            else {
                return TRUE;
            }            
         }
         
         public function send_email_client($host, $usar_ssl, $smtp_porta, $usuario_email, $senha_email, $from, $from_name, $to, $subject, $message)
         {
            $CI =& get_instance();
            
            
            
            //$message_footer = '<br /><br /> <a href="http://www.5lobos.com" target="_blank">5lobos.com</a>';
            
            $email_config = Array(
                'protocol'  => 'smtp',
                
                'smtp_port' => $smtp_porta,
                'smtp_user' => $usuario_email,
                'smtp_pass' => $senha_email,
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'smtp_timeout' => 5
            );             
            
            if($usar_ssl == 1) //confere se é pra usar SSL
                $email_config['smtp_host'] = 'ssl://'.$host;
            else
                $email_config['smtp_host'] = $host;
            
            $CI->load->library('email', $email_config);
            
            //$CI->load->library('email');
            //$CI->email->initialize($config);            

            $CI->email->from($from, $from_name);
            $CI->email->to($to);

            $CI->email->subject($subject);
            $CI->email->message($message);	
            $result = $CI->email->send();
            
            if(!$result){
                //$erros = $this->email->print_debugger();
                return FALSE;
            }
            else {
                return TRUE;
            }            
         }          
}
