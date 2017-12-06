<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Potentials extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->load->library('form_validation');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado   
            
           //$this->load->model('tipos_contas_model');
           //$this->load->model('tipos_industrias_model'); 
           $this->load->model('tipos_grupos_model');
           $this->load->model('tipos_negocios_model');
           $this->load->model('contas_model');
           $this->load->model('usuarios_oportunidades_model');
           $this->load->model('tipos_fonte_contato_model');
           $this->load->model('tipos_estagio_venda_model');
           
           
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	 public function index()
	 {
  
            //paginacao
            $this->load->library('pagination');

            
            $config['base_url'] = base_url().'i/contacts';
            $config['total_rows'] = $this->usuarios_oportunidades_model->get_oportunidades_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, 0, 0, 1);
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
            $data['lista_db'] = $this->usuarios_oportunidades_model->get_oportunidades_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, $page, $config["per_page"], 0);
            $data['link_paginacao'] = $this->pagination->create_links(); 
            //fim paginacao                   
           
           $data['grupos_lista'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);

	   $data['title'] = $this->lang->line('common_oportunidades_titulo');
	   
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_oportunidades/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
	 public function add()
	 {
          
           $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
           $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);
           $data['tipos_negocio_db'] = $this->tipos_negocios_model->get();
           $data['tipos_fontes_contato_db'] = $this->tipos_fonte_contato_model->get();
           $data['tipos_estagio_venda_db'] = $this->tipos_estagio_venda_model->get();
           
           
           
           
           $data['title'] = $this->lang->line('common_oportunidades_nova_oportunidade');                      
           
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_oportunidades/adicionar',$data);
	   $this->load->view('templates/footer');
	 }           
         
         
         public function add_now()
         {

            $this->form_validation->set_rules('nome_potencial', '', 'required');
            $this->form_validation->set_rules('data_expectativa_fechar', '', 'required');

            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');
            
            if(!$this->usuarios_oportunidades_model->set_oportunidade($this->session->userdata('userid'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                   
            }
            else {
                redirect('i/potentials');                   
            }
                         
         }         
         
         
	 public function view()
	 {                                     
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('id', '', 'required');                                                                  
            

            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');                        

            // confere se pode ver a conta           
             if( count($this->usuarios_oportunidades_model->get_oportunidade($this->cliente_id, $this->input->post('id'))) == 0 ){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                  
            }

            $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
            $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);
            $data['tipos_negocio_db'] = $this->tipos_negocios_model->get();
            $data['tipos_fontes_contato_db'] = $this->tipos_fonte_contato_model->get();
            $data['tipos_estagio_venda_db'] = $this->tipos_estagio_venda_model->get();
            
            $data['lista_anotacoes'] = $this->usuarios_oportunidades_model->get_anotacoes_by_oportunidade_id($this->input->post('id'));
            
            //retorna os dados da conta
            $data['rows'] = $this->usuarios_oportunidades_model->get_oportunidade($this->cliente_id, $this->input->post('id'));                        
            
            $data['title'] = $this->lang->line('common_oportunidades_detalhes_oportunidade'); 
            
            
            
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_oportunidades/ver',$data);
	   $this->load->view('templates/footer');
	 } 
         
         
           
         
	 public function edit()
	 {                                     
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('id', '', 'id');                                          
            
            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');
            
            // confere se pode ver a conta           
             if( count($this->usuarios_oportunidades_model->get_oportunidade($this->cliente_id, $this->input->post('id'))) == 0 ){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                  
            }
       
            $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
            $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);
            $data['tipos_negocio_db'] = $this->tipos_negocios_model->get();
            $data['tipos_fontes_contato_db'] = $this->tipos_fonte_contato_model->get();
            $data['tipos_estagio_venda_db'] = $this->tipos_estagio_venda_model->get();
            
            //retorna os dados da conta
            $data['rows'] = $this->usuarios_oportunidades_model->get_oportunidade($this->cliente_id, $this->input->post('id'));                        
            
            $data['title'] = $this->lang->line('common_oportunidades_editar_potencial'); 
            
                        
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_oportunidades/editar',$data);
	   $this->load->view('templates/footer');
	 }          
         
         
         public function edit_now()
         {
     
            $this->load->model('contas_model');
            

            $this->form_validation->set_rules('nome_potencial', '', 'required');
            $this->form_validation->set_rules('id', '', 'required');

            if ($this->form_validation->run() == FALSE){
                $msg_erro = $this->lang->line('common_oportunidades_erro_conta_nome'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);                
                redirect('i/potentials');
            }
            if($this->input->post('conta_id') == 0){
                
                redirect($_SERVER['HTTP_REFERER']);
            }
                
            
            
            if(!$this->usuarios_oportunidades_model->update_oportunidade($this->cliente_id, $this->input->post('id'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');     
            }
            else {
                redirect('i/potentials');                   
            }
                         
         }         
         
         
        

         
         public function delete()
         {
     
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('db_id', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');            
            
            if(!$this->usuarios_oportunidades_model->remove_oportunidade($this->cliente_id, $this->input->post('db_id'))) {
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/potentials');                   
            }
            else
                redirect('i/potentials');                   
                         
         } 
         
         public function ajax_delete()
         {
     
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('db_id', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');            
            
            if(!$this->usuarios_oportunidades_model->remove_oportunidade($this->cliente_id, $this->input->post('db_id'))) {
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/potentials');                   
            }
            else
                echo json_encode("");                   
                         
         }         
         
 
         
         public function ajax_note_add()
         {
            $this->form_validation->set_rules('descricao_anotacao', '', 'required');
            $this->form_validation->set_rules('db_id', '', 'required');            

            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');
            
            if(!$this->usuarios_oportunidades_model->set_anotacao($this->input->post('db_id'), $this->input->post('descricao_anotacao'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                   
            }
            else {
                echo json_encode("");                    
            }
                         
         }          
       

         
	 public function ajax_get_note_by_id()
	 {                                     
           
            
            $this->form_validation->set_rules('id', '', 'required');                                                                  
            

            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');                        

            
            $resultado = $this->usuarios_oportunidades_model->get_anotacao_by_id($this->input->post('id'));

            if( empty ( $resultado ) ) 
                return '{ "descricao": " " }';

            //return '{ "nome": "Nenhuma cidade encontrada" }';
            echo json_encode($resultado);            
            
	 }  
         
	 public function ajax_note_edit()
	 {                                     
                    
            $this->form_validation->set_rules('db_id_edit', '', 'required');                                                                              

            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/potentials');                        

            
            if(!$this->usuarios_oportunidades_model->set_anotacao_update($this->input->post('oportunidade_id'), $this->input->post('db_id_edit'), $this->input->post('descricao_anotacao'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                   
            }
            else {
                echo json_encode(""); 
            }
            
	 }
         
         
         public function ajax_note_delete()
         {                              
            $this->form_validation->set_rules('db_id_delete', '', 'required');              

            if(!$this->usuarios_oportunidades_model->remove_anotacao($this->input->post('oportunidade_id'), $this->input->post('db_id_delete'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/potentials');                   
            }
            else {
                echo json_encode(""); 
            }                  
                         
         }          
         
         
}

?>
