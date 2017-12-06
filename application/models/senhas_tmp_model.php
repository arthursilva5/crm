<?php
class Senhas_tmp_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
        
        
        public function set_pedido_senha($email_user)
        {
            
            date_default_timezone_set("Brazil/East");
            $this->load->library('enviar_email');
            $this->lang->load('email_messages', $this->session->userdata('default_lang')); // Linguagem de emails
           
            $data_hoje = date("Y-m-d");
            $usuario_id = $this->clientes_model->get_usuario_id_by_email_or_usuario($email_user);


            if($usuario_id != 0) {
           
                $rand = md5(substr(md5(microtime()),rand(0,26),32));                        
                $mensagem_email = $this->lang->line('email_messages_pedidosenha_req_linha_1');
                $mensagem_email = $this->lang->line('email_messages_pedidosenha_req_linha_2').': <strong>'.$rand.'</strong>';
                $mensagem_email .= '<br /><br />'.$this->lang->line('email_messages_pedidosenha_req_linha_3').'<br /><a href="'.base_url().'i/redefinir_senha/alterar/'.$rand.'">'.base_url().'i/redefinir_senha/alterar/'.$rand.'</a><br />';             


                $dados_u = $this->clientes_model->get_usuario_by_id($usuario_id);

                $this->enviar_email->send_email($this->input->post('email_label_endereco_email'), $this->input->post('email_label_5lobos'), $dados_u->email, $this->lang->line('email_messages_pedidosenha_req_assunto'), $mensagem_email); // envia um e-mail                
                
                $data = array(                                
                                'usuario_id' => $usuario_id,
                                'pass_key' => $rand,
                                'data' => $data_hoje,
                                'status' => 1
                );

                return $this->db->insert('tbl_senhas_tmp', $data);            
            }
            else {
                return FALSE;
            }
            
        }
        
	public function get_usuario_id_by_pass_key($passkey)
        {
            $this->db->select('id, usuario_id, pass_key, data');
            $this->db->where('pass_key', $passkey);
            $this->db->where('status', 1);
            $row = $this->db->get('tbl_senhas_tmp')->row();
            //$str = $this->db->last_query();
            return $row;
        } 
        
	public function set_status_by_pass_key($passkey, $status)
        {
                $data['status'] = $status;
                
                $this->db->where('pass_key', $passkey);
		return $this->db->update('tbl_senhas_tmp', $data);
        }
        
        public function check_valid_pass_key($passkey)
        {
                $row = $this->get_usuario_id_by_pass_key($passkey);
                
                $currentDate = new DateTime(); // (today's date is 2012-1-27)
                $startDate = new DateTime($row->data);

                $diff = $startDate->diff($currentDate);

                $daysBefore = $diff->days;            
                
                if($daysBefore == 0){
                    return TRUE;                    
                }
                else {
                    return FALSE;
                }
        }

}