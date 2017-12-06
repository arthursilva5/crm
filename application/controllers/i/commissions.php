<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commissions extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->model('clientes_comissoes_model');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
           
           if(! $this->clientes_model->check_dados_preenchidos($this->cliente_id) ){
                $msg = '<font color=blue><h5>'.$this->lang->line('common_faturas_preencha_os_dados').'</h5></font>';
                $this->session->set_flashdata('msg', $msg);
                redirect('i/myaccount');   
           }        
                      
	 }
	
	
	 public function index()
	 {                      
     
            //paginacao
            $this->load->library('pagination');

            
            $config['base_url'] = base_url().'i/commissions';
            $config['total_rows'] = $this->clientes_comissoes_model->get_comissoes_by_cliente_id($this->cliente_id, 0, 0, 1);
            $config['per_page'] = 20;   
            $config["uri_segment"] = 3;
            $config['full_tag_open'] = '<div><ul>';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';
            $config['first_link'] = '&laquo; '.$this->lang->line('common_label_pag_primeira');
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = $this->lang->line('common_label_pag_ultima').' &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = $this->lang->line('common_label_pag_proxima').' &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; '.$this->lang->line('common_label_pag_anterior');
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';            
            
            
            $this->pagination->initialize($config);

            $page = ((int) $this->uri->segment(3)) ? (int) $this->uri->segment(3) : 0;
            $data['row_total_pago'] = $this->clientes_comissoes_model->get_total_comissoes_pagas_by_cliente_id($this->cliente_id);
            //$data['row_total_nao_pago'] = $this->clientes_comissoes_model->get_total_comissoes_naopago_by_cliente_id($this->cliente_id);
            $total_aguardando_pagamento = $this->clientes_comissoes_model->get_total_comissoes_aguarda_pgm_by_cliente_id($this->cliente_id);
            
            $conta_total = $this->clientes_comissoes_model->get_total_em_caixa_by_cliente_id($this->cliente_id);
            $data['row_total_a_receber'] = 'R$ '.number_format($conta_total,2,",",".");                        
            
            $data['rows'] = $this->clientes_comissoes_model->get_comissoes_by_cliente_id($this->cliente_id, $page, $config["per_page"], 0);
            $data['link_paginacao'] = $this->pagination->create_links(); 
            //fim paginacao                           
           
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           $data['cliente_id'] = $this->cliente_id;

	   $data['title'] = $this->lang->line('common_comissoes_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('comissoes/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
         public function request_money_add()
         {
             
           
           if(! $this->clientes_model->check_dados_preenchidos($this->cliente_id) ){
                $msg = '<font color=blue><h5>'.$this->lang->line('common_faturas_preencha_os_dados').'</h5></font>';
                $this->session->set_flashdata('msg', $msg);
                redirect('i/account');   
           }
           else {
     
                if(!$this->clientes_comissoes_model->set_request_money($this->cliente_id, $this->input->post('total_sacar'), $this->input->post('conta_pagar'))){
                    $msg = $this->lang->line('common_comissoes_erro_sacar'); 

                    $this->session->set_flashdata('msg', $msg);
                    redirect('i/commissions');                   
                }
                else {

                    //$msg = 'Resposta enviada com sucesso.';
                    //$this->session->set_flashdata('msg', $msg);
                    redirect('i/commissions');                   
                }
           }
                         
         }
         
         
	
}

?>
