<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {

    var $cliente_id;
    
	 public function __construct()
	 {
	   parent::__construct();
           
            $this->load->library('language_validate');
            //$this->load->library('login_validate');
            $this->language_validate->verify(); // verifica a linguagem            
            
            $this->lang->load('header', $this->session->userdata('default_lang'));
            $this->lang->load('common', $this->session->userdata('default_lang'));
            $this->lang->load('pre_login', $this->session->userdata('default_lang'));           
                      
	 }
	
	
	 public function index()
	 {                      
           redirect('i/padrao'); 
	 }  
         
	 public function portugues()
	 {              
           $this->session->set_userdata('default_lang', 'portugues');
           
           if(!isset($_SERVER['HTTP_REFERER']) || ($_SERVER['HTTP_REFERER'] == "") )
               $redirecionar = 'i';
           else
               $redirecionar = $_SERVER['HTTP_REFERER'];
           
           redirect($redirecionar); 
	 } 
         
	 public function english()
	 {              
           $this->session->set_userdata('default_lang', 'english');
           
           if(!isset($_SERVER['HTTP_REFERER']) || ($_SERVER['HTTP_REFERER'] == "") )
               $redirecionar = 'i';
           else
               $redirecionar = $_SERVER['HTTP_REFERER'];
           
           redirect($redirecionar);
	 }          
              
	
}

?>
