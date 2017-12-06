<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login_validate {	    


	 public function check_isvalidated(){
                $CI =& get_instance();
		$CI->load->helper('form');
                                
                $CI->lang->load('pre_login', $CI->session->userdata('default_lang')); 
                
	 	if(! $CI->session->userdata('validated')){
                        $msg_erro = '<strong style="color:red">'.$CI->lang->line('pre_login_erro_autenticacao').'</strong>';
                        $CI->session->set_flashdata('msg_erro', $msg_erro);
	 		redirect('i/login');
	 	}
                else 
                {
                    // confere se a fatura está vencida
                    $CI->load->model('clientes_faturas_model');
                    $cliente_id = $CI->clientes_model->get_cliente_id_by_usuario_id($CI->session->userdata('userid'));
                    
                    $uri = $CI->uri->slash_segment(2); // or taken from another source
                    if( strpos($uri, 'invoice') !== false){
                       $area_certa = 1;
                    }
                    else {
                        $area_certa = 0;
                    }
                    
                    if($CI->clientes_faturas_model->get_existe_fatura_vencida_by_client_id($cliente_id) && $area_certa == 0)
                    {
                        redirect('i/invoice');
                    }
                    else {
                        
                    }
                    
                }
                    
	 }
         
	 public function check_root_config_chmod(){
                $CI =& get_instance();
                                
                $CI->lang->load('common', $CI->session->userdata('default_lang')); 
                
	 	if($CI->session->userdata('chmod') != 'rwxrwxrwx'){
                        $msg_erro = '<strong style="color:red">'.$CI->lang->line('common_label_nao_tem_acesso_pagina').'</strong>';
                        $CI->session->set_flashdata('msg_erro', $msg_erro);
	 		redirect('i/dashboard');
	 	}
	 } 
         
	 public function check_admin_access(){
                $CI =& get_instance();
                                
                $CI->lang->load('common', $CI->session->userdata('default_lang')); 
                
	 	if($CI->session->userdata('userid') != 1){
	 		redirect('i/dashboard');
	 	}
	 }          
         
	 public function check_plan_access($plano_ou_superior){
                $CI =& get_instance();
                                
                $CI->lang->load('common', $CI->session->userdata('default_lang')); 
                
	 	if($CI->session->userdata('plano') < $plano_ou_superior){
                        $msg_erro = '<strong style="color:red">'.$CI->lang->line('common_label_nao_tem_acesso_pagina').'</strong>';
                        $CI->session->set_flashdata('msg_erro', $msg_erro);
	 		redirect('i/plan');
	 	}
	 }
         
	 public function check_plan_size(){
                $CI =& get_instance();
                                
                $CI->lang->load('common', $CI->session->userdata('default_lang')); 
                
                $cliente = $CI->clientes_model->get_cliente_id_by_usuario_id($CI->session->userdata('userid'));
                
                $CI->load->model('usuarios_contas_arquivos_model'); 
                $total_disco = $CI->usuarios_contas_arquivos_model->get_tamanho_disco($cliente);
                
                if($CI->session->userdata('plano') == 1)
                    $maximo = 20971520; // 20 mb
                elseif($CI->session->userdata('plano') == 2)
                    $maximo = 209715200; // 200 mb
                elseif($CI->session->userdata('plano') == 3)
                    $maximo = 209715200; // 200 mb
                elseif($CI->session->userdata('plano') == 4)
                    $maximo = 1073741824; // 1GB
                
                
                if($total_disco >= $maximo){
                        $msg_erro = '<strong style="color:red">'.$CI->lang->line('common_anexos_erro_disco_cheio').'</strong>';
                        $CI->session->set_flashdata('msg_erro', $msg_erro);
	 		redirect('i/accounts');                    
                        return FALSE;
                }
                return TRUE;

	 }          
}
