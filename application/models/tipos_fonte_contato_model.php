<?php
class Tipos_fonte_contato_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        /**
         * Retorna as fontes de contato
         * @param type $cliente_id
         * @return boolean
         */
	public function get()
	{
            
            //$this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_fonte_contato');
            
            if ($query->num_rows() == 0) {
                    return array();
            }            
            
            return $query->result();
                
	}                      

}