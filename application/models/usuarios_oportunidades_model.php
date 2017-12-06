<?php
class Usuarios_oportunidades_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	


	public function set_oportunidade($usuario_id)
	{                
            
            $data_cadastro = date("Y-m-d");
            
            $data = array(
                            'usuario_id' => $usuario_id,
                            'nome_potencial' => $this->input->post('nome_potencial'),                            
                            'data_cadastro' => $data_cadastro,
            );
            
            // converte a data de nascimento
            $dt = explode('/', $this->input->post('data_expectativa_fechar'));
            $data_fechar = $dt[2].'-'.$dt[1].'-'.$dt[0]; 

            $data['data_expectativa_fechar'] = $data_fechar;
                           
            
            if($this->input->post('conta_id') != 0)
                $data['conta_id'] = $this->input->post('conta_id');             
            
            if($this->input->post('tipo_negocio') != 0)
                $data['tipo_negocio'] = $this->input->post('tipo_negocio');
            
            if($this->input->post('proximo_passo') != '')
                $data['proximo_passo'] = $this->input->post('proximo_passo');             

            if($this->input->post('tipo_fonte') != 0)
                $data['tipo_fonte'] = $this->input->post('tipo_fonte');                          

            if($this->input->post('valor') != '')
                $data['valor'] = $this->input->post('valor');  

            if($this->input->post('tipo_estagio_venda') != 0)
                $data['tipo_estagio_venda'] = $this->input->post('tipo_estagio_venda');            
            
            if($this->input->post('grupo') != 0)
                $data['grupo_id'] = $this->input->post('grupo');
            
            if($this->input->post('compartilhar') != 0)
                $data['compartilhar'] = $this->input->post('compartilhar');            
            
            if($this->input->post('descricao') != '')
                $data['descricao'] = $this->input->post('descricao');               
            

	
            return $this->db->insert('tbl_usuarios_contas_oportunidades', $data);
	}
        
        public function update_oportunidade($cliente_id, $id)
	{                
            
            
            //confere se tem acesso ao contato
            if( count($row = $this->get_oportunidade($cliente_id, $id)) == 0 )
                    return FALSE;            
            
            
            $data = date("Y-m-d");
            
            $data = array(
                            'nome_potencial' => $this->input->post('nome_potencial'), 
                            'data_atualizacao' => $data
            );

            
            // converte a data de nascimento
            $dt = explode('/', $this->input->post('data_expectativa_fechar'));
            $data_fechar = $dt[2].'-'.$dt[1].'-'.$dt[0]; 

            $data['data_expectativa_fechar'] = $data_fechar;
                           
            
            if($this->input->post('conta_id') != 0)
                $data['conta_id'] = $this->input->post('conta_id'); 
            else
                $data['conta_id'] = NULL;            
            
            if($this->input->post('tipo_negocio') != 0)
                $data['tipo_negocio'] = $this->input->post('tipo_negocio');
            else
                $data['tipo_negocio'] = NULL;            
            
            if($this->input->post('proximo_passo') != '')
                $data['proximo_passo'] = $this->input->post('proximo_passo');             

            if($this->input->post('tipo_fonte') != 0)
                $data['tipo_fonte'] = $this->input->post('tipo_fonte');
            else
                $data['tipo_fonte'] = NULL;             

            if($this->input->post('valor') != '')
                $data['valor'] = $this->input->post('valor');
            else
                $data['valor'] = NULL;

            if($this->input->post('tipo_estagio_venda') != 0)
                $data['tipo_estagio_venda'] = $this->input->post('tipo_estagio_venda');
            else
                $data['tipo_estagio_venda'] = NULL;                 
            
            if($this->input->post('grupo') != 0)
                $data['grupo_id'] = $this->input->post('grupo');
            else
                $data['grupo_id'] = NULL;            
            
            if($this->input->post('compartilhar') != 0)
                $data['compartilhar'] = $this->input->post('compartilhar');
            else
                $data['compartilhar'] = NULL;              

            if($this->input->post('descricao') != '')
                $data['descricao'] = $this->input->post('descricao'); 
            else
                $data['descricao'] = NULL;
            
            
            $this->db->where('id', $id);
            return $this->db->update('tbl_usuarios_contas_oportunidades', $data);
	}        

        

	public function get_oportunidades_by_usuario_id($usuario_id, $cliente_id, $start, $limit, $contar)
	{  
            
  
                if($contar == 0)
                {
                
                    $sql = "SELECT result.*  FROM (
                        (SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, c1.valor, c1.tipo_estagio_venda, DATE_FORMAT(c1.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c1.compartilhar, u1.cliente_id, u1.id, 
                            estagvenda1.id AS `estagvenda_id`, estagvenda1.titulo AS `estagvenda_titulo`, 
                            conta1.id AS `conta_id_conta`, conta1.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c1 
                            INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda1 ON c1.tipo_estagio_venda = estagvenda1.id
                            LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                            WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3'))
                        UNION
                        (SELECT c2.id AS `oportunidade_id`, c2.conta_id, c2.usuario_id, c2.nome_potencial, c2.valor, c2.tipo_estagio_venda, DATE_FORMAT(c2.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c2.compartilhar, u2.cliente_id, u2.id, 
                            estagvenda2.id AS `estagvenda_id`, estagvenda2.titulo AS `estagvenda_titulo`, 
                            conta2.id AS `conta_id_conta`, conta2.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c2 
                            INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda2 ON c2.tipo_estagio_venda = estagvenda2.id
                            LEFT JOIN `tbl_usuarios_contas` conta2 ON c2.conta_id = conta2.id
                            WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) )
                        UNION
                        (SELECT c3.id AS `oportunidade_id`, c3.conta_id, c3.usuario_id, c3.nome_potencial, c3.valor, c3.tipo_estagio_venda, DATE_FORMAT(c3.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c3.compartilhar, u3.cliente_id, u3.id, 
                            estagvenda3.id AS `estagvenda_id`, estagvenda3.titulo AS `estagvenda_titulo`, 
                            conta3.id AS `conta_id_conta`, conta3.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c3 
                            INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda3 ON c3.tipo_estagio_venda = estagvenda3.id
                            LEFT JOIN `tbl_usuarios_contas` conta3 ON c3.conta_id = conta3.id
                            WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3') ) result ORDER BY data_expectativa_fechar LIMIT ?,?";                

                    $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'), $start, $limit));
                }
                else 
                {
                
                    $sql = "SELECT result.*  FROM (
                        (SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, c1.valor, c1.tipo_estagio_venda, DATE_FORMAT(c1.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c1.compartilhar, u1.cliente_id, u1.id, 
                            estagvenda1.id AS `estagvenda_id`, estagvenda1.titulo AS `estagvenda_titulo`, 
                            conta1.id AS `conta_id_conta`, conta1.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c1 
                            INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda1 ON c1.tipo_estagio_venda = estagvenda1.id
                            LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                            WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3'))
                        UNION
                        (SELECT c2.id AS `oportunidade_id`, c2.conta_id, c2.usuario_id, c2.nome_potencial, c2.valor, c2.tipo_estagio_venda, DATE_FORMAT(c2.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c2.compartilhar, u2.cliente_id, u2.id, 
                            estagvenda2.id AS `estagvenda_id`, estagvenda2.titulo AS `estagvenda_titulo`, 
                            conta2.id AS `conta_id_conta`, conta2.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c2 
                            INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda2 ON c2.tipo_estagio_venda = estagvenda2.id
                            LEFT JOIN `tbl_usuarios_contas` conta2 ON c2.conta_id = conta2.id
                            WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) )
                        UNION
                        (SELECT c3.id AS `oportunidade_id`, c3.conta_id, c3.usuario_id, c3.nome_potencial, c3.valor, c3.tipo_estagio_venda, DATE_FORMAT(c3.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c3.compartilhar, u3.cliente_id, u3.id, 
                            estagvenda3.id AS `estagvenda_id`, estagvenda3.titulo AS `estagvenda_titulo`, 
                            conta3.id AS `conta_id_conta`, conta3.conta_nome
                            
                            FROM `tbl_usuarios_contas_oportunidades` c3 
                            INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                            LEFT JOIN `tbl_tipos_estagio_venda` estagvenda3 ON c3.tipo_estagio_venda = estagvenda3.id
                            LEFT JOIN `tbl_usuarios_contas` conta3 ON c3.conta_id = conta3.id
                            WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3') ) result ORDER BY data_expectativa_fechar";             

                    $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid')));
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
        
        
	public function busca_oportunidades_by_usuario_id($usuario_id, $cliente_id, $busca)
	{  
                
            $sql = "SELECT result.*  FROM (
                (SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, c1.valor, c1.tipo_estagio_venda, DATE_FORMAT(c1.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c1.compartilhar, u1.cliente_id, u1.id, 
                    estagvenda1.id AS `estagvenda_id`, estagvenda1.titulo AS `estagvenda_titulo`, 
                    conta1.id AS `conta_id_conta`, conta1.conta_nome

                    FROM `tbl_usuarios_contas_oportunidades` c1 
                    INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    LEFT JOIN `tbl_tipos_estagio_venda` estagvenda1 ON c1.tipo_estagio_venda = estagvenda1.id
                    LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                    WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3') AND c1.nome_potencial LIKE '%$busca%')
                UNION
                (SELECT c2.id AS `oportunidade_id`, c2.conta_id, c2.usuario_id, c2.nome_potencial, c2.valor, c2.tipo_estagio_venda, DATE_FORMAT(c2.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c2.compartilhar, u2.cliente_id, u2.id, 
                    estagvenda2.id AS `estagvenda_id`, estagvenda2.titulo AS `estagvenda_titulo`, 
                    conta2.id AS `conta_id_conta`, conta2.conta_nome

                    FROM `tbl_usuarios_contas_oportunidades` c2 
                    INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                    LEFT JOIN `tbl_tipos_estagio_venda` estagvenda2 ON c2.tipo_estagio_venda = estagvenda2.id
                    LEFT JOIN `tbl_usuarios_contas` conta2 ON c2.conta_id = conta2.id
                    WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ? AND c2.nome_potencial LIKE '%$busca%') )
                UNION
                (SELECT c3.id AS `oportunidade_id`, c3.conta_id, c3.usuario_id, c3.nome_potencial, c3.valor, c3.tipo_estagio_venda, DATE_FORMAT(c3.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c3.compartilhar, u3.cliente_id, u3.id, 
                    estagvenda3.id AS `estagvenda_id`, estagvenda3.titulo AS `estagvenda_titulo`, 
                    conta3.id AS `conta_id_conta`, conta3.conta_nome

                    FROM `tbl_usuarios_contas_oportunidades` c3 
                    INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                    LEFT JOIN `tbl_tipos_estagio_venda` estagvenda3 ON c3.tipo_estagio_venda = estagvenda3.id
                    LEFT JOIN `tbl_usuarios_contas` conta3 ON c3.conta_id = conta3.id
                    WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND c3.nome_potencial LIKE '%$busca%' )) result ORDER BY data_expectativa_fechar";             

            $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid')));


            //$str = $this->db->last_query();
            
  
            if ($query->num_rows() == 0) {
                    return array();
            }            
            return $query->result();

                
	}        
        
	public function get_oportunidades_by_conta_id($conta_id, $cliente_id)
	{  
            
      
            $sql = "SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, c1.valor, c1.tipo_estagio_venda, DATE_FORMAT(c1.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`, c1.compartilhar, 
                    u1.cliente_id, u1.id, 
                    estagvenda1.id AS `estagvenda_id`, estagvenda1.titulo AS `estagvenda_titulo`, 
                    conta1.id AS `conta_id_conta`, conta1.conta_nome

                    FROM `tbl_usuarios_contas_oportunidades` c1 
                    INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    LEFT JOIN `tbl_tipos_estagio_venda` estagvenda1 ON c1.tipo_estagio_venda = estagvenda1.id
                    LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                    LEFT JOIN `tbl_clientes` cli1 ON u1.cliente_id = cli1.id
                    WHERE conta1.id = ? AND u1.cliente_id = ?";             

            $query = $this->db->query($sql, array($conta_id, $cliente_id));

            //$str = $this->db->last_query();                     
            return $query->result();                
	}    
                
        
        
	public function get_oportunidade($cliente_id, $oportunidade_id)
	{

            
            $sql = "SELECT c.id AS `oportunidade_id`, c.conta_id, c.usuario_id, c.nome_potencial, c.valor, c.proximo_passo, c.grupo_id, c.tipo_fonte, c.tipo_negocio, c.tipo_estagio_venda, DATE_FORMAT(c.data_expectativa_fechar, '%d/%m/%Y') AS `data_expectativa_fechar`,  DATE_FORMAT(c.data_cadastro, '%d/%m/%Y') AS `data_cadastro`, c.descricao, c.compartilhar, u.cliente_id, u.id 
                   FROM `tbl_usuarios_contas_oportunidades` c INNER JOIN `tbl_usuarios` u ON c.usuario_id = u.id 
                    WHERE u.cliente_id = ? AND c.id = ?";                

            $query = $this->db->query($sql, array($cliente_id, $oportunidade_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }                
            
            $row = $query->row();            
            
            $usuario = $this->clientes_model->get_usuario_by_id($row->usuario_id);
            
            $row->usuario_dono_nome = $usuario->nome;
            $row->usuario_dono_usuario = $usuario->usuario;                        
            
            return $row;
                
	}     
       
        
	public function get_total_oportunidade_by_client_id($cliente_id, $tipo_estagio_venda)
	{  
            
      
            $sql = "SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, SUM(c1.valor) AS total, c1.tipo_estagio_venda, c1.compartilhar, 
                    u1.cliente_id, u1.id, 
                    estagvenda1.id AS `estagvenda_id`, estagvenda1.titulo AS `estagvenda_titulo`, 
                    conta1.id AS `conta_id_conta`, conta1.conta_nome

                    FROM `tbl_usuarios_contas_oportunidades` c1 
                    INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    LEFT JOIN `tbl_tipos_estagio_venda` estagvenda1 ON c1.tipo_estagio_venda = estagvenda1.id
                    LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                    LEFT JOIN `tbl_clientes` cli1 ON u1.cliente_id = cli1.id
                    WHERE c1.tipo_estagio_venda = ? AND u1.cliente_id = ?";             

            $query = $this->db->query($sql, array($tipo_estagio_venda, $cliente_id));

            if ($query->num_rows() == 0) {
                    return array();
            }   
            $row = $query->row();
            $row->total_db = $row->total;
            $preco_n = 'R$ '.number_format($row->total,2,",",".");
            $row->total = $preco_n;
            
            
            $row = $query->row();
            return $row;             
	}            
                
        
               

        /**
         * Deleta a oportunidade
         * @param type $cliente_id
         * @param type $id
         * @return boolean
         */
        public function remove_oportunidade($cliente_id, $id)
        {            
            
            //confere se tem acesso ao contato
            if( count($row = $this->get_oportunidade($cliente_id, $id)) == 0 )
                    return FALSE; 
                    
            $this->db->where('id', $id);
            $this->db->delete('tbl_usuarios_contas_oportunidades');
            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        
         public function get_oportunidades_notificacao(){
                                           
             
                    $sql = "
                        SELECT c1.id AS `oportunidade_id`, c1.conta_id, c1.usuario_id, c1.nome_potencial, c1.data_expectativa_fechar, DATEDIFF(c1.data_expectativa_fechar, CURDATE()) AS ItemLife, c1.proximo_passo, c1.valor, c1.tipo_estagio_venda, c1.compartilhar, 
                            u1.cliente_id, u1.id, u1.email,
                            cnotificacao.cliente_id, cnotificacao.id AS `cnotificacao_id`, cnotificacao.lead_notificar, cnotificacao.lead_notificar, cnotificacao.lead_fechar_dia_antes, cnotificacao.lead_fechar_dia_depois
                            
                            FROM `tbl_usuarios_contas_oportunidades` c1 
                            INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                            LEFT JOIN `tbl_configuracao_notificacoes` cnotificacao ON u1.cliente_id = cnotificacao.cliente_id
                            
                            WHERE ( DATEDIFF(c1.data_expectativa_fechar, CURDATE()) = cnotificacao.lead_fechar_dia_antes OR DATEDIFF(c1.data_expectativa_fechar, CURDATE()) = cnotificacao.lead_fechar_dia_depois ) AND cnotificacao.lead_notificar = 1";
                    
                    
             
		
		$query = $this->db->query($sql, array(''));
                //$str = $this->db->last_query();
                
		if($query->num_rows > 0)
		{
			return $query->result();
		}
                else {
                    return 0;
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
	public function set_anotacao($oportunidade_id, $descricao)
	{                     
            
                $data_cadastro = date("Y-m-d");
            
		$data = array(
				'oportunidade_id' => $oportunidade_id,
				'descricao' => $descricao,
                                'data_cadastro' => $data_cadastro
		);
	
		return $this->db->insert('tbl_usuarios_contas_oportunidades_anotacoes', $data);
	}   
        
        public function set_anotacao_update($oportunidade_id, $anotacao_id, $descricao)
        {
                
                $data['descricao'] = $descricao;
                
                $this->db->where('oportunidade_id', $oportunidade_id);
                $this->db->where('id', $anotacao_id);
		return $this->db->update('tbl_usuarios_contas_oportunidades_anotacoes', $data);
        }         
        
	public function get_anotacoes_by_oportunidade_id($oportunidade_id)
	{
  
            $sql = "SELECT id, oportunidade_id, descricao, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_oportunidades_anotacoes WHERE oportunidade_id = ? ORDER BY id DESC";                

            $query = $this->db->query($sql, array($oportunidade_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            
            return $query->result();
                
	}  
        
	public function get_anotacao_by_id($anotacao_id)
	{
  
            $sql = "SELECT id, oportunidade_id, descricao, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_oportunidades_anotacoes WHERE id = ?";                

            $query = $this->db->query($sql, array($anotacao_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            
            return $query->row();
                
	} 
        
        public function remove_anotacao($oportunidade_id, $id)
        {
                    
            $this->db->where('id', $id);
            $this->db->where('oportunidade_id', $oportunidade_id);
            $this->db->delete('tbl_usuarios_contas_oportunidades_anotacoes');            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }        
        

}