<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jesus extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->model('clientes_comissoes_model');
            $this->language_validate->verify(); // verifica a linguagem
            //$this->login_validate->check_isvalidated(); // confere se está logado            
            $this->login_validate->check_root_config_chmod(); // confere se tem acesso a essa página
            $this->login_validate->check_admin_access(); // restringe ao ADMIN
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
           
           if(! $this->clientes_model->check_dados_preenchidos($this->cliente_id) ){
                $msg = '<font color=blue><h5>'.$this->lang->line('common_faturas_preencha_os_dados').'</h5></font>';
                $this->session->set_flashdata('msg', $msg);
                redirect('i/account');   
           }        
                      
	 }
	
	
	 public function index()
	 {                           

           $data['total_clientes'] = $this->clientes_model->get_total_clientes_adm();
	   $data['title'] = $this->lang->line('common_admin_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('admin/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
	 public function billing()
	 {                      
     
             $this->load->model('clientes_faturas_model'); 
             
            //paginacao
            $this->load->library('pagination');

            
            $config['base_url'] = base_url().'i/commissions';
            $config['total_rows'] = $this->clientes_faturas_model->get_all_faturas_by_admin('u', 0, 0, 1);
            $config['per_page'] = 44;   
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
            $data['rows'] = $this->clientes_faturas_model->get_all_faturas_by_admin('u', $page, $config["per_page"], 0);
            $data['link_paginacao'] = $this->pagination->create_links(); 
            //fim paginacao                           
           
            $data['row_total_pago'] = $this->clientes_faturas_model->get_total_faturas_admin_by_status('p');
            $data['row_total_nao_pago'] = $this->clientes_faturas_model->get_total_faturas_admin_by_status('u');
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           $data['cliente_id'] = $this->cliente_id;

	   $data['title'] = $this->lang->line('common_faturas_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('admin/faturas',$data);
	   $this->load->view('templates/footer');
	 }
         
         public function billing_paid()
         {
     
             $this->load->model('clientes_faturas_model');
            $this->load->library('form_validation'); 
            $this->form_validation->set_rules('fatura_id', '', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {             
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/jesus/billing');  

            }
            else
            {
                
            
                if(!$this->clientes_faturas_model->set_fatura_paga($this->input->post('fatura_id'))){
                    $msg = $this->lang->line('common_configuracoes_erro_db'); 

                    $this->session->set_flashdata('msg', $msg);
                    redirect('i/jesus/billing');
                }
                else
                {
                    $fatura = $this->clientes_faturas_model->get_fatura_by_id($this->input->post('fatura_id'));
                    $plano = $this->clientes_model->get_plano_by_cliente_id($fatura->cliente_id);
                    $cliente = $this->clientes_model->get_cliente_by_id($fatura->cliente_id);
                    // cria a nova fatura
                    $this->clientes_faturas_model->set_fatura($fatura->cliente_id, $plano->valor, $plano->plano, $plano->total_usuarios); 
                    
                    // gera uma comissao caso tenha sido indicado
                    if($cliente->cliente_id_indicou != NULL)
                    {
                        $data_adicao = date("Y-m-d");
                        //$valor_comissao = ( $plano->valor * 7 ) / 100;
                        $valor_liquido = $this->input->post('valor_total') - ( $this->input->post('valor_total') * 6 ) / 100;
                        $valor_comissao = ( $valor_liquido * 7 ) / 100;
                        $this->clientes_comissoes_model->set_comissao($fatura->cliente_id, $cliente->cliente_id_indicou, '', $data_adicao, '', $valor_comissao, 'u');
                    }
                    
                    
                    // envia email de boas vindas
                    $this->lang->load('email_messages', 'english');
                    $this->load->library('enviar_email');
                    $mensagem_email = '<h3>'.$this->lang->line('email_messages_notificacoes_fatura_paga_assunto_email').'</h3>';
                    $mensagem_email .= '<br /><strong>'.$cliente->nome_razao.'</strong><br /> '.$this->lang->line('email_messages_notificacoes_fatura_paga_msg_linha1').' <strong>'.$fatura->valor.' / '.$this->lang->line('common_label_id').':'.$this->input->post('fatura_id').'</strong>';
                    $mensagem_email .= '<br /> '.$this->lang->line('email_messages_notificacoes_fatura_paga_msg_linha2').'<br /> ';                    

                    $this->enviar_email->send_email($this->lang->line('email_label_endereco_email'), $this->lang->line('email_label_5lobos'), $cliente->email, $this->lang->line('email_messages_notificacoes_fatura_paga_assunto_email'), $mensagem_email); // envia um e-mail para o vendedor
                    //fim envia e-mail 
                    
                    
                    redirect('i/jesus/billing');                
                }
              
            }
                             
                         
         }          
         
	 public function commissions()
	 {                      
     
            //paginacao
            $this->load->library('pagination');

            
            $config['base_url'] = base_url().'i/commissions';
            $config['total_rows'] = $this->clientes_comissoes_model->get_comissoes_admin('w', 0, 0, 1);
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
            $data['row_total_pago'] = $this->clientes_comissoes_model->get_total_comissoes_pagas_admin();            
            $data['row_total_a_pagar'] = $this->clientes_comissoes_model->get_total_comissoes_naopago_admin();                       
            
            $data['rows'] = $this->clientes_comissoes_model->get_comissoes_admin('w', $page, $config["per_page"], 0);
            $data['link_paginacao'] = $this->pagination->create_links(); 
            //fim paginacao                           
           
           
             
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
           $data['cliente_id'] = $this->cliente_id;

	   $data['title'] = $this->lang->line('common_comissoes_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('admin/comissoes',$data);
	   $this->load->view('templates/footer');
	 } 
         
         
         public function commission_paid()
         {
     
            $this->load->library('form_validation'); 
            $this->form_validation->set_rules('comissao_id', '', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {             
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/jesus/commissions');  

            }
            else
            {
                
            
                if(!$this->clientes_comissoes_model->set_comissao_paga($this->input->post('comissao_id'))){
                    $msg = $this->lang->line('common_configuracoes_erro_db'); 

                    $this->session->set_flashdata('msg', $msg);
                    redirect('i/jesus/commissions');
                }
                else
                    redirect('i/jesus/commissions');                
              
            }
                             
                         
         }            
         
         
	 public function view_cliente($cliente_id = 0)
	 {                      
     
            //paginacao
            $this->load->library('pagination');

            
           $data['usuario'] = $this->clientes_model->get_usuario_by_id($cliente_id);
           $data['cliente'] = $this->clientes_model->get_cliente_by_id($cliente_id);
           
           $this->load->model('cidades_model');
           $this->load->model('uf_model');
           $data['uf'] = $this->uf_model->get_uf_all();
           $data['cidades'] = $this->cidades_model->get_cidades_all();
           
           if($this->cidades_model->get_cidade_estado_nome_por_perfil_id($cliente_id))
                $data['local_atual'] = $this->cidades_model->get_cidade_estado_nome_por_perfil_id($cliente_id);
           else
               $data['local_atual'] = array();            

	   $data['title'] = $this->lang->line('common_comissoes_titulo');
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('admin/cliente_ver',$data);
	   $this->load->view('templates/footer');
	 }                         
	
}

?>
