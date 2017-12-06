<?php
class Usuarios_contatos_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	


	public function set_contato($usuario_id)
	{                
            
            $data_cadastro = date("Y-m-d");
            
            $data = array(
                            'usuario_id' => $usuario_id,
                            'nome' => $this->input->post('contato_nome'),
                            'data_cadastro' => $data_cadastro,
            );
            
            if($this->input->post('cargo') != '')
                $data['cargo'] = $this->input->post('cargo');             

            if($this->input->post('telefone') != '')
                $data['telefone'] = $this->input->post('telefone');  
            
            if($this->input->post('celular') != '')
                $data['celular'] = $this->input->post('celular');  
            
            if($this->input->post('data_nasc') != '')
            {
		// converte a data de nascimento
		$dt = explode('/', $this->input->post('data_nasc'));
		$data_nasc = $dt[2].'-'.$dt[1].'-'.$dt[0]; 
                
                $data['data_nascimento'] = $data_nasc;
                
            }
                 
            
            if($this->input->post('conta_id') != 0)
                $data['conta_id'] = $this->input->post('conta_id'); 
            
            if($this->input->post('email') != '')
                $data['email'] = $this->input->post('email'); 
            
            if($this->input->post('email_secundario') != '')
                $data['email_secundario'] = $this->input->post('email_secundario'); 
            
            if($this->input->post('telefone_outro') != '')
                $data['telefone_outro'] = $this->input->post('telefone_outro');             
            
            if($this->input->post('grupo') != 0)
                $data['grupo_id'] = $this->input->post('grupo');
            
            if($this->input->post('compartilhar') != 0)
                $data['compartilhar'] = $this->input->post('compartilhar');
            
            if($this->input->post('descricao') != '')
                $data['descricao'] = $this->input->post('descricao');      
            
            if($this->input->post('enviar_newsletter') != '')
                $data['enviar_newsletter'] = $this->input->post('enviar_newsletter');          
            
	
            return $this->db->insert('tbl_usuarios_contatos', $data);
	}
        
	public function set_contato_imported($usuario_id, $compartilhar, $nome, $cargo, $email, $email_secundario, $telefone, $celular)
	{                
            
            $data_cadastro = date("Y-m-d");
            
            $data = array(
                            'usuario_id' => $usuario_id,
                            'compartilhar' => $compartilhar,
                            'data_cadastro' => $data_cadastro,
                            'enviar_newsletter' => 1
            );
            
            if($nome != '')
                $data['nome'] = $nome;
            
            if($cargo != '')
                $data['cargo'] = $cargo;
            
            if($email != '')
                $data['email'] = $email;    
            
            if($email_secundario != '')
                $data['email_secundario'] = $email_secundario;             

            if($telefone != '')
                $data['telefone'] = $telefone;  
            
            if($celular != '')
                $data['celular'] = $celular;  
            
            /*
            if($data_nasc != '')
            {
		// converte a data de nascimento
		$dt = explode('/', $data_nasc);
		$data_nasc = $dt[2].'-'.$dt[1].'-'.$dt[0]; 
                
                $data['data_nascimento'] = $data_nasc;
                
            }             
            */
	
            return $this->db->insert('tbl_usuarios_contatos', $data);
	}        
        
        public function set_contato_update($cliente_id, $contato_id)
	{                
            
            
            //confere se tem acesso ao contato
            if( count($row = $this->get_contato($cliente_id, $contato_id)) == 0 )
                    return FALSE;            
            
            
            $data_atualizacao = date("Y-m-d");
            
            $data = array(
                            'data_atualizacao' => $data_atualizacao
            );
            
            
            if($this->input->post('contato_nome') != '')
                $data['nome'] = $this->input->post('contato_nome'); 
            else
                $data['nome'] = NULL;
            
            if($this->input->post('cargo') != '')
                $data['cargo'] = $this->input->post('cargo'); 
            else
                $data['cargo'] = NULL;
                
            if($this->input->post('telefone') != '')
                $data['telefone'] = $this->input->post('telefone'); 
            else
                $data['telefone'] = NULL;
                
            if($this->input->post('celular') != '')
                $data['celular'] = $this->input->post('celular');
            else
                $data['celular'] = NULL;
            
            if($this->input->post('enviar_newsletter') != '')
                $data['enviar_newsletter'] = $this->input->post('enviar_newsletter');
            else
                $data['enviar_newsletter'] = NULL;
            
            
            
            if($this->input->post('data_nasc') != '')
            {
		// converte a data de nascimento
		$dt = explode('/', $this->input->post('data_nasc'));
		$data_nasc = $dt[2].'-'.$dt[1].'-'.$dt[0]; 
                
                $data['data_nascimento'] = $data_nasc;
                
            }
                 
            
            if($this->input->post('conta_id') != 0 )
                $data['conta_id'] = $this->input->post('conta_id'); 
            else
                $data['conta_id'] = NULL;
            
            if($this->input->post('email') != '')
                $data['email'] = $this->input->post('email'); 
            else 
                $data['email'] = NULL;
            
            if($this->input->post('email_secundario') != '')
                $data['email_secundario'] = $this->input->post('email_secundario'); 
            
            if($this->input->post('telefone_outro') != '')
                $data['telefone_outro'] = $this->input->post('telefone_outro');             
            
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
            
            $this->db->where('id', $contato_id);
            return $this->db->update('tbl_usuarios_contatos', $data);
	}        

        

	public function get_contatos_by_usuario_id($usuario_id, $cliente_id, $start, $limit, $contar)
	{  
            
  
                if($contar == 0)
                {
                
                    $sql = "SELECT result.*  FROM (
                        (SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                            FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                            WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3'))
                        UNION
                        (SELECT c2.id AS `contato_id`, c2.conta_id, c2.usuario_id, c2.nome, c2.telefone, c2.email,  c2.grupo_id, c2.compartilhar, u2.cliente_id, u2.id 
                            FROM `tbl_usuarios_contatos` c2 INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                            WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) )
                        UNION
                        (SELECT c3.id AS `contato_id`, c3.conta_id, c3.usuario_id, c3.nome, c3.telefone, c3.email,  c3.grupo_id, c3.compartilhar, u3.cliente_id, u3.id
                            FROM `tbl_usuarios_contatos` c3 INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                            WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND u3.cliente_id = ?) ) result ORDER BY nome LIMIT ?,?";                

                    $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'),  $cliente_id, $start, $limit));
                }
                else 
                {
                
                    $sql = "SELECT result.*  FROM (
                        (SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                            FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                            WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3'))
                        UNION
                        (SELECT c2.id AS `contato_id`, c2.conta_id, c2.usuario_id, c2.nome, c2.telefone, c2.email,  c2.grupo_id, c2.compartilhar, u2.cliente_id, u2.id 
                            FROM `tbl_usuarios_contatos` c2 INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                            WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) )
                        UNION
                        (SELECT c3.id AS `contato_id`, c3.conta_id, c3.usuario_id, c3.nome, c3.telefone, c3.email,  c3.grupo_id, c3.compartilhar, u3.cliente_id, u3.id
                            FROM `tbl_usuarios_contatos` c3 INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                            WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND u3.cliente_id = ?) ) result ORDER BY nome";                

                    $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'), $cliente_id ));
                }

            
            $str = $this->db->last_query();
            
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
        
	public function busca_contatos_by_usuario_id($usuario_id, $cliente_id, $busca)
	{  
            
            $sql = "SELECT result.*  FROM (
                (SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                    FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3') AND c1.nome LIKE '%$busca%' OR c1.email LIKE '%$busca%')
                UNION
                (SELECT c2.id AS `contato_id`, c2.conta_id, c2.usuario_id, c2.nome, c2.telefone, c2.email,  c2.grupo_id, c2.compartilhar, u2.cliente_id, u2.id 
                    FROM `tbl_usuarios_contatos` c2 INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                    WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) AND c2.nome LIKE '%$busca%' OR c2.email LIKE '%$busca%')
                UNION
                (SELECT c3.id AS `contato_id`, c3.conta_id, c3.usuario_id, c3.nome, c3.telefone, c3.email,  c3.grupo_id, c3.compartilhar, u3.cliente_id, u3.id
                    FROM `tbl_usuarios_contatos` c3 INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                    WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND u3.cliente_id = ? AND c3.nome LIKE '%$busca%' OR c3.email LIKE '%$busca%' )) result ORDER BY nome";                

            $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'), $cliente_id ));


            
            //$str = $this->db->last_query();

            if ($query->num_rows() == 0) {
                    return array();
            }            
            return $query->result();

                
	}        
        
	public function get_contatos_by_conta_id($conta_id, $cliente_id)
	{  
            
            $sql = "SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.cargo, c1.telefone, c1.email,  c1.grupo_id, c1.compartilhar, 
                    u1.cliente_id, u1.id, u1.cliente_id,
                    conta1.id AS `conta_id_conta`, conta1.conta_nome
                    
                    FROM `tbl_usuarios_contatos` c1 
                    INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    LEFT JOIN `tbl_usuarios_contas` conta1 ON c1.conta_id = conta1.id
                    LEFT JOIN `tbl_clientes` cli1 ON u1.cliente_id = cli1.id
                    WHERE conta1.id = ? AND u1.cliente_id = ?";                

            $query = $this->db->query($sql, array($conta_id, $cliente_id));
          
            return $query->result();               
	}        
        
        
	public function get_all_contatos_by_usuario_id($usuario_id, $cliente_id)
	{  
               
            $sql = "SELECT result.*  FROM (
                (SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email, c1.email_secundario,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                    FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3'))
                UNION
                (SELECT c2.id AS `contato_id`, c2.conta_id, c2.usuario_id, c2.nome, c2.telefone, c2.email, c2.email_secundario,  c2.grupo_id, c2.compartilhar, u2.cliente_id, u2.id 
                    FROM `tbl_usuarios_contatos` c2 INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                    WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) )
                UNION
                (SELECT c3.id AS `contato_id`, c3.conta_id, c3.usuario_id, c3.nome, c3.telefone, c3.email, c3.email_secundario,  c3.grupo_id, c3.compartilhar, u3.cliente_id, u3.id
                    FROM `tbl_usuarios_contatos` c3 INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                    WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND u3.cliente_id = ?) ) result ORDER BY nome";                

            $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'), $cliente_id ));

            
            return $query->result();
                
	}  
        
        
	public function get_all_contatos_newsletter_by_usuario_id($usuario_id, $cliente_id)
	{  
               
            $sql = "SELECT result.*  FROM (
                (SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email, c1.email_secundario,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                    FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    WHERE c1.usuario_id = ? AND u1.cliente_id = ? AND (c1.usuario_id = u1.id OR c1.compartilhar='3') AND enviar_newsletter = '1')
                UNION
                (SELECT c2.id AS `contato_id`, c2.conta_id, c2.usuario_id, c2.nome, c2.telefone, c2.email, c2.email_secundario,  c2.grupo_id, c2.compartilhar, u2.cliente_id, u2.id 
                    FROM `tbl_usuarios_contatos` c2 INNER JOIN `tbl_usuarios` u2 ON c2.usuario_id = u2.id 
                    WHERE (c2.usuario_id = u2.id AND c2.compartilhar = '2' AND c2.grupo_id = ?) AND enviar_newsletter = '1' )
                UNION
                (SELECT c3.id AS `contato_id`, c3.conta_id, c3.usuario_id, c3.nome, c3.telefone, c3.email, c3.email_secundario,  c3.grupo_id, c3.compartilhar, u3.cliente_id, u3.id
                    FROM `tbl_usuarios_contatos` c3 INNER JOIN `tbl_usuarios` u3 ON c3.usuario_id = u3.id 
                    WHERE c3.usuario_id = u3.id AND c3.compartilhar = '3' AND u3.cliente_id = ? AND enviar_newsletter = '1') ) result ORDER BY nome";                

            $query = $this->db->query($sql, array($usuario_id, $cliente_id, $this->session->userdata('grupoid'), $cliente_id ));

            
            return $query->result();
                
	}         
        
	public function get_contato($cliente_id, $contato_id)
	{

            
            $sql = "SELECT c.id AS `contato_id`, c.conta_id, c.usuario_id, c.nome, c.cargo, c.email, c.email_secundario, 
                    c.telefone, c.telefone_outro, c.celular, c.data_nascimento, c.data_cadastro, c.data_atualizacao, c.descricao, c.grupo_id, c.compartilhar, c.enviar_newsletter, u.cliente_id, u.id
                   FROM `tbl_usuarios_contatos` c INNER JOIN `tbl_usuarios` u ON c.usuario_id = u.id 
                    WHERE u.cliente_id = ? AND c.id = ?";                

            $query = $this->db->query($sql, array($cliente_id, $contato_id));
            $row = $query->row();
            //$str = $this->db->last_query();
            
            if($row->data_nascimento != NULL)
            {
            
                $dt_nasc = explode('-', $row->data_nascimento);
                $data_nascimento = $dt_nasc[2].'/'.$dt_nasc[1].'/'.$dt_nasc[0];
                $row->data_nascimento = $data_nascimento;
            }
            
            $dt_cad = explode('-', $row->data_cadastro);
            $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
            $row->data_cadastro = $data_cad; 
            
            
            $usuario = $this->clientes_model->get_usuario_by_id($row->usuario_id);
            
            $row->usuario_dono_nome = $usuario->nome;
            $row->usuario_dono_usuario = $usuario->usuario;                        
            
            return $row;
                
	}         
        
	public function get_all_contatos_newsletter_aniversarios_hoje_by_cliente_id($cliente_id)
	{  
               
            $sql = "SELECT c1.id AS `contato_id`, c1.conta_id, c1.usuario_id, c1.nome, c1.telefone, c1.email, c1.email_secundario,  c1.grupo_id, c1.compartilhar, u1.cliente_id, u1.id 
                    FROM `tbl_usuarios_contatos` c1 INNER JOIN `tbl_usuarios` u1 ON c1.usuario_id = u1.id 
                    WHERE u1.cliente_id = ? AND ( DATE_FORMAT((c1.data_nascimento),'%m-%d') = DATE_FORMAT(NOW(),'%m-%d') ) AND enviar_newsletter = '1'";                

            $query = $this->db->query($sql, array($cliente_id ));

            $str = $this->db->last_query();
            
            
            
            if($query->num_rows() > 0)
            {
                    return $query->result();
            }
            else {
                return 0;
            }
                
	}        
               

        /**
         * Deleta o contato
         * @param type $cliente_id
         * @param type $id
         * @return boolean
         */
        public function remove_contato($cliente_id, $contato_id)
        {            
            
            //confere se tem acesso ao contato
            if( count($this->get_contato($cliente_id, $contato_id)) == 0 )
                    return FALSE;
                    
            $this->db->where('id', $contato_id);
            $this->db->delete('tbl_usuarios_contatos');
            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }       

}