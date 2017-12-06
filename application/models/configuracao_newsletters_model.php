<?php
class Configuracao_newsletters_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        
        
        public function set_newsletter_aniversario($cliente_id, $nome_email, $assunto_email, $mensagem, $status)
        {        
                        
                $data = array(
                                'cliente_id' => $cliente_id,
                                'nome_email' => $nome_email,
                                'assunto_email' => $assunto_email,
                                'mensagem' => $mensagem,
                                'status' => $status
                );
	
		return $this->db->insert('tbl_configuracao_newsletter_aniversario', $data);        
        }
        
        
        
        public function set_newsletter_aniversario_update($cliente_id, $nome_email, $assunto_email, $mensagem, $status)
        {

            $data = array(
                            'nome_email' => $nome_email,
                            'assunto_email' => $assunto_email,
                            'mensagem' => $mensagem,
                            'status' => $status
            );
            $this->db->where('cliente_id', $cliente_id);
            
            $query = $this->db->update('tbl_configuracao_newsletter_aniversario', $data);
            
            if($this->db->affected_rows() == 0){
                $this->set_newsletter_aniversario($cliente_id, $nome_email, $assunto_email, $mensagem);                
            }                                   
            return TRUE;

        }          
        

	public function get_newsletter_aniversario($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_configuracao_newsletter_aniversario');
            
            if ($query->num_rows() == 0) {
                    return array();
            }                
            
            $row = $query->row(); 
            
            return $row;
                
	} 
        
        /**
         * Retorna quem poderemos enviar e-mail, que deixaram como ativo a configuração de envio
         * @return type
         */
	public function get_newsletter_aniversario_by_status($status)
	{
            
            $this->db->where('status =', $status);
            $query = $this->db->get('tbl_configuracao_newsletter_aniversario');

            if($query->num_rows() > 0)
            {
                    return $query->result();
            }
            else {
                return 0;
            }            
            
                
	}         
        
         public function get_newsletter_aniversarios_do_dia(){
             
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

}