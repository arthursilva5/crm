<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Upload_file{
	

        public function upload_csv_file_now($path, $field_name)
        {
            $CI =& get_instance();
            
            // confere se existe o campo e foi postado
            if(strlen($_FILES[$field_name]["name"]) >0){
                $config['upload_path'] = $path;//ex: ./uploads/ OR $img1 = $this->manipular_imagem->upload_resize_foto_produtos('/Applications/MAMP/htdocs/crm/uploads/contacts/', 'foto_url1');
		$config['allowed_types'] = 'csv';
                //$config['file_name']	= $this->session->userdata('userid').'_'.date("YmdHi").'_'.$_FILES[$field_name]["name"];
                $config['file_name']	= $CI->session->userdata('userid').'_'.date("Ym").'_'.$_FILES[$field_name]["name"];

               
                
                $CI->load->library('upload',$config);
                
                    if ( ! $CI->upload->do_upload($field_name))
                    {
                            $error = array('error' => $CI->upload->display_errors());
                            return FALSE;
                    }
                    else
                    {
                            return $CI->upload->upload_path.$CI->upload->file_name;
                    }
                }
            
            else { return FALSE; }
        } 
        
        /**
         * Arquivos anexos aos contatos, etc
         * @param type $path
         * @param type $field_name
         * @return boolean
         */
        public function upload_attachment_file_now($path, $field_name)
        {
            $CI =& get_instance();
            
            // confere se existe o campo e foi postado
            if(strlen($_FILES[$field_name]["name"]) >0){
                $config['upload_path'] = $path;//ex: ./uploads/ OR $img1 = $this->manipular_imagem->upload_resize_foto_produtos('/Applications/MAMP/htdocs/crm/uploads/contacts/', 'foto_url1');
		$config['allowed_types'] = 'pdf|txt|rtf|gif|jpg|png|jpeg|tiff|tif';
                //$config['file_name']	= $this->session->userdata('userid').'_'.date("YmdHi").'_'.$_FILES[$field_name]["name"];
                $config['file_name']	= md5(microtime().rand()).'_'.$CI->session->userdata('userid').'_'.date("Ym").'_'.$_FILES[$field_name]["name"];

               
                
                $CI->load->library('upload',$config);
                
                    if ( ! $CI->upload->do_upload($field_name))
                    {
                            $error = array('error' => $CI->upload->display_errors());
                            return FALSE;
                    }
                    else
                    {
                            //return $CI->upload->upload_path.$CI->upload->file_name;
                            return $CI->upload->file_name;
                    }
                }
            
            else { return FALSE; }
        }        
        
}

?>
