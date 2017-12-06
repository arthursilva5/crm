<?php
class Configuracao_notificacoes_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
        
        
        
        public function set_notificacao($cliente_id, $lead_notificar, $lead_fechar_dia_antes, $lead_fechar_dia_depois, $email_adm_cadastros_notificar)
        {        
                        
                $data = array(
                                'cliente_id' => $cliente_id,
                                'lead_notificar' => $lead_notificar,
                                'lead_fechar_dia_antes' => $lead_fechar_dia_antes,
                                'lead_fechar_dia_depois' => $lead_fechar_dia_depois,
                                'email_adm_cadastros_notificar' => $email_adm_cadastros_notificar
                );
	
		return $this->db->insert('tbl_configuracao_notificacoes', $data);        
        }
        
        public function set_notificacao_update($cliente_id, $lead_notificar, $lead_fechar_dia_antes, $lead_fechar_dia_depois, $email_adm_cadastros_notificar)
        {
                
            if ($lead_fechar_dia_depois > 0) $lead_fechar_dia_depois_n = -$lead_fechar_dia_depois;
            else $lead_fechar_dia_depois_n = $lead_fechar_dia_depois;

            $data = array(
                            'lead_notificar' => $lead_notificar,
                            'lead_fechar_dia_antes' => $lead_fechar_dia_antes,
                            'lead_fechar_dia_depois' => $lead_fechar_dia_depois_n,
                            'email_adm_cadastros_notificar' => $email_adm_cadastros_notificar
            );

            $this->db->where('cliente_id', $cliente_id);
            return $this->db->update('tbl_configuracao_notificacoes', $data);                    

        }          
        

	public function get_notificacao_by_cliente_id($cliente_id)
	{
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_configuracao_notificacoes');
            
            if ($query->num_rows() == 0) {
                    return array();
            }                
            
            $row = $query->row(); 
            
            return $row;
                
	}                       

}