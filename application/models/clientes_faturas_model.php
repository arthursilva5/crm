<?php
class Clientes_faturas_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        
        
	public function set_fatura($cliente_id, $valor, $plano, $num_usuarios)
	{                     
                $this->lang->load('pre_login', $this->session->userdata('default_lang'));
                $this->lang->load('common', $this->session->userdata('default_lang'));
                
                if($plano == 1) // se o plano for o grátis  nem executa
                    return FALSE;
                elseif($plano == 2)
                    $nome_plano = $this->lang->line('pre_login_plano_b');
                elseif($plano == 3)
                    $nome_plano = $this->lang->line('pre_login_plano_c');
                elseif($plano == 4)
                    $nome_plano = $this->lang->line('pre_login_plano_d');                
                
                $descricao = $this->lang->line('common_plano_label_titulo_seu_plano').': '.$nome_plano.', '.$this->lang->line('common_plano_label_numero_usuarios').': '.$num_usuarios;
                
                
                $data_hoje = date("Y-m-d");
                
                if( $this->input->post('data_vencimento_pgm') != '' )
                {   
                    
                    $data1 = explode('/', $this->input->post('data_vencimento_pgm'));
                    $data2 = $data1[2].'-'.$data1[1].'-'.$data1[0];
                    
                    // calcula nova data de vencimento
                    if($this->input->post('periodo_pgm') == 'y')
                        $data_vencimento1 = strtotime ( '+1 year' , strtotime ( $data2 ) );
                    else
                        $data_vencimento1 = strtotime ( '+30 days' , strtotime ( $data2 ) );                      

                }
                else
                {
                    $data_vencimento1 = strtotime ( '+30 days' , strtotime ( $data_hoje ) );             
                }                    
                
                $data_vencimento2 = date ( 'Y-m-j' , $data_vencimento1 );
            
		$data = array(
				'cliente_id' => $cliente_id,
				'descricao' => $descricao,
                                'valor' => $valor,
                                'data_vencimento' => $data_vencimento2,
                                'status' => 'u',
		);
	
		return $this->db->insert('tbl_clientes_faturas', $data);
	}
        
        public function set_fatura_paga($fatura_id)
        {                                             
                $data_pagamento = date("Y-m-d");
                
                $data = array(
                                'data_pagamento' => $data_pagamento,
                                'status' => 'p'
                );

            $this->db->where('id', $fatura_id);                
            return $this->db->update('tbl_clientes_faturas', $data);       
        }          
        
        
        
        /**
         * Atualiza o plano do cliente
         * @param type $cliente_id
         * @param type $valor
         * @param type $plano
         * @param type $num_usuarios
         * @return boolean
         */
	public function set_fatura_plano_update($cliente_id, $valor, $plano, $num_usuarios)
	{                     
            
                $this->lang->load('pre_login', $this->session->userdata('default_lang'));
                $this->lang->load('common', $this->session->userdata('default_lang'));
                
                //nao deixa mudar para o gratis se tiver usuários cadastrados
                $total_usuarios = $this->clientes_model->get_total_usuarios($cliente_id);
                
                if($plano == 1){ // se o plano for o grátis e tiver usuarios, da erro  nem executa
                    $this->delete_fatura_unpaid_by_cliente_id($cliente_id); // deleta a fatura
                    return FALSE;
                }
                elseif($plano == 2)
                    $nome_plano = $this->lang->line('pre_login_plano_b');
                elseif($plano == 3)
                    $nome_plano = $this->lang->line('pre_login_plano_c');
                elseif($plano == 4)
                    $nome_plano = $this->lang->line('pre_login_plano_d'); 
                
                $descricao = $this->lang->line('common_plano_label_periodicidade').' - '.$this->lang->line('common_plano_label_titulo_seu_plano').': '.$nome_plano.', '.$this->lang->line('common_plano_label_numero_usuarios').': '.$num_usuarios;
               
            
		$sql_ultima_fatura = "SELECT id, cliente_id, valor, status 
				FROM `tbl_clientes_faturas` 
				WHERE cliente_id = ? AND status = ?";
		
		$query_ultima_fatura = $this->db->query($sql_ultima_fatura, array($cliente_id, 'u'));
                
                
                if($query_ultima_fatura->num_rows() > 0) // caso existe fatura em aberto, atualiza ela
                {
                    $row_ultima_fatura = $query_ultima_fatura->row();
                    //$valor_plano_atualizado =  ($valor - $row_ultima_fatura->valor);
                    //$valor_plano_atualizado =  $valor;
                    $data = array(
                                    'descricao' => $descricao,
                                    'valor' => $valor
                    );

                    $this->db->where('cliente_id', $cliente_id);
                    return $this->db->update('tbl_clientes_faturas', $data);                    
                }
                else {
                    $this->set_fatura($cliente_id, $valor, $plano, $num_usuarios); // cria fatura
                }
                return FALSE;
 
	}        
        
        /**
         * Retorna a fatura do cliente de acordo com o ID e Status
         * @param type $cliente_id
         * @param type $status
         * @return type
         */
	public function get_fatura_by_cliente_id($cliente_id, $status)
        {
            $query = $this->db->get_where('tbl_clientes_faturas', array('cliente_id' => $cliente_id,  'status' => $status));
            if($query->num_rows() == 0) // caso não encontre fatura
                return FALSE;
            
            $row = $query->row();
            
            if($row->data_pagamento != NULL) 
            {            
                $dt_pag = explode('-', $row->data_pagamento);
                $data_pagamento = $dt_pag[2].'/'.$dt_pag[1].'/'.$dt_pag[0];
                $row->data_pagamento = $data_pagamento;
            }
            
            if($row->data_vencimento != NULL) 
            {             
                // converte a data de vencimento
                $dt_venc = explode('-', $row->data_vencimento);
                $data_vencimento = $dt_venc[2].'/'.$dt_venc[1].'/'.$dt_venc[0];            
                $row->data_vencimento = $data_vencimento;  
                
                
                $data_hoje = date("Y-m-d");
                $data_vencimento1 = strtotime ( '+1 day' , strtotime ( $data_hoje ) );
                $data_vencimento2 = date ( 'Y-m-j' , $data_vencimento1 );  
                $row->data_vencimento_atual = $data_vencimento2;
            }
            
            $row->valor_db = $row->valor;
            $row->valor_db_anual = $row->valor*12 - (($row->valor*12) * 0.10); // com desconto de 10%
            $preco_n = 'R$ '.number_format($row->valor,2,",",".");
            $row->valor = $preco_n;                        
            $row->valor_anual = 'R$ '.number_format($row->valor_db_anual,2,",",".");
            
            return $row;
        }  
        
        
	public function get_fatura_by_id($fatura_id)
        {
            $query = $this->db->get_where('tbl_clientes_faturas', array('id' => $fatura_id));
            if($query->num_rows() == 0) // caso não encontre fatura
                return FALSE;
            
            $row = $query->row();
            
            if($row->data_pagamento != NULL) 
            {            
                $dt_pag = explode('-', $row->data_pagamento);
                $data_pagamento = $dt_pag[2].'/'.$dt_pag[1].'/'.$dt_pag[0];
                $row->data_pagamento = $data_pagamento;
            }
            
            if($row->data_vencimento != NULL) 
            {             
                // converte a data de vencimento
                $dt_venc = explode('-', $row->data_vencimento);
                $data_vencimento = $dt_venc[2].'/'.$dt_venc[1].'/'.$dt_venc[0];            
                $row->data_vencimento = $data_vencimento;  
                
                
                $data_hoje = date("Y-m-d");
                $data_vencimento1 = strtotime ( '+1 day' , strtotime ( $data_hoje ) );
                $data_vencimento2 = date ( 'Y-m-j' , $data_vencimento1 );  
                $row->data_vencimento_atual = $data_vencimento2;
            }
            
            $row->valor_db = $row->valor;
            $preco_n = 'R$ '.number_format($row->valor,2,",",".");
            $row->valor = $preco_n;
            
            return $row;
        }         
        
	public function get_all_faturas_by_cliente_id($cliente_id, $status)
        {
            $this->lang->load('common', $this->session->userdata('default_lang'));
            $rows = $this->db->get_where('tbl_clientes_faturas', array('cliente_id' => $cliente_id,  'status' => $status));
                        
            
            foreach ($rows as $key => $row) //redefine a data
            {            
            
                if($row->data_pagamento != NULL) 
                {            
                    $dt_pag = explode('-', $row->data_pagamento);
                    $data_pagamento = $dt_pag[2].'/'.$dt_pag[1].'/'.$dt_pag[0];
                    $row->data_pagamento = $data_pagamento;
                }

                if($row->data_vencimento != NULL) 
                {             
                    // converte a data de vencimento
                    $dt_venc = explode('-', $row->data_vencimento);
                    $data_vencimento = $dt_venc[2].'/'.$dt_venc[1].'/'.$dt_venc[0];            
                    $row->data_vencimento = $data_vencimento;                                    
                }                               

                $preco_n = $this->lang->line('common_label_brasil_real').number_format($row->valor,2,",",".");
                $row->valor = $preco_n;

                
            }
            return $rows;
        }
        /*
	public function get_all_faturas_by_admin($status)
        {
            $this->lang->load('common', $this->session->userdata('default_lang'));
            $rows = $this->db->get_where('tbl_clientes_faturas', array('status' => $status));
                        
            
            foreach ($rows as $key => $row) //redefine a data
            {            
            
                if($row->data_pagamento != NULL) 
                {            
                    $dt_pag = explode('-', $row->data_pagamento);
                    $data_pagamento = $dt_pag[2].'/'.$dt_pag[1].'/'.$dt_pag[0];
                    $row->data_pagamento = $data_pagamento;
                }

                if($row->data_vencimento != NULL) 
                {             
                    // converte a data de vencimento
                    $dt_venc = explode('-', $row->data_vencimento);
                    $data_vencimento = $dt_venc[2].'/'.$dt_venc[1].'/'.$dt_venc[0];            
                    $row->data_vencimento = $data_vencimento;                                    
                }                               

                $preco_n = $this->lang->line('common_label_brasil_real').number_format($row->valor,2,",",".");
                $row->valor = $preco_n;

                
            }
            return $rows;
        }  
        */
        
	public function get_all_faturas_by_admin($status, $start, $limit, $contar)
	{  
            
     
                if($contar == 0)
                {
                    // DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro`
                    $sql = "SELECT  f.id AS fatura_id, f.cliente_id, DATE_FORMAT(f.data_vencimento, '%d/%m/%Y') AS `data_vencimento`, f.descricao, f.valor, f.status,
                            cli.id AS cliente_id2, cli.nome_razao
                            FROM `tbl_clientes_faturas` f 
                            INNER JOIN `tbl_clientes` cli ON f.cliente_id = cli.id                             
                            WHERE f.status = ?
                            ORDER BY f.data_vencimento DESC LIMIT ?,?";                

                    $rows = $this->db->query($sql, array($status, $start, $limit));                                       
                }
                else 
                {
                
                    $sql = "SELECT  f.id AS fatura_id, f.cliente_id, DATE_FORMAT(f.data_vencimento, '%d/%m/%Y') AS `data_vencimento`, f.descricao, f.valor, f.status,
                            cli.id AS cliente_id2, cli.nome_razao
                            FROM `tbl_clientes_faturas` f 
                            INNER JOIN `tbl_clientes` cli ON f.cliente_id = cli.id                             
                            WHERE f.status = ?
                             ORDER BY f.data_vencimento DESC";                

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
                        
                        //$nome_razao = $this->clientes_model->get_nome_cliente_by_cliente_id($row->cliente_id);
          
                            //$row->nome_razao_indicado = $this->clientes_model->get_nome_cliente_by_cliente_id($row->cliente_id);

                    }                 
                
                return $rows->result();
            }
            else
            {                
                return $rows->num_rows();
            }
                
	}        
          
        
	public function get_total_faturas_admin_by_status($status)
	{  
    
            $sql = "SELECT id, cliente_id, SUM(valor) AS total FROM tbl_clientes_faturas WHERE status= ?";                

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
        
        /*
         public function get_dias_expirar_plano_by_cliente_id($cliente_id)
         {     
             
            $this->db->select('id, data_venc, id_perfil');
            $this->db->where('id_perfil', $id_perfil);
            $this->db->order_by("id", "desc");
            $this->db->limit(1);
            $query = $this->db->get('tbl_faturas');
            
            if($query->num_rows() > 0){
                $row = $query->row();
                
                $currentDate = new DateTime(); // (today's date is 2012-1-27)
                $startDate = new DateTime($row->data_venc);

                $diff = $startDate->diff($currentDate);

                $daysBefore = $diff->days;
                
                if ($startDate < $currentDate) { // caso vencimento tenha passado
                    return 0;
                }                

                return $daysBefore;                 

            }
            else {
                return 0;
            }           
         }          
            */  
         
        
         public function get_existe_fatura_vencida_by_client_id($cliente_id)
         {
             
                $query_tbls = "SELECT `id`, `cliente_id`, `status`, 
                            `data_vencimento` AS DueDate, 
                            DATEDIFF(`data_vencimento`, CURDATE()) AS ItemLife
                            FROM `tbl_clientes_faturas` 
                            WHERE DATEDIFF(`data_vencimento`, CURDATE()) <= 0
                            AND cliente_id = ? AND status='u' ORDER BY id DESC LIMIT 1";
		
		$query = $this->db->query($query_tbls, array($cliente_id));
                $str = $this->db->last_query();
                
		if($query->num_rows > 0)
		{
			return TRUE;
		}
                else {
                    return FALSE;
                }
         } 
         
         public function getFaturasVencidas(){
             
                $query_tbls = "SELECT `id`, `cliente_id`, `status`, 
                            `data_vencimento` AS DueDate, 
                            DATEDIFF(`data_vencimento`, CURDATE()) AS ItemLife
                            FROM `tbl_clientes_faturas` 
                            WHERE DATEDIFF(`data_vencimento`, CURDATE()) <= 0
                            AND status = ?";
		
		$query = $this->db->query($query_tbls, array('u'));
                //$str = $this->db->last_query();
                
		if($query->num_rows > 0)
		{
			return $query->result();
		}
                else {
                    return 0;
                }
         }         
         
        public function delete_fatura_unpaid_by_cliente_id($cliente_id)
        {   
                        
            $this->db->where('cliente_id', $cliente_id);
            $this->db->where('status', 'u');
            $this->db->delete('tbl_clientes_faturas');
            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }          

}