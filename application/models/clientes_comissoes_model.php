<?php
class Clientes_comissoes_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        
        
        public function set_comissao($cliente_id, $cliente_indicou, $data_pagamento, $data_adicao, $descricao, $valor, $status)
        {                                             
                $data_adicao = date("Y-m-d");
                
                $data = array(
                                'cliente_id_indicou' => $cliente_indicou,
                                'valor' => $valor,
                                'status' => $status
                );                
	
                if(trim($cliente_id) != 0)
                    $data['cliente_id'] = $cliente_id;                
                
                if(trim($data_adicao) != '')
                    $data['data_adicao'] = $data_adicao;
                
                if(trim($data_pagamento) != '')
                    $data['data_pagamento'] = $data_pagamento;  
                
                if(trim($descricao) != '')
                    $data['descricao'] = $descricao;                
                
		return $this->db->insert('tbl_clientes_comissoes', $data);        
        } 
        
        
        public function set_comissao_paga($comissao_id)
        {                                             
                $data_pagamento = date("Y-m-d");
                
                $data = array(
                                'data_pagamento' => $data_pagamento,
                                'status' => 'p'
                );

            $this->db->where('id', $comissao_id);                
            return $this->db->update('tbl_clientes_comissoes', $data);       
        }         
        
        
        /**
         * Retorna as comissões do cliente
         * @param type $cliente_id
         * @param type $start
         * @param type $limit
         * @param type $contar
         * @return type
         */
	public function get_comissoes_by_cliente_id($cliente_id, $start, $limit, $contar)
	{  
            
     
                if($contar == 0)
                {
                    // DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro`
                    $sql = "SELECT  c.id AS comissao_id, c.cliente_id, c.cliente_id_indicou, DATE_FORMAT(c.data_pagamento, '%d/%m/%Y') AS `data_pagamento`,  DATE_FORMAT(c.data_adicao, '%d/%m/%Y') AS `data_adicao`, c.descricao, c.valor, c.status,
                            cli.id AS cliente_id2, cli.nome_razao
                            FROM `tbl_clientes_comissoes` c 
                            INNER JOIN `tbl_clientes` cli ON c.cliente_id_indicou = cli.id                             
                            WHERE c.cliente_id_indicou = ?
                            ORDER BY c.id DESC LIMIT ?,?";                

                    $rows = $this->db->query($sql, array($cliente_id, $start, $limit));                                       
                }
                else 
                {
                
                    $sql = "SELECT  c.id AS comissao_id, c.cliente_id, c.cliente_id_indicou, DATE_FORMAT(c.data_pagamento, '%d/%m/%Y') AS `data_cadastro`,  DATE_FORMAT(c.data_adicao, '%d/%m/%Y') AS `data_adicao`, c.descricao, c.valor, c.status,
                            cli.id AS cliente_id2, cli.nome_razao
                            FROM `tbl_clientes_comissoes` c INNER JOIN `tbl_clientes` cli ON c.cliente_id_indicou = cli.id 
                            WHERE c.cliente_id_indicou = ? ORDER BY c.id DESC";                

                    $rows = $this->db->query($sql, array($cliente_id));
                                                          
                }

            
            //$str = $this->db->last_query();
            
            if($contar == 0){
                if ($rows->num_rows() == 0) {
                        return array();
                }      
                
                    
                    foreach ($rows->result() as $key => $row) //redefine a data
                    {            
                              
                        $row->valor_db = $row->valor;
                        $preco_n = 'R$ '.number_format($row->valor,2,",",".");
                        $row->valor = $preco_n;
                        
                        //$nome_razao = $this->clientes_model->get_nome_cliente_by_cliente_id($row->cliente_id);
          
                            $row->nome_razao_indicado = $this->clientes_model->get_nome_cliente_by_cliente_id($row->cliente_id);

                    }                 
                
                return $rows->result();
            }
            else
            {                
                return $rows->num_rows();
            }
                
	}
        
	public function get_comissoes_admin($status, $start, $limit, $contar)
	{  
            
  
                if($contar == 0)
                {
                    // DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro`
                    $sql = "SELECT  c.id AS comissao_id, c.cliente_id, c.cliente_id_indicou, DATE_FORMAT(c.data_pagamento, '%d/%m/%Y') AS `data_pagamento`,  DATE_FORMAT(c.data_adicao, '%d/%m/%Y') AS `data_adicao`, c.descricao, c.valor, c.status,
                            cli.id AS cliente_id, cli.nome_razao
                            FROM `tbl_clientes_comissoes` c INNER JOIN `tbl_clientes` cli ON c.cliente_id_indicou = cli.id 
                            WHERE c.status = ?
                            ORDER BY c.cliente_id_indicou DESC LIMIT ?,?";                

                    $rows = $this->db->query($sql, array($status, $start, $limit));
                }
                else 
                {
                
                    $sql = "SELECT  c.id AS comissao_id, c.cliente_id, c.cliente_id_indicou, DATE_FORMAT(c.data_pagamento, '%d/%m/%Y') AS `data_cadastro`,  DATE_FORMAT(c.data_adicao, '%d/%m/%Y') AS `data_adicao`, c.descricao, c.valor, c.status,
                            cli.id AS cliente_id, cli.nome_razao
                            FROM `tbl_clientes_comissoes` c INNER JOIN `tbl_clientes` cli ON c.cliente_id_indicou = cli.id 
                            WHERE c.status = ? ORDER BY c.cliente_id_indicou DESC";                

                    $rows = $this->db->query($sql, array($status));
                    
                                       
                }

            
            //$str = $this->db->last_query();
            
            if($contar == 0){
                if ($rows->num_rows() == 0) {
                        return array();
                }      
                
                    
                    foreach ($rows->result() as $key => $row) //redefine a data
                    {            
                              
                        $row->valor_db = $row->valor;
                        $preco_n = 'R$ '.number_format($row->valor,2,",",".");
                        $row->valor = $preco_n;


                    }                 
                
                return $rows->result();
            }
            else
            {                
                return $rows->num_rows();
            }
                
	}        
        
        
	public function get_total_comissoes_pagas_by_cliente_id($cliente_id)
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= 'p' AND cliente_id_indicou = ?";                

            $query = $this->db->query($sql, array($cliente_id));


            
          
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
        
	public function get_total_comissoes_pagas_admin()
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= 'p'";                

            $query = $this->db->query($sql);
            
          
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
         * Retorna o valor total de faturas não pagas
         * @return type
         */
	public function get_total_comissoes_naopago_admin()
	{  
    
            $sql = "SELECT id, cliente_id_indicou, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= 'u' OR status= 'w'";                

            $query = $this->db->query($sql);

          
            if ($query->num_rows() == 0) {
                    return array();
            }      
            $row = $query->row();
            $row->total_db = $row->total;            
            $preco_n = 'R$ '.number_format($row->total,2,",",".");
            $row->total = $preco_n;
            //$str = $this->db->last_query();                 
            return $row;
        
	}        
        
        
	public function get_total_comissoes_naopago_by_cliente_id($cliente_id)
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= 'u' AND cliente_id_indicou = ?";                

            $query = $this->db->query($sql, array($cliente_id));

          
            if ($query->num_rows() == 0) {
                    return array();
            }      
            $row = $query->row();
            $row->total_db = $row->total;            
            $preco_n = 'R$ '.number_format($row->total,2,",",".");
            $row->total = $preco_n;
                                    
            return $row;
        
	}
        
	public function get_total_comissoes_aguarda_pgm_by_cliente_id($cliente_id)
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= 'w' AND cliente_id_indicou = ?";                

            $query = $this->db->query($sql, array($cliente_id));

          
            if ($query->num_rows() == 0) {
                    return array();
            }      
            $row = $query->row();
            $row->total_db = $row->total;            
            $preco_n = 'R$ '.number_format($row->total,2,",",".");
            $row->total = $preco_n;
                                    
            return $row;
        
	} 
        
        /**
         * Retorna os pagamentos para o administrador
         * @param type $status
         * @return type
         */
	public function get_total_comissoes_admin($status)
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_comissoes WHERE status= ?";                

            $query = $this->db->query($sql, array($status));


            
          
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
        
	public function get_total_em_caixa_by_cliente_id($cliente_id)
	{                  
            $total = $this->get_total_comissoes_naopago_by_cliente_id($cliente_id)->total_db - ( $this->get_total_comissoes_pagas_by_cliente_id($cliente_id)->total_db + $this->get_total_comissoes_aguarda_pgm_by_cliente_id($cliente_id)->total_db );        
            return $total;
	}         
        
        public function set_request_money($cliente_id, $valor, $conta)
        {
            
            //confere se o preco foi digitado
            if(($valor != '') ){
                    $number = str_replace(',','.',str_replace('.','',$valor));
                    $number_sem_cifrao = trim(str_replace('R$','',$number));                                       
                    
                    if($number_sem_cifrao < 100)
                        return FALSE;
                    else{
                        
                        if($number_sem_cifrao  % 20 != 0)
                            return FALSE;
                        
                        //total em caixa
                        $total = $this->get_total_em_caixa_by_cliente_id($cliente_id);
                        if($this->get_total_em_caixa_by_cliente_id($cliente_id) >= $number_sem_cifrao){
                            
                            //efetua o pedido
                            $data_hoje = date("Y-m-d");
                            $this->set_comissao(0, $cliente_id, '', $data_hoje, $conta, $number_sem_cifrao, 'w');
                            return TRUE;
                        }
                        else
                            return FALSE;
                    }                       
            }
            else
                return FALSE;            
        }

}