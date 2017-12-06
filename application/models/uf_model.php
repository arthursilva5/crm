<?php
class Uf_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
        
        /**
         * Lista todos estados
         * @return object
         */
        public function get_uf_all(){
		
            return $this->db->get('tbl_uf')->result();
        }	            

}