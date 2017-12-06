<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Language_validate {	    


	 public function verify(){
                $CI =& get_instance();
		$CI->load->helper('form');
                
                
                /* tenta definir a linguagem padrão */
                if(! $CI->session->userdata('default_lang'))
                 {

                      $CI->load->library('user_agent');
                      if ($CI->agent->accept_lang('en'))
                      {
                          $sess_lang = 'english';
                      }
                      elseif($CI->agent->accept_lang('pt')){
                          $sess_lang = 'portugues';
                      }
                      elseif($CI->agent->accept_lang('pt-br')){
                          $sess_lang = 'portugues';
                      }                      
                      else 
                          $sess_lang = 'portugues';
                 }
                 else 
                     $sess_lang = $CI->session->userdata('default_lang');

                 $CI->session->set_userdata('default_lang', $sess_lang); //define a linguagem atual
                 

	 }
}
