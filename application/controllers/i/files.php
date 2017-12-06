<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            $this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem
            $this->login_validate->check_isvalidated(); // confere se está logado   

           $this->load->model('usuarios_contas_arquivos_model'); 
           $this->load->model('contas_model');
           $this->load->model('usuarios_contatos_model');
                     
           $this->lang->load('header', $this->session->userdata('default_lang'));
           $this->lang->load('common', $this->session->userdata('default_lang'));
           
           $this->cliente_id = $this->clientes_model->get_cliente_id_by_usuario_id($this->session->userdata('userid'));
                      
	 }
	
	 public function index()
	 {
              
	 }
         
	 public function add_attachment_file()
	 {
            $confere = $this->login_validate->check_plan_size();
            $arquivo = FALSE;
            
            $this->load->library('form_validation');            
            
            $msg_erro = $this->lang->line('common_configuracoes_erro_db');
            
            if($confere)
            {
                $this->load->library('upload_file');
                $arquivo = $this->upload_file->upload_attachment_file_now(PATH_UPLOAD_ATTACHMENTS, 'arquivo');
            }
            
            if ($arquivo){
                $this->usuarios_contas_arquivos_model->set_arquivo($this->cliente_id, $this->input->post('db_id'), $this->input->post('nome'), $arquivo);                                            
                //redirect($_SERVER['HTTP_REFERER']);
                redirect('i/accounts'); 
            }
            else {               
                $this->session->set_flashdata('msg_erro', $msg_erro);
                //redirect($_SERVER['HTTP_REFERER']);
                redirect('i/accounts');                 
            }
                                       	   
	   
	    
	 }
         
	 public function download_attachment_file()
	 {
          

             
            $id = $this->input->get('id', TRUE);
            $conta_id = $this->input->get('conta_id', TRUE);
            
            // confere se pode ver a conta
            if(!$this->contas_model->check_ver_conta_autorizado($this->cliente_id, $conta_id)){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/accounts');                  
            }            

            if (!$_GET['id'] || $_GET['id'] == '')
                redirect('i/accounts'); 
            
            $resultado['arquivo'] = $this->usuarios_contas_arquivos_model->download_arquivos_by_id($conta_id, $id);
            
            if(!$resultado['arquivo']) {
                //$msg = $this->lang->line('common_configuracoes_erro_db'); 

                //$this->session->set_flashdata('msg', $msg);
                
            }
            else {
                
                
                    $filename = $resultado['arquivo'];
                       
                    
                    if( file_exists( $filename ) ) {


                        if(ini_get('zlib.output_compression'))
                        ini_set('zlib.output_compression', 'Off');

                        header("Content-Type: application/force-download"); 
                        header( 'Content-Disposition: attachment; filename= ' . basename( $filename ) );
                        header("Content-Transfer-Encoding: binary");
                        header('Accept-Ranges: bytes');
                        header("Cache-control: private");
                        header('Pragma: private');
                        readfile($filename); 

                        
                    }                
            }
                
                //echo json_encode($resultado);   
  
	 }           
        
         
         public function ajax_attachment_delete()
         {
     
            $this->load->model('contas_model');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('db_id', '', 'required');
            $this->form_validation->set_rules('db_id_delete', '', 'required');

            if ($this->form_validation->run() == FALSE)
                redirect('i/accounts'); 
            
            
            // confere se pode ver a conta
            if(!$this->contas_model->check_ver_conta_autorizado($this->cliente_id, $this->input->post('db_id'))){
                $msg_erro = $this->lang->line('common_erro_nao_autorizado'); 

                $this->session->set_flashdata('msg_erro', $msg_erro);
                redirect('i/accounts');                  
            }             
            
            if(!$this->usuarios_contas_arquivos_model->remove_arquivo($this->input->post('db_id'), $this->input->post('db_id_delete'))) {
                //$msg = $this->lang->line('common_configuracoes_erro_db'); 

                //$this->session->set_flashdata('msg', $msg);
                $resultado = 1;                   
            }
            else
                echo json_encode($resultado);                    
                         
         }          
         
 
       
	
}

?>
