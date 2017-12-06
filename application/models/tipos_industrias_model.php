<?php
class Tipos_industrias_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	

        /**
         * Seta o novo grupo para o CLIENTE
         * @param type $cliente_id
         * @param type $titulo
         * @return type
         */
	public function set_industria($cliente_id, $titulo)
	{                     
		$data = array(
				'cliente_id' => $cliente_id,
				'titulo' => $titulo
		);
	
		return $this->db->insert('tbl_tipos_industrias', $data);
	}
       
        /**
         * Atualiza um grupo
         * @param type $id
         * @param type $titulo
         * @return type
         */
        public function set_industria_update($cliente_id, $id, $titulo)
        {
                
                $data['titulo'] = $titulo;
                
                $this->db->where('id', $id);
                $this->db->where('cliente_id', $cliente_id);
		return $this->db->update('tbl_tipos_industrias', $data);
        }          
        
        
        /**
         * Retorna os grupos do CLIENTE
         * @param type $cliente_id
         * @return boolean
         */
	public function get_industrias_by_cliente_id($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_industrias');
            
            if ($query->num_rows() == 0) {
                    return array();
            }            
            
            return $query->result();
                
	}    
      
        /**
         * Remove um grupo pelo ID
         * @param type $id
         * @return boolean
         */
        public function remove_industria($cliente_id, $id)
        {            
            $this->db->where('id', $id);
            $this->db->where('cliente_id', $cliente_id);
            $this->db->delete('tbl_tipos_industrias');
            //$str = $this->db->last_query();
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }                         

}