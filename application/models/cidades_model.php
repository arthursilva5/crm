<?php
class Cidades_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
        
        /**
         * Lista todas cidades
         * @return object
         */
        public function get_cidades_all(){
		
            return $this->db->get('tbl_cidades')->result();
        }
        
        /**
         * Retorna todas cidades e estados
         * @return type
         */
        public function get_cidades_uf_all()
        {		
            $this->db->from('tbl_cidades', 'tbl_uf');
            $this->db->join('tbl_uf', 'tbl_uf.id = tbl_cidades.uf_id');
            $result = $this->db->get();
            return $result;

        }        
        
        public function get_cidades_nomeid(){
            $this->db->select('id, nome');
            $query = $this->db->get('tbl_cidades');
		
            return $query->result_array();
        
        }
            /*
             * Query pra retornar estado
             * SELECT tbl_cidades.id,tbl_cidades.nome,tbl_cidades.uf_id FROM tbl_cidades, tbl_uf WHERE tbl_cidades.uf_id = tbl_uf.id AND tbl_cidades.id = 2004
             */
        
        /*
         * Retorna a cidade de acordo com o ID da cidade
         * @return 
         */
        public function get_cidade_nome($id)
        {
            $this->db->where('id =', $id);
            
            $row = $this->db->get('tbl_cidades')->row();
            
            return $row->nome;
        }
        
        /**
         * Retorna as cidades de acordo com o estado
         * @param type $uf_id
         * @return type
         */
        public function get_cidades_by_uf($uf_id)
        {
            $this->db->where('uf_id =', $uf_id);
            
            return $this->db->get('tbl_cidades')->result();
        }        
        
        
        /*
         * Retorna a cidade e estado de acordo com o ID do CLIENTE
         * @return 
         */
        public function get_cidade_estado_nome_por_perfil_id($cliente_id)
        {             
            
                $this->db->select('c.id "id_cidade", c.nome "cidade", c.uf_id, u.id, u.nome "estado", u.sigla, p.id, p.cidade_id');
                $this->db->from('tbl_cidades c');
                $this->db->from('tbl_uf u');
                $this->db->from('tbl_clientes p');
                
                $this->db->where('c.uf_id = u.id');
                $this->db->where('p.cidade_id = c.id');
                $this->db->where('p.id', $cliente_id);
                                
                $query = $this->db->get();
                
                if($query->num_rows() > 0){
                    $row = $query->row();
                
                    return $row;
                }
                return FALSE;
        }        
	

}