<?php
class Contas_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	

        /**
         * Inseri uma conta para o cliente
         * @param type $cliente_id
         * @param type $usuario_id
         * @return type
         */
	public function set_conta($cliente_id, $usuario_id)
	{                
            
            $data_cadastro = date("Y-m-d");
            
            $data = array(
                            'cliente_id' => $cliente_id,
                            'usuario_id' => $usuario_id,
                            'conta_nome' => $this->input->post('conta_nome'),
                            'data_cadastro' => $data_cadastro,
            );
            
            if($this->input->post('conta_numero') != '')
                $data['conta_numero'] = $this->input->post('conta_numero');  
            
            if($this->input->post('tipo_conta') != 0)
                $data['tipo_conta_id'] = $this->input->post('tipo_conta');                     
            
            if($this->input->post('tipo_industria') != 0)
                $data['industria_id'] = $this->input->post('tipo_industria'); 
            
            if($this->input->post('receita_anual') != '')
                $data['receita_anual'] = $this->input->post('receita_anual');            

            if($this->input->post('telefone') != '')
                $data['telefone'] = $this->input->post('telefone');             
            
            if($this->input->post('site') != '')
                $data['site'] = $this->input->post('site');              

            if($this->input->post('compartilhar') != 0)
                $data['compartilhar'] = $this->input->post('compartilhar'); 
            
            if($this->input->post('funcionarios') != '')
                $data['funcionarios'] = $this->input->post('funcionarios');              
            
            if($this->input->post('endereco') != '')
                $data['endereco'] = $this->input->post('endereco');   
            
            if($this->input->post('cidade_nome') != '')
                $data['cidade_nome'] = $this->input->post('cidade_nome'); 
            
            if($this->input->post('end_numero') != '')
                $data['end_numero'] = $this->input->post('end_numero');   
            
            if($this->input->post('end_complemento') != '')
                $data['end_complemento'] = $this->input->post('end_complemento');        
            
            if($this->input->post('end_cep') != '')
                $data['end_cep'] = $this->input->post('end_cep');   
            
            if($this->input->post('linkedin') != '')
                $data['linkedin'] = $this->input->post('linkedin'); 
            
            if($this->input->post('facebook') != '')
                $data['facebook'] = $this->input->post('facebook');             
            
            if($this->input->post('twitter') != '')
                $data['twitter'] = $this->input->post('twitter'); 
            
            if($this->input->post('tags') != '')
                $data['tags'] = $this->input->post('tags');    
            
            if($this->input->post('descricao') != '')
                $data['descricao'] = $this->input->post('descricao'); 
            
            if($this->input->post('grupo') != 0)
                $data['grupo_id'] = $this->input->post('grupo');
            
	
            return $this->db->insert('tbl_usuarios_contas', $data);
	}
        
        public function set_conta_update($cliente_id, $conta_id)
	{                
            
            $data = date("Y-m-d");
            
            $data = array(
                            'conta_nome' => $this->input->post('conta_nome'),
                            'data_atualizacao' => $data,
            );
            
                                            
            //confere se tem acesso ao contato
            if( count($row = $this->get_conta($cliente_id, $conta_id)) == 0 )
                    return FALSE;                     
            
            if($this->input->post('conta_numero') != '')
                $data['conta_numero'] = $this->input->post('conta_numero');  
            
            if($this->input->post('tipo_conta') != 0)
                $data['tipo_conta_id'] = $this->input->post('tipo_conta'); 
            if($this->input->post('tipo_conta') == 0 && $row->tipo_conta_id != NULL)
                $data['tipo_conta_id'] = NULL;             
            
            if($this->input->post('tipo_industria') != 0)
                $data['industria_id'] = $this->input->post('tipo_industria');
            if($this->input->post('tipo_industria') == 0 && $row->industria_id != NULL)
                $data['industria_id'] = NULL;              
            
            if($this->input->post('receita_anual') != '')
                $data['receita_anual'] = $this->input->post('receita_anual');            

            if($this->input->post('telefone') != '')
                $data['telefone'] = $this->input->post('telefone');             
            
            if($this->input->post('site') != '')
                $data['site'] = $this->input->post('site');              

            if($this->input->post('compartilhar') != 0)
                $data['compartilhar'] = $this->input->post('compartilhar');
            if($this->input->post('compartilhar') == 0 && $row->compartilhar != NULL)
                $data['compartilhar'] = NULL;             
            
            if($this->input->post('funcionarios') != '')
                $data['funcionarios'] = $this->input->post('funcionarios');              
            
            if($this->input->post('endereco') != '')
                $data['endereco'] = $this->input->post('endereco');   
            
            if($this->input->post('cidade_nome') != '')
                $data['cidade_nome'] = $this->input->post('cidade_nome'); 
            
            if($this->input->post('end_numero') != '')
                $data['end_numero'] = $this->input->post('end_numero');   
            
            if($this->input->post('end_complemento') != '')
                $data['end_complemento'] = $this->input->post('end_complemento');        
            
            if($this->input->post('end_cep') != '')
                $data['end_cep'] = $this->input->post('end_cep');   
            
            if($this->input->post('linkedin') != '')
                $data['linkedin'] = $this->input->post('linkedin'); 
            
            if($this->input->post('facebook') != '')
                $data['facebook'] = $this->input->post('facebook');             
            
            if($this->input->post('twitter') != '')
                $data['twitter'] = $this->input->post('twitter'); 
            
            if($this->input->post('tags') != '')
                $data['tags'] = $this->input->post('tags');    
            
            if($this->input->post('descricao') != '')
                $data['descricao'] = $this->input->post('descricao'); 
            
            if($this->input->post('grupo') != 0)
                $data['grupo_id'] = $this->input->post('grupo');
            if($this->input->post('grupo') == 0 && $row->grupo_id != NULL)
                $data['grupo_id'] = NULL;             
            
            $this->db->where('id', $conta_id);
            $this->db->where('cliente_id', $cliente_id);
            return $this->db->update('tbl_usuarios_contas', $data);
	}        

        
        /**
         * Retorna os grupos do CLIENTE
         * @param type $cliente_id
         * @return boolean
         */
	public function get_contas_by_cliente_id($cliente_id, $start, $limit, $contar)
	{  
            
            if($this->session->userdata('chmod') == 'rwxrwxrwx') { // mostra todos do cliente pro ADMINISTRADOR
                if($contar == 0)
                {
                
                    $sql = "
                        SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                        FROM `tbl_usuarios_contas` 
                                                        WHERE cliente_id = ? LIMIT ?,?";

                    $query = $this->db->query($sql, array( $cliente_id, $start, $limit));
                }
                else 
                {
                
                    $sql = "
                        SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                        FROM `tbl_usuarios_contas` 
                                                        WHERE cliente_id = ?";

                    $query = $this->db->query($sql, array( $cliente_id));                                       
                }        
  
            }
            else 
            {
                
                if($contar == 0)
                {
                
                    $sql = "
                        SELECT result.*  FROM (
                        (SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                        FROM `tbl_usuarios_contas` 
                                                        WHERE cliente_id = ? AND usuario_id = ?  OR compartilhar='3')
                        UNION
                        (SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                        FROM `tbl_usuarios_contas` 
                                                        WHERE cliente_id = ? AND compartilhar = '2' AND grupo_id = ?) ) result ORDER BY conta_nome LIMIT ?,?";

                    $query = $this->db->query($sql, array( $cliente_id, $this->session->userdata('userid'), $cliente_id, $this->session->userdata('grupoid'), $start, $limit));
                }
                else 
                {
                
                    $sql = "SELECT result.*  FROM (
                        (SELECT t1.id, t1.cliente_id, t1.usuario_id, t1.conta_nome, t1.telefone, t1.site, t1.compartilhar, t1.grupo_id 
                                                        FROM `tbl_usuarios_contas` t1 
                                                        WHERE t1.cliente_id = ? AND t1.usuario_id = ?  OR t1.compartilhar='3')
                        UNION
                        (SELECT t2.id, t2.cliente_id, t2.usuario_id, t2.conta_nome, t2.telefone, t2.site, t2.compartilhar, t2.grupo_id 
                                                        FROM `tbl_usuarios_contas` t2
                                                        WHERE t2.cliente_id = ? AND t2.compartilhar = '2' AND t2.grupo_id = ?) ) result ORDER BY conta_nome";

                    $query = $this->db->query($sql, array( $cliente_id, $this->session->userdata('userid'), $cliente_id, $this->session->userdata('grupoid')));                                       
                }
                

            }
            
            //$str = $this->db->last_query();
            
            if($contar == 0){
                if ($query->num_rows() == 0) {
                        return array();
                }            
                return $query->result();
            }
            else
            {
                return $query->num_rows();
            }
                
	}  
        
	public function busca_contas_by_cliente_id($cliente_id, $busca)
	{  
            
            if($this->session->userdata('chmod') == 'rwxrwxrwx') { // mostra todos do cliente pro ADMINISTRADOR

                $sql = "
                    SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id, tags 
                                                    FROM `tbl_usuarios_contas` 
                                                    WHERE cliente_id = ? AND conta_nome LIKE '%$busca%' OR site LIKE '%$busca%' OR tags LIKE '%$busca%'";

                $query = $this->db->query($sql, array($cliente_id));                                       
            }        
            else 
            {

                $sql = "SELECT result.*  FROM (
                    (SELECT t1.id, t1.cliente_id, t1.usuario_id, t1.conta_nome, t1.telefone, t1.site, t1.compartilhar, t1.grupo_id, t1.tags 
                                                    FROM `tbl_usuarios_contas` t1 
                                                    WHERE t1.cliente_id = ? AND t1.usuario_id = ?  OR t1.compartilhar='3' AND t1.conta_nome LIKE '%$busca%' OR t1.site LIKE '%$busca%' OR t1.tags LIKE '%$busca%')
                    UNION
                    (SELECT t2.id, t2.cliente_id, t2.usuario_id, t2.conta_nome, t2.telefone, t2.site, t2.compartilhar, t2.grupo_id, t2.tags 
                                                    FROM `tbl_usuarios_contas` t2
                                                    WHERE t2.cliente_id = ? AND t2.compartilhar = '2' AND t2.grupo_id = ? AND t2.conta_nome LIKE '%$busca%' OR t2.site LIKE '%$busca%' OR t2.tags LIKE '%$busca%') ) result ORDER BY conta_nome";

                $query = $this->db->query($sql, array( $cliente_id, $this->session->userdata('userid'), $cliente_id, $this->session->userdata('grupoid')));                                       

            }
            
            //$str = $this->db->last_query();

            if ($query->num_rows() == 0) {
                    return array();
            }            
            return $query->result();

                
	}        
        
        
        /**
         * Retorna os nomes dos clientes que tem acesso
         * @param type $cliente_id
         * @return type
         */
	public function get_contas_nome_by_cliente_id($cliente_id)
	{  
            
            if($this->session->userdata('chmod') == 'rwxrwxrwx') { // mostra todos do cliente pro ADMINISTRADOR               
                $sql = "
                    SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                    FROM `tbl_usuarios_contas` 
                                                    WHERE cliente_id = ? ORDER BY conta_nome";

                $query = $this->db->query($sql, array( $cliente_id));                                              
  
            }
            else 
            {
                
                $sql = "SELECT result.*  FROM (
                    (SELECT t1.id, t1.cliente_id, t1.usuario_id, t1.conta_nome, t1.compartilhar, t1.grupo_id 
                                                    FROM `tbl_usuarios_contas` t1
                                                    WHERE t1.cliente_id = ? AND t1.usuario_id = ?  OR t1.compartilhar='3')
                    UNION
                    (SELECT t2.id, t2.cliente_id, t2.usuario_id, t2.conta_nome, t2.compartilhar, t2.grupo_id 
                                                    FROM `tbl_usuarios_contas` t2
                                                    WHERE t2.cliente_id = ? AND t2.compartilhar = '2' AND t2.grupo_id = ?) )  result ORDER BY conta_nome";

                $query = $this->db->query($sql, array( $cliente_id, $this->session->userdata('userid'), $cliente_id, $this->session->userdata('grupoid')));                                                       
            }
            
            //$str = $this->db->last_query();
            

           return $query->result();
            
                
	}        
        
        
        
	public function get_conta($cliente_id, $conta_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $this->db->where('id =', $conta_id);
            $query = $this->db->get('tbl_usuarios_contas');
            
            if ($query->num_rows() == 0) {
                    return array();
            }       
            $row = $query->row();
            
            $dt_cad = explode('-', $row->data_cadastro);
            $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
            $row->data_cadastro = $data_cad;                          
            
            $usuario = $this->clientes_model->get_usuario_by_id($row->usuario_id);
            
            $row->usuario_nome = $usuario->nome;
            $row->usuario_usuario = $usuario->usuario;            
           
            
            return $row;
                
	}         
        
        
        /**
         * Confere se tem autorização para acessar a conta
         * @param type $cliente_id
         * @param type $conta_id
         * @return boolean
         */
	public function check_ver_conta_autorizado($cliente_id, $conta_id)
	{  
            if($this->session->userdata('chmod') == 'rwxrwxrwx') { // ADMINISTRADOR
                $sql = "
                    SELECT id, cliente_id, usuario_id, conta_nome, telefone, site, compartilhar, grupo_id 
                                                    FROM `tbl_usuarios_contas` 
                                                    WHERE cliente_id = ? AND id = ?";            

                $query = $this->db->query($sql, array( $cliente_id, $conta_id));     
            } 
            else 
            {
                $sql = "SELECT result.*  FROM (
                    SELECT t1.id, t1.cliente_id, t1.usuario_id, t1.conta_nome, t1.telefone, t1.site, t1.compartilhar, t1.grupo_id 
                                                    FROM `tbl_usuarios_contas` t1 
                                                    WHERE t1.cliente_id = ? AND t1.id = ? AND (t1.usuario_id = ?  OR t1.compartilhar='3')
                    UNION
                    SELECT t2.id, t2.cliente_id, t2.usuario_id, t2.conta_nome, t2.telefone, t2.site, t2.compartilhar, t2.grupo_id 
                                                    FROM `tbl_usuarios_contas` t2 
                                                    WHERE t2.cliente_id = ? AND id = ? AND (t2.compartilhar = '2' AND t2.grupo_id = ?) )  result ORDER BY conta_nome";

                $query = $this->db->query($sql, array( $cliente_id, $conta_id, $this->session->userdata('userid'), $cliente_id, $conta_id, $this->session->userdata('grupoid')));             

            }
            

            
            //$str = $this->db->last_query();
            
                        
            if ($query->num_rows() == 0) {
                    return FALSE; 
            }            
            return TRUE;
                
	}        

        /**
         * Deleta a conta completa
         * @param type $cliente_id
         * @param type $id
         * @return boolean
         */
        public function remove_conta($cliente_id, $id)
        {            
            $this->db->where('id', $id);
            $this->db->where('cliente_id', $cliente_id);
            $this->db->delete('tbl_usuarios_contas');
            $str = $this->db->last_query();
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        } 
        
        

        
        /* 
         * 
         * ####################
         * 
         * 
         *      ANOTAÇOES 
         * 
         * 
         * ####################
         * 
         * 
         */
	public function set_anotacao($conta_id, $descricao)
	{                     
            
                $data_cadastro = date("Y-m-d");
            
		$data = array(
				'conta_id' => $conta_id,
				'descricao' => $descricao,
                                'data_cadastro' => $data_cadastro
		);
	
		return $this->db->insert('tbl_usuarios_contas_anotacoes', $data);
	}   
        
        public function set_anotacao_update($conta_id, $anotacao_id, $descricao)
        {
                
                $data['descricao'] = $descricao;
                
                $this->db->where('conta_id', $conta_id);
                $this->db->where('id', $anotacao_id);
		return $this->db->update('tbl_usuarios_contas_anotacoes', $data);
        }         
        
	public function get_anotacoes_by_oportunidade_id($conta_id)
	{
  
            $sql = "SELECT id, conta_id, descricao, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_anotacoes WHERE conta_id = ? ORDER BY id DESC";                

            $query = $this->db->query($sql, array($conta_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            
            return $query->result();
                
	}  
        
	public function get_anotacao_by_id($anotacao_id)
	{
  
            $sql = "SELECT id, conta_id, descricao, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_anotacoes WHERE id = ?";                

            $query = $this->db->query($sql, array($anotacao_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            
            return $query->row();
                
	} 
        
        public function remove_anotacao($conta_id, $id)
        {
                    
            $this->db->where('id', $id);
            $this->db->where('conta_id', $conta_id);
            $this->db->delete('tbl_usuarios_contas_anotacoes');            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }                                  

}