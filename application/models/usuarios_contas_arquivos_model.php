<?php
class Usuarios_contas_arquivos_model extends CI_Model {

	
	public function __construct()
	{
            parent::__construct();
	}
	
	public function set_arquivo($cliente_id, $conta_id, $nome, $arquivo_nome)
	{                     
            
                $data_cadastro = date("Y-m-d");
            
                $tamanho_arquivo = filesize(PATH_UPLOAD_ATTACHMENTS.$arquivo_nome);
                
		$data = array(
				'conta_id' => $conta_id,
                                'cliente_id' => $cliente_id,
				'arquivo' => $arquivo_nome,
                                'nome' => $nome,
                                'tamanho' => $tamanho_arquivo,
                                'data_cadastro' => $data_cadastro
		);
	
		return $this->db->insert('tbl_usuarios_contas_arquivos', $data);
	}   
        
      
        
	public function get_arquivos_by_conta_id($conta_id)
	{
  
            $sql = "SELECT id, conta_id, arquivo, nome, tamanho, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_arquivos WHERE conta_id = ? ORDER BY id DESC";                

            $query = $this->db->query($sql, array($conta_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            
            return $query->result();
                
	}  
        
        public function get_tamanho_disco($cliente)
	{
            $sql = "SELECT arq.id, arq.conta_id, arq.arquivo, arq.nome, arq.tamanho,  SUM(arq.tamanho) AS `tamanho_total`, DATE_FORMAT(arq.data_cadastro, '%d/%m/%Y') AS `data_cadastro`
                    FROM tbl_usuarios_contas_arquivos arq WHERE arq.cliente_id = ?";                           

            $query = $this->db->query($sql, array($cliente))->row();                    
            
            return $query->tamanho_total;
        }              
        
	public function download_arquivos_by_id($conta_id, $arquivo_id)
	{ 
             
            $sql = "SELECT id, conta_id, arquivo, nome, tamanho, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro`                   
                    FROM tbl_usuarios_contas_arquivos WHERE conta_id = ? AND id = ? LIMIT 1";               

            $query = $this->db->query($sql, array($conta_id, $arquivo_id));
            
            if ($query->num_rows() == 0) {
                    return array();
            }               
                 
            $row = $query->row();
            $arquivo = PATH_UPLOAD_ATTACHMENTS.$row->arquivo;
            
            return $arquivo;
                
	} 
        
        public function remove_arquivo($conta_id, $id)
        {
                    
            $sql = "SELECT id, conta_id, arquivo, nome, tamanho, DATE_FORMAT(data_cadastro, '%d/%m/%Y') AS `data_cadastro` 
                    FROM tbl_usuarios_contas_arquivos WHERE conta_id = ? AND id = ? LIMIT 1";                

            $query = $this->db->query($sql, array($conta_id, $id));
            $arquivo = $query->row();           
            
            $this->db->where('id', $id);
            $this->db->where('conta_id', $conta_id);
            $this->db->delete('tbl_usuarios_contas_arquivos');            

            if($this->db->affected_rows() >0){
                unlink(PATH_UPLOAD_ATTACHMENTS.$arquivo->arquivo);                
                return TRUE;
            }
            else {
                return FALSE;
            }
        }  

}