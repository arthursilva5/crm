<?php
class Tipos_grupos_model extends CI_Model {

	
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
	public function set_grupo($cliente_id, $titulo)
	{                     
		$data = array(
				'cliente_id' => $cliente_id,
				'titulo' => $titulo
		);
	
		return $this->db->insert('tbl_tipos_grupos', $data);
	}
       
        /**
         * Atualiza um grupo
         * @param type $id
         * @param type $titulo
         * @return type
         */
        public function set_grupo_update($cliente_id, $id, $titulo)
        {
                
                $data['titulo'] = $titulo;
                
                $this->db->where('id', $id);
                $this->db->where('cliente_id', $cliente_id);
		return $this->db->update('tbl_tipos_grupos', $data);
        }          
        
        
        /**
         * Retorna os grupos do CLIENTE
         * @param type $cliente_id
         * @return boolean
         */
	public function get_grupos_by_cliente_id($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_grupos');
            
            if ($query->num_rows() == 0) {
                    return array();
            }            
            
            return $query->result();
                
	}
        
	public function get_grupo_signup($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_tipos_grupos')->row();
                      
            
            return $query->id;
                
	}         
        
	public function get_grupo_nome_by_id($id)
	{
            
            $this->db->where('id =', $id);
            $query = $this->db->get('tbl_tipos_grupos');
            
            if ($query->num_rows() == 0) {
                    return '';
            }             
            $row = $query->row();
            
            
            return $row->titulo;
                
	}    
        
	public function get_grupo_total_usuarios_by_id($grupo_id)
        {
            $query = $this->db->get_where('tbl_tipos_grupos', array('id' => $grupo_id)); 
            if($query->num_rows() > 0)
                return FALSE;
            
            return TRUE;
        }         
      
        /**
         * Remove um grupo pelo ID
         * @param type $id
         * @return boolean
         */
        public function remove_grupo($cliente_id, $id)
        {            
            $this->db->where('id', $id);
            $this->db->where('cliente_id', $cliente_id);
            $this->db->delete('tbl_tipos_grupos');
            $str = $this->db->last_query();
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }                         

}