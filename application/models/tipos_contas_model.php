<?php
class Tipos_contas_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	

        /**
         * Seta o novo
         * @param type $cliente_id
         * @param type $titulo
         * @return type
         */
	public function set_tipo_conta($cliente_id, $titulo)
	{                     
		$data = array(
				'cliente_id' => $cliente_id,
				'titulo' => $titulo
		);
	
		return $this->db->insert('tbl_tipos_contas', $data);
	}
       
        /**
         * Atualiza
         * @param type $id
         * @param type $titulo
         * @return type
         */
        public function set_tipo_conta_update($cliente_id, $id, $titulo)
        {
                
                $data['titulo'] = $titulo;
                
                $this->db->where('id', $id);
                $this->db->where('cliente_id', $cliente_id);
		return $this->db->update('tbl_tipos_contas', $data);
        }          
        
        
        /**
         * Retorna do CLIENTE
         * @param type $cliente_id
         * @return boolean
         */
	public function get_tipos_contas_by_cliente_id($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_contas');
            
            if ($query->num_rows() == 0) {
                    return array();
            }            
            
            return $query->result();
                
	}    
      
        /**
         * Remove
         * @param type $id
         * @return boolean
         */
        public function remove_tipo_conta($cliente_id, $id)
        {            
            $this->db->where('id', $id);
            $this->db->where('cliente_id', $cliente_id);
            $this->db->delete('tbl_tipos_contas');
            //$str = $this->db->last_query();
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        

}