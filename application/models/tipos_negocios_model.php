<?php
class Tipos_negocios_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        /**
         * Retorna os tipos de negócios
         * @param type $cliente_id
         * @return boolean
         */
	public function get()
	{
            
            //$this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_negocios');
            
            if ($query->num_rows() == 0) {
                    return array();
            }            
            
            return $query->result();
                
	}                      

}