<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado   
            
           //$this->load->model('tipos_contas_model');
           //$this->load->model('tipos_industrias_model'); 
           $this->load->model('tipos_grupos_model'); 
           $this->load->model('contas_model');
           $this->load->model('usuarios_contatos_model');
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	 public function index()
	 {
  
            //$query = $this->contas_model->get_contas_by_cliente_id($this->cliente_id, 0, 0);
           
            //paginacao
            $this->load->library('pagination');

            
            $config['base_url'] = base_url().'i/contacts';
            $config['total_rows'] = $this->usuarios_contatos_model->get_contatos_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, 0, 0, 1);
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
            $data['lista_db'] = $this->usuarios_contatos_model->get_contatos_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, $page, $config["per_page"], 0);
            $data['link_paginacao'] = $this->pagination->create_links(); 
            //fim paginacao                   
           
           $data['grupos_lista'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);

	   $data['title'] = $this->lang->line('common_contatos_titulo');
	   
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');
           
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_contatos/padrao',$data);
	   $this->load->view('templates/footer');
	 }
         
         
	 public function add_imported_file()
	 {
           $this->login_validate->check_plan_access(4); // confere se tem acesso a essa página
           $data['title'] = $this->lang->line('common_contatos_importar_contatos');                      
           
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_contatos/importar_arquivo',$data);
	   $this->load->view('templates/footer');
	 }
         
	 public function add_imported_file_now()
	 {
          
            $this->load->library('form_validation'); 
            $this->login_validate->check_plan_access(4); // confere se tem acesso a essa página
            
            $msg_erro = $this->lang->line('common_configuracoes_erro_db');
            
            
            $this->load->library('upload_file');
            $arquivo = $this->upload_file->upload_csv_file_now(PATH_UPLOAD_IMPORTED_CONTACTS, 'arquivo_importar');
            
            if (!$arquivo){
                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/contacts/add_imported_file'); 
            }

            
            //inicio importacao arquivo
            ini_set('auto_detect_line_endings',TRUE);
            $csv_file = $arquivo; // Name of your CSV file

            $csvfile = fopen($csv_file, 'r');
            $theData = fgets($csvfile);
            $i = 0;
            while (!feof($csvfile)) {
                $csv_data[] = fgets($csvfile, 1024);
                $csv_array = explode(",", $csv_data[$i]);
                $insert_csv = array();
                $insert_csv['name'] = $csv_array[0];
                $insert_csv['role'] = $csv_array[1];
                $insert_csv['email'] = $csv_array[2];
                $insert_csv['email2'] = $csv_array[3];
                $insert_csv['phone'] = $csv_array[4];
                $insert_csv['mobile'] = $csv_array[5];
                
                
                $this->usuarios_contatos_model->set_contato_imported($this->session->userdata('userid'), 1, $insert_csv['name'], $insert_csv['role'], $insert_csv['email'], $insert_csv['email2'], $insert_csv['phone'], $insert_csv['mobile']);
                
                
                $i++;
            }
            fclose($csvfile);
            unlink($arquivo); // remove arquivo
            //fim importacao arquivo
            
            
            redirect('i/contacts');                            	   
	   
	    
	 }         
         
	 public function add()
	 {           
           $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id);
           $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);
           
           $data['title'] = $this->lang->line('common_contatos_novo_contato');                      
           
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_contatos/adicionar',$data);
	   $this->load->view('templates/footer');
	 }           
         
         
         public function add_now()
         {
     
            $this->load->library('form_validation'); 
            

            $this->form_validation->set_rules('contato_nome', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/contacts');
            
            if(!$this->usuarios_contatos_model->set_contato($this->session->userdata('userid'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/contacts');                   
            }
            else {
                redirect('i/contacts');                   
            }
                         
         }         
         
         
	 public function view()
	 {                                     
            $this->load->library('form_validation'); 
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('contato_id', '', 'required');                                                                  
            

            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/contacts');                        

            // confere se pode ver a conta
            if($this->usuarios_contatos_model->get_contatos_by_usuario_id($this->session->userdata('userid'), $this->cliente_id, 0, 0, 1) == 0){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/contacts');                  
            }

            $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);            
            $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id); 
           
            //retorna os dados da conta
            $data['rows'] = $this->usuarios_contatos_model->get_contato($this->cliente_id, $this->input->post('contato_id'));                        
            
            $data['title'] = $this->lang->line('common_contatos_detalhes_contato'); 
            
            
            
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_contatos/ver',$data);
	   $this->load->view('templates/footer');
	 }          
         
         
         
         
         
         
         
         
	 public function edit()
	 {                                     
            $this->load->library('form_validation'); 
            $this->load->model('contas_model');
            
            $this->form_validation->set_rules('contato_id', '', 'required');                                          
            
            //confere se postou algo
            if ($this->form_validation->run() == FALSE)
                redirect('i/contacts');
            
            // confere se pode ver a conta
             if( count($this->usuarios_contatos_model->get_contato($this->cliente_id, $this->input->post('contato_id'))) == 0 ){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/contacts');                  
            }
       
            $data['nomes_contas_db'] = $this->contas_model->get_contas_nome_by_cliente_id($this->cliente_id);
            $data['tipos_grupos_db'] = $this->tipos_grupos_model->get_grupos_by_cliente_id($this->cliente_id); 
            
            //retorna os dados da conta
            $data['rows'] = $this->usuarios_contatos_model->get_contato($this->cliente_id, $this->input->post('contato_id'));                        
            
            $data['title'] = $this->lang->line('common_contatos_editar_contato'); 
            
                        
           if($this->session->flashdata('msg_erro')) // mensagens do sistema
               $data['msg_erro'] = $this->session->flashdata('msg_erro');
           elseif($this->session->flashdata('msg'))
               $data['msg'] = $this->session->flashdata('msg');           	   
	   
	   $this->load->view('templates/header',$data);
	   $this->load->view('usuario_contatos/editar',$data);
	   $this->load->view('templates/footer');
	 }          
         
         
         public function edit_now()
         {
     
            $this->load->model('contas_model');
            $this->load->library('form_validation'); 
            

            $this->form_validation->set_rules('contato_nome', '', 'required');
            $this->form_validation->set_rules('contato_id', '', 'required');

            if ($this->form_validation->run() == FALSE)
                redirect($_SERVER['HTTP_REFERER']);
            
            if(!$this->usuarios_contatos_model->set_contato_update($this->cliente_id, $this->input->post('contato_id'))){
                $msg_erro = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/contacts');                   
            }
            else {
                redirect('i/contacts');                   
            }
                         
         }         
         
         
        

         
         public function delete()
         {
     
            $this->load->model('contas_model');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('db_id', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/contacts');            
            
            if(!$this->usuarios_contatos_model->remove_contato($this->cliente_id, $this->input->post('db_id'))) {
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/contacts');                   
            }
            else
                redirect('i/contacts');                   
                         
         } 
         
         public function ajax_delete()
         {
     
            $this->load->model('contas_model');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('db_id', '', 'required');                                          

            if ($this->form_validation->run() == FALSE)
                redirect('i/contacts');            
            
            if(!$this->usuarios_contatos_model->remove_contato($this->cliente_id, $this->input->post('db_id'))) {
                $msg = $this->lang->line('common_configuracoes_erro_db'); 

                $this->session->set_flashdata('msg', $msg);
                redirect('i/contacts');                   
            }
            else
                echo json_encode("");                    
                         
         }          
         
 
       
	
}

?>
