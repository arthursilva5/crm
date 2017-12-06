<?php
class Configuracao_servidor_email_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        
        
        public function set_servidor_email($cliente_id, $usar_ssl, $smtp_host, $smtp_porta, $usuario_email, $senha_email)
        {        
                        
                $data = array(
                                'cliente_id' => $cliente_id,
                                'usar_ssl' => $usar_ssl,
                                'smtp_host' => $smtp_host,
                                'smtp_porta' => $smtp_porta,
                                'usuario_email' => $usuario_email,
                                'senha_email' => $senha_email
                );
	
		return $this->db->insert('tbl_configuracao_servidor_email', $data);        
        }
        
        public function set_servidor_email_update($cliente_id, $usar_ssl, $smtp_host, $smtp_porta, $usuario_email, $senha_email)
        {                

                $data = array(
                                'usar_ssl' => $usar_ssl,
                                'smtp_host' => $smtp_host,
                                'smtp_porta' => $smtp_porta,
                                'usuario_email' => $usuario_email,
                                'senha_email' => $senha_email
                );

            $this->db->where('cliente_id', $cliente_id);
            return $this->db->update('tbl_configuracao_servidor_email', $data);                    

        }          
        

	public function get_servidor_email_by_cliente_id($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_configuracao_servidor_email');
            
            if ($query->num_rows() == 0) {
                    return array();
            }                
            
            $row = $query->row(); 
            
            return $row;
                
	}                       

}