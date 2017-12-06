<?php
class Clientes_model extends CI_Model {
	
	public function __construct()
	{
            parent::__construct();
	}
	

        /**
         * Criar o cliente e retorna o ID dele
         * @return INT
         */
	public function set_cliente()
	{
                $this->load->model('clientes_faturas_model');
                $this->load->model('configuracao_notificacoes_model');
                $this->load->model('configuracao_servidor_email_model');
                $this->load->model('tipos_grupos_model');
                
                
                $cliente_id = $this->set_cliente_dados(); // preenche tabela CLIENTES
                $this->set_cliente_plano($cliente_id, $this->input->post('plano'), $this->input->post('usuario_quantidade')); // preenche tabela Cliente Planos
                $this->tipos_grupos_model->set_grupo($cliente_id, 'CRM');
                $grupo_id = $this->tipos_grupos_model->get_grupo_signup($cliente_id);
                $this->set_cliente_usuario($cliente_id, 'rwxrwxrwx', $grupo_id); // preenche tabela Cliente Usuários
                $this->set_cliente_modulos($cliente_id, $this->input->post('plano'), 0); // cadastra os módulos
                $this->clientes_faturas_model->set_fatura($cliente_id, $this->get_valor_plano($this->input->post('plano'), $this->input->post('usuario_quantidade')), $this->input->post('plano') ,$this->input->post('usuario_quantidade') );
                $this->configuracao_notificacoes_model->set_notificacao($cliente_id, 0, 0, 0, 0); // cria as notificacoes
                $this->configuracao_servidor_email_model->set_servidor_email($cliente_id, 1, null, 465, null, null); // cria as configurações de e-mail
                
                
                return $cliente_id;
	}
                
        
        /**
         * Preenche tabela do CLIENTE
         */
        public function set_cliente_dados(){
                $data_cadastro = date("Y-m-d");
            
                if(!$this->get_plano_by_cliente_id($this->input->post('id_indicou'))){
                    $cliente_id_indicou = 0;
                }
                else{
                    $cliente_id_indicou = $this->input->post('id_indicou');
                }
                
		$data = array(
				'nome_razao' => $this->input->post('nome_razao'),
				'email' => $this->input->post('email'),
				'data_cadastro' => $data_cadastro,
                                'cliente_id_indicou' => $cliente_id_indicou,
                                'divulgar' => 0,
                                'status' => 't' // Trial . Teste
		);
	
		$this->db->insert('tbl_clientes', $data);  
                
                return $this->db->insert_id(); // retorna o ID cadastrado
        }
        
        
	public function set_cliente_dados_update($cliente_id)
	{                       

		$data = array(
				'cnpj_cpf' => $this->input->post('cnpj_cpf'),
                                'nome_razao' => $this->input->post('nome_razao'),
				'email' => $this->input->post('email'),
                                'telefone' => $this->input->post('telefone'),                                
                                'cidade_id' => $this->input->post('cidade'),
                                'endereco' => $this->input->post('endereco'),
                                'end_numero' => $this->input->post('end_numero'),
                                'end_complemento' => $this->input->post('end_complemento'),
                                'end_bairro' => $this->input->post('end_bairro'),
                                'end_cep' => $this->input->post('end_cep')
		);
                
                if($this->input->post('celular') != '')
                    $data['celular'] = $this->input->post('celular');                
                
                $this->db->where('id', $cliente_id);
		return $this->db->update('tbl_clientes', $data);
	}        
        
        
        /**
         * Preenche tabela do CLIENTE - PLANO
         */
        public function set_cliente_plano($cliente_id, $plano, $total_usuarios){
            
                //calcula o valor do plano
                $valor_plano = $this->get_valor_plano($plano, $total_usuarios);
            
		$data = array(
				'cliente_id' => $cliente_id,
                                'plano' => $plano,
				'total_usuarios' => $total_usuarios,
                                'valor' => $valor_plano
		);
	
		return $this->db->insert('tbl_clientes_planos', $data);                  
        } 
        
        
        /**
         * Atualiza o plano do cliente
         * @param type $cliente_id
         * @param type $plano
         * @return type
         */
        public function set_cliente_plano_update($cliente_id, $plano){
            
            
                //calcula o valor do plano
                $total_usuarios = $this->get_total_usuarios($cliente_id);
                if($total_usuarios > 1 && $plano == '1')
                    return FALSE;
                
                
                $valor_plano = $this->get_valor_plano($plano, $total_usuarios);
                $this->set_cliente_modulos_update($cliente_id, $plano); // atualiza os modulos
                
                //atualiza valor da fatura
                $this->load->model('clientes_faturas_model');
                $this->clientes_faturas_model->set_fatura_plano_update($cliente_id, $valor_plano, $plano, $total_usuarios);            
                
		$data = array(
                                'plano' => $plano,
				'total_usuarios' => $total_usuarios,
                                'valor' => $valor_plano
		);
	
                $this->db->where('cliente_id', $cliente_id);
                $this->db->update('tbl_clientes_planos', $data);  
		return TRUE;                
        }         
        
        /**
         * Preenche tabela do CLIENTE - USUÁRIO
         */
        public function set_cliente_usuario($cliente_id, $chmod, $grupo_id){
                
                $this->load->library('slugs_generator'); // gera slugs
            
                /*
                if($chmod == '' || empty($chmod)){
                    $chmod = 'rwxrwxrwx';
                }
                 * 
                 */
                
                
                $data_cadastro = date("Y-m-d");
            
                $nome_cli = $this->input->post('nome').' '.$this->input->post('sobrenome');
                $new_usuario = $this->slugs_generator->remove_accent($this->input->post('usuario'));
                
                
		// converte a data de nascimento
		$dt = explode('/', $this->input->post('data_nasc'));
		$data_nasc = $dt[2].'-'.$dt[1].'-'.$dt[0];                
                
                
		$data = array(
				'cliente_id' => $cliente_id,
				'nome' => $nome_cli,
                                'email' => $this->input->post('email'),
				'usuario' => preg_replace('/[^.a-zA-Z0-9_-]|[.]$/s', '', strtolower($new_usuario)),
				'senha' => md5($this->input->post('senha')),
                                'grupo_id' => $grupo_id,                    
                                'data_nascimento' => $data_nasc,
                                'data_cadastro' => $data_cadastro,
                                'chmod' => $chmod
		);
                                	
		return $this->db->insert('tbl_usuarios', $data);                  
        }   
        
        
        /**
         * Atualizar o usuário
         * @param type $usuario_id
         * @return boolean
         */
	public function set_cliente_usuario_update($usuario_id, $chmod, $adm)
	{
                                                 
		// converte a data de nascimento
		$dt = explode('/', $this->input->post('data_nasc'));
		$data_nasc = $dt[2].'-'.$dt[1].'-'.$dt[0];  
                
                
	
		$data = array(
				'nome' => $this->input->post('nome'),
                                'email' => $this->input->post('email'),
                                'data_nascimento' => $data_nasc,
		);
                
                //insere o tipo de grupo
                if($this->input->post('grupo_id') != 0)
                    $data['grupo_id'] = $this->input->post('grupo_id');
                
                
                if($this->session->userdata('userid') != $usuario_id){ // Só atualiza se não for o próprio usuário
                                  
                    if($this->input->post('tipo') != 0)
                    {
                        // CHMOD
                        if($chmod == 1)
                            $data['chmod'] = 'rwxrwxrwx';
                        elseif($chmod == 2)
                            $data['chmod'] = 'rwxrwxrrr'; 
                    }
                }
                
                
                if($adm != 1)
                {
                    // atualiza senha
                     if( $this->input->post('senha_antiga') != '' && $this->session->userdata('senha') == md5($this->input->post('senha_antiga')) ){                   
                         $data['senha'] = md5($this->input->post('senha_nova'));
                     }
                     elseif ($this->input->post('senha_antiga') == '') {                
                     }
                     else { return FALSE; }                
                }
                else // caso seja administrador trocando a senha
                {
                    if($this->input->post('senha') != ''){
                        $data['senha'] = md5($this->input->post('senha'));
                    }                                        
                }
                
                
                $this->db->where('id', $usuario_id);
		return $this->db->update('tbl_usuarios', $data);
	}        
        
        
        /**
         * Preenche tabela do CLIENTE - MÓDULOS
         */
        public function set_cliente_modulos($cliente_id, $plano, $revendedor){
            
            if($plano == 1){
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            elseif($plano == 2){
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            elseif($plano == 3){
                $mod_contatos = 1;
                $mod_newsletter = 1;
            }
            elseif($plano == 4){
                $mod_contatos = 1;
                $mod_newsletter = 1;
            }
            else {
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            
		$data = array(
				'cliente_id' => $cliente_id,
				'mod_revendedor' => $revendedor,
                                'mod_contatos' => $mod_contatos,
                                'mod_newsletter' => $mod_newsletter
		);
	
		return $this->db->insert('tbl_clientes_modulos', $data);                  
        }  
        
        public function set_cliente_modulos_update($cliente_id, $plano){
            
            if($plano == 1){
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            elseif($plano == 2){
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            elseif($plano == 3){
                $mod_contatos = 1;
                $mod_newsletter = 1;
            }
            elseif($plano == 4){
                $mod_contatos = 1;
                $mod_newsletter = 1;
            }
            else {
                $mod_contatos = 1;
                $mod_newsletter = 0;
            }
            
		$data = array(
                                'mod_contatos' => $mod_contatos,
                                'mod_newsletter' => $mod_newsletter
		);                 
                
                $this->db->where('cliente_id', $cliente_id);
		return $this->db->update('tbl_clientes_modulos', $data);                
        }         
        
        
        /*
         * Define uma nova senha
         */
	public function set_usuario_nova_senha($usuario_id)
	{

               // atualiza senha
                if( $this->input->post('senha') != ''){                   
                    $data['senha'] = md5($this->input->post('senha'));
                }
                elseif ($this->input->post('senha') == '') {
                    return FALSE;
                }
                else { return FALSE; }
                
                $this->db->where('id', $usuario_id);
                $this->db->limit(1);
		return $this->db->update('tbl_usuarios', $data);
	}
        
        /**
         * Modifica o número de usuários do plano
         * @param type $cliente_id
         * @return type
         */
	public function set_plano_num_usuarios_update($cliente_id, $total_usuarios)
	{                                
                $data['total_usuarios'] = $total_usuarios;
                
                $this->db->where('cliente_id', $cliente_id);
                $this->db->limit(1);
		return $this->db->update('tbl_clientes_planos', $data);
	}        
            
        
        /**
         * Retorna o valor do plano
         */
        public function get_valor_plano($plano, $usuarios)
	{
            if($plano == 1){
                $valor_usuario =  0;
            }
            elseif($plano == 2){
                $valor_usuario = 17.00;
            }
            elseif($plano == 3){
                $valor_usuario = 25.00;
            }
            elseif($plano == 4){
                $valor_usuario = 50.00;
            }
            else {
                $valor_usuario = 17.00;
            }
            
            //calcular valor plano
            $total = $valor_usuario * $usuarios;
            return $total;
        } 
           
        
        /**
         * Retorna o cliente pelo ID
         * @param type $cliente_id
         * @return boolean
         */
	public function get_cliente_by_id($cliente_id)
        {
            if($cliente_id == "" || empty($cliente_id) )
            {
                return FALSE;
            }
            $row = $this->db->get_where('tbl_clientes', array('id' => $cliente_id))->row();
            
            
            
            $this->load->model('cidades_model');
            $cidade_uf = $this->cidades_model->get_cidade_estado_nome_por_perfil_id($cliente_id);   
            
            if($cidade_uf !=  FALSE ){
                $row->cidade_nome = $cidade_uf->cidade;
                $row->estado_nome = $cidade_uf->sigla;            
            }          
         
            $dt_cad = explode('-', $row->data_cadastro);
            $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
            
            $row->data_cadastro = $data_cad;  
            
            /*
            if($row->celular == NULL || strlen($row->celular) == 0 ){
                $row->celular = "";
                $row->celular_ddd = "";
            }
             */          
            
            return $row;
        }  
        
        
        /**
         * Retorna o usuário pelo ID
         * @param type $usuario_id
         * @return boolean
         */
	public function get_usuario_by_id($usuario_id)
        {
            if($usuario_id == "" || empty($usuario_id) )
            {
                return FALSE;
            }
            $row = $this->db->get_where('tbl_usuarios', array('id' => $usuario_id))->row();
            
            
            $dt_cad = explode('-', $row->data_cadastro);
            $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
            $row->data_cadastro = $data_cad; 
            
            // converte a data de nascimento
            $dt = explode('-', $row->data_nascimento);
            $data = $dt[2].'/'.$dt[1].'/'.$dt[0];            
            $row->data_nascimento = $data;                                    
            
            /*
            if($row->celular == NULL || strlen($row->celular) == 0 ){
                $row->celular = "";
                $row->celular_ddd = "";
            }
             */          
            
            return $row;
        }          
        
        
        /**
         * 
         * @param type $email_user
         * @return int
         */
        
	public function get_usuario_id_by_email_or_usuario($email_user)
	{
		$this->db->where('email =', $email_user);
		$this->db->or_where('usuario', $email_user);	
                                
		$query = $this->db->get('tbl_usuarios');
	
		if ($query->num_rows() == 0) {
			return 0;
		}
		else
		{       
                        $row = $query->row();                        
			return $row->id;
		}
	}         
        
        /**
         * Retorna o usuário cadastrado
         * @param type $cliente_id
         * @return boolean 
         */
	public function get_first_cliente_usuario_by_id($cliente_id)
        {
            if($cliente_id == "" || empty($cliente_id) )
            {
                return FALSE;
            }
            $row = $this->db->get_where('tbl_usuarios', array('cliente_id' => $cliente_id))->row();
            
            
            $dt = explode('-', $row->data_nascimento);
            $data_nasc = $dt[2].'/'.$dt[1].'/'.$dt[0];
            
            $row->data_nascimento = $data_nasc;            
            
            $dt_cad = explode('-', $row->data_cadastro);
            $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
            
            $row->data_cadastro = $data_cad;                      
            
            return $row;
        }   
        
        
        /**
         * Retorna o ID do cliente de acordo com o ID do USUARIO
         * @param type $usuario_id
         * @return boolean
         */
	public function get_cliente_id_by_usuario_id($usuario_id)
        {
            if($usuario_id == "" || empty($usuario_id) )
            {
                return FALSE;
            }
            $query = $this->db->get_where('tbl_usuarios', array('id' => $usuario_id));                                
            
            if ($query->num_rows() == 0) {
                    return FALSE;
            }
            $row = $query->row();                                            
            return $row->cliente_id;
        } 
        
        
        /**
         * Retorna o nome do cliente
         * @param type $cliente
         * @return boolean
         */
	public function get_nome_cliente_by_cliente_id($cliente_id)
        {
            $this->db->select('id, nome_razao');
            $query = $this->db->get_where('tbl_clientes', array('id' => $cliente_id));                                
            
            if ($query->num_rows() == 0) {
                    return array();
            }
            $row = $query->row();                                            
            return $row->nome_razao;
        }           
 
        /**
         * Retorna o plano do CLIENTE pelo ID
         * @param type $cliente_id
         * @return boolean 
         */
	public function get_plano_by_cliente_id($cliente_id)
        {
            if($cliente_id == "" || empty($cliente_id) )
            {
                return FALSE;
            }
            $row = $this->db->get_where('tbl_clientes_planos', array('cliente_id' => $cliente_id))->row();                    
            
            return $row;
        }                   
              
        
        /**
         * Retorna o número total de usuários cadastrados
         * @param type $cliente_id
         * @return type
         */
	public function get_total_usuarios($cliente_id)
        {
            $query = $this->db->get_where('tbl_usuarios', array('cliente_id' => $cliente_id));                              
            return $query->num_rows();
        }                     
        
        
	public function get_total_usuarios_adm($cliente_id)
        {
            $query = $this->db->get_where('tbl_usuarios', array('cliente_id' => $cliente_id, 'chmod' => 'rwxrwxrwx'));                              
            return $query->num_rows();
        }         
        
        
	public function get_total_clientes_adm()
        {
            $query = $this->db->get_where('tbl_clientes');                              
            return $query->num_rows();
        }        
        
        /**
         * Retornar os usuários de um CLIENTE
         * @param type $cliente_id
         * @return boolean
         */
	public function get_usuarios_by_cliente_id($cliente_id)
	{                  
            $this->lang->load('common', $this->session->userdata('default_lang'));
            
            $this->db->where('cliente_id =', $cliente_id);
            $query = $this->db->get('tbl_usuarios');
            
            if ($query->num_rows() == 0) {
                    return array();
            }
            else 
            {
                $rows = $query->result();
                foreach ($rows as $key => $row)
                {
                    $dt_cad = explode('-', $row->data_cadastro);
                    $data_cad = $dt_cad[2].'/'.$dt_cad[1].'/'.$dt_cad[0];
                    $row->data_cadastro = $data_cad; 

                    // converte a data de nascimento
                    $dt = explode('-', $row->data_nascimento);
                    $data = $dt[2].'/'.$dt[1].'/'.$dt[0];            
                    $row->data_nascimento = $data;   
                    
                    // retorna o nome do grupo
                    $this->load->model('tipos_grupos_model');
                    if($row->grupo_id == null)
                        $grupo_id = 0;
                    else
                        $grupo_id = $row->grupo_id;
                    $row->grupo_nome = $this->tipos_grupos_model->get_grupo_nome_by_id($grupo_id);
                    
                    //retorna o tipo de chmod
                    if($row->chmod == 'rwxrwxrwx')
                        $row->chmod_nome = $this->lang->line('common_configuracoes_usuarios_label_tipo_usuario_administrador');
                    elseif($row->chmod == 'rwxrwxrrr')
                        $row->chmod_nome = $this->lang->line('common_configuracoes_usuarios_label_tipo_usuario_usuario_comum');
                    
                }


                return $rows;
                //return $query->result();
            }
	}        
        
        
        public function delete_usuario($cliente_id, $usuario_id)
        {   
            
            if($this->session->userdata('userid') == $usuario_id){
                return FALSE;
            }            
            elseif( $this->get_total_usuarios_adm($cliente_id) == 1){
                return FALSE;
            }
            
            
            $this->db->where('id', $usuario_id);
            $this->db->where('cliente_id', $cliente_id);
            $this->db->delete('tbl_usuarios');
            
            
            if($this->db->affected_rows() >0){        
                return TRUE;
            }
            else {
                return FALSE;
            }
        }        
        
        
        /**
         * Valida o login
         * @return boolean
         */
	public function check_validar_login(){
		
		$this->load->helper('email');
		
		// grab user input
		$username = $this->security->xss_clean($this->input->post('usuario'));
		$password = $this->security->xss_clean($this->input->post('senha'));

		
		// valida se digitou e-mail ou usuario
		if (valid_email($username))
		{
			$new_username = "";
			$new_email = $username;
		}
		else
		{
			$new_username = $username;
			$new_email = "";
		}

		// Prep the query
		//$this->db->where('usuario', $username);
		//$this->db->where('senha', MD5($password));
		
		$query_tbls = "SELECT usu.id, usu.cliente_id, usu.usuario, usu.senha, usu.email, usu.chmod, usu.grupo_id,
                                plano.id AS idplano, plano.cliente_id, plano.plano

				FROM `tbl_usuarios` usu
                                LEFT JOIN `tbl_clientes_planos` plano ON usu.cliente_id = plano.cliente_id
				WHERE (usu.usuario = ? 
				OR usu.email = ? ) 
				AND usu.senha = MD5(?)";
		
		$query = $this->db->query($query_tbls, array($new_username, $new_email, $password));
	
		// Run the query
		//$query = $this->db->get('tbl_usuarios');
		
		// Let's check if there are any results
		if($query->num_rows == 1)
		{
			// If there is a user, then create session data
			$row = $query->row();
			$data = array(
					'userid' => $row->id, //$this->session->userdata('userid')
					'usuario' => $row->usuario, 
                                        'grupoid' => $row->grupo_id, //$this->session->userdata('grupoid')
                                        'plano' => $row->plano, //$this->session->userdata('plano')
					'senha' => $row->senha,
                                        'email' => $row->email,
                                        'chmod' => $row->chmod,
					'validated' => true
			);
			$this->session->set_userdata($data);
			return true;
		}
		
		// Return FALSE se o TRUE acima falhar
		return false;
	}    
        
	/*
	 * @return 0 = sem duplicados | 1 = existe duplicados
	 * @
	 */
	public function check_login_duplicado()
	{
		$this->db->where('email =', $this->input->post('email'));
		$this->db->or_where('usuario', $this->input->post('usuario'));
	
		$query = $this->db->get('tbl_usuarios');
	
                // logins não permitidos
                $login_not = array("robot","search","admin","busca","erros", "merda", "5lobos.com", "pressduty", "pressdut", "pd", "presduty", "caralho", "tomarnocu", "filhodaputa", "viado", "gay", "putaquepariu", "fuder");
                if(in_array($this->input->post('usuario'), $login_not)) {
                    return 1;
                }
                
		if ($query->num_rows() == 0) {
			return 0;
		}
		else
		{
			return 1;
		}
	}   
        
        
        public function check_dados_preenchidos($cliente_id)
        {
            $this->db->select('c.id, c.cnpj_cpf, c.usuario, c.nome_razao, c.email, c.endereco, c.end_numero, c.end_bairro, c.end_cep, c.cidade_id');
            $this->db->from('tbl_clientes c');

            $this->db->where('c.id', $cliente_id);  
            
            $this->db->where('(c.cidade_id IS NULL');
            $this->db->or_where('c.cnpj_cpf IS NULL');
            $this->db->or_where('c.cnpj_cpf = "');
            $this->db->or_where('c.usuario IS NULL');
            $this->db->or_where('c.usuario = "');
            $this->db->or_where('c.nome_razao IS NULL');
            $this->db->or_where('c.nome_razao = ""');
            $this->db->or_where('c.endereco IS NULL');
            $this->db->or_where('c.endereco = ""');
            $this->db->or_where('c.end_numero IS NULL');
            $this->db->or_where('c.end_numero = ""');
            $this->db->or_where('c.end_cep IS NULL');
            $this->db->or_where('c.end_cep = ""');
            $this->db->or_where('c.end_bairro IS NULL)');
            
            $rows = $this->db->get();     

            if($rows->num_rows() > 0 ){
                return FALSE;
            }
            else {
                return TRUE;
            }
            
        }        
        
        

}