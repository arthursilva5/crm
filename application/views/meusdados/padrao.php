<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
                
                $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });

                
                $.validator.addMethod(
                    "brasilDate",
                    function(value, element) {
                        // put your own logic here, this is just a (crappy) example
                        return value.match(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/);
                    }
                );

                $("#frm_dadoscadastrais_cliente").validate({
                    rules:{
                        cnpj_cpf: {
                            required:true, 
                            minlength: 6,
                            maxlength: 78
                        },
                        nome_razao: {
                            required:true
                        },                        
                        email: {
                            required:true,
                            email:true
                        },
                        telefone: {
                            required:true
                        },   
                        cidade: {
                            required:true
                        },                        
                        endereco: {
                            required:true
                        },
                        end_numero: {
                            required:true
                        },
                        end_bairro: {
                            required:true
                        },
                        end_cep: {
                            required:true
                        },                         
                     messages: {
                        cnpj_cpf: "<?=lang('pre_login_field_required');?>",
                        nome_razao: "<?=lang('pre_login_field_required');?>",
                        email: "<?=lang('pre_login_field_required');?>",
                        telefone: "<?=lang('pre_login_field_required');?>",
                        cidade: "<?=lang('pre_login_field_required');?>",
                        endereco: "<?=lang('pre_login_field_required');?>",
                        end_numero: "<?=lang('pre_login_field_required');?>",
                        end_bairro: "<?=lang('pre_login_field_required');?>",
                        end_cep: "<?=lang('pre_login_field_required');?>"
                        
                     }                        
                        
                    }       
                }); 
                
                
                $("#frm_dadoscadastrais_pessoal").validate({
                    rules:{
                        nome: {
                            required:true, 
                            minlength: 6,
                            maxlength: 78
                        },
                        data_nasc: {
                            required:true,
                            brasilDate:true
                        },                        
                        email: {
                            required:true, 
                            email:true
                        },
                      senha_antiga: {
                        minlength: 5,
                        maxlength: 32
                      },
                      senha_nova: {
                        minlength: 5,
                        maxlength: 32
                      },
                      senha_nova_confirma: {
                        equalTo: "#senha_nova"
                      }               
                        
                    },
                     messages: {
                        nome: "<?=lang('pre_login_field_required');?>",
                        sobrenome: "<?=lang('pre_login_field_required');?>",
                        data_nasc: {                            
                            brasilDate: "<?=lang('pre_login_field_date_format');?>"
                        },
                        senha: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_password_minimum_size');?>"
                        },
                        email: {
                            required: "<?=lang('pre_login_field_required');?>",
                            email: "<?=lang('pre_login_field_email_correct');?>"
                        },
                        senha_nova_confirma : {
                            equalTo: "<?=lang('common_meusdados_erro_senha');?>"
                        }
                     }
                });                
                

            });       
</script> 
<script type="text/javascript" src="<?=base_url(); ?>common/theme/js/uf_cidades.js"></script>
<script type="text/javascript">
    var path = '<?php echo base_url(); ?>'; // variavel para as cidades
</script> 

<div class="heading-buttons">
	<h3 class="glyphicons home"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">

<div class="separator bottom"></div>

<div class="widget widget-2 widget-tabs widget-tabs-2 tabs-right border-bottom-none">
	<div class="widget-head">
		<ul>
			<li class="active"><a class="glyphicons settings" href="#account-settings" data-toggle="tab"><i></i><?=lang('common_meusdados_titulo_detalhes_conta');?></a></li>
			<li><a class="glyphicons user" href="#account-details" data-toggle="tab"><i></i><?=lang('common_meusdados_titulo_detalhes_pessoais');?></a></li>
		</ul>
	</div>
</div>
	
	
	<div class="tab-content">
		<div class="tab-pane" id="account-details">
                    <form class="form-horizontal" id="frm_dadoscadastrais_pessoal" method="post" action="<?php echo base_url();?>i/myaccount/update_user">
			<div class="widget widget-2">
				<div class="widget-head">
					<h4 class="heading glyphicons edit"><i></i><?=lang('common_meusdados_titulo_detalhes_pessoais');?></h4>
				</div>
				<div class="widget-body" style="padding-bottom: 0;">
					<div class="row-fluid">
						<div class="span12">
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_usuario');?></label>
								<div class="controls">
									<input type="text" id="inputUsername" class="span10" value="<?=$usuario->usuario;?>" name="usuario" disabled="disabled" />
									<span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_usuario_ajuda');?>"><i></i></span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_nome');?></label>
								<div class="controls">
									<input type="text" value="<?=$usuario->nome;?>" name="nome" id="nome" class="span10" />									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_email');?></label>
								<div class="controls">
									<input type="text" value="<?=$usuario->email;?>" name="email" id="email" class="span10" />									
								</div>
							</div>                                                    
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_aniversario');?></label>
								<div class="controls">
									<div class="input-append">
										<input type="text" id="datepicker" name="data_nasc" class="span12" value="<?=$usuario->data_nascimento;?>" />
										<span class="add-on glyphicons calendar"><i></i></span>
                                                                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_aniversario_ajuda');?>"><i></i></span>
									</div>
								</div>
							</div>
                                                        <hr class="separator bottom" />
                                                        <div class="span12">
                                                                <strong><?=lang('common_meusdados_label_senha');?></strong>
                                                                <p class="muted"><?=lang('common_meusdados_label_senha_ajuda');?></p>                                                                
                                                        </div>    
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_senha_antiga');?></label>
								<div class="controls">
									<input type="password" value="" name="senha_antiga" id="senha_antiga" class="span10" placeholder="<?=lang('common_meusdados_label_senha_ajuda2');?>" />									
                                                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_senha_ajuda');?>"><i></i></span>
								</div>
							</div>                                                        
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_senha_nova');?></label>
								<div class="controls">
									<input type="password" value="" name="senha_nova" id="senha_nova" class="span10"  placeholder="<?=lang('common_meusdados_label_senha_ajuda2');?>" />									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?=lang('common_meusdados_label_senha_nova_confirme');?></label>
								<div class="controls">
									<input type="password" value="" name="senha_nova_confirma" id="senha_nova_confirma" class="span10"  placeholder="<?=lang('common_meusdados_label_senha_ajuda2');?>" />									
								</div>
							</div>                                                        
						</div>
					</div>
					<div class="form-actions" style="margin: 0;">
						<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar_alteracoes');?></button>
					</div>
				</div>
			</div>
                    </form>
		</div>
		<div class="tab-pane active" id="account-settings">
                    <form class="form-horizontal" id="frm_dadoscadastrais_cliente" method="post" action="<?php echo base_url();?>i/myaccount/update_client">
			<div class="widget widget-2">                            
				<div class="widget-head">
					<h4 class="heading glyphicons settings"><i></i><?=lang('common_meusdados_titulo_detalhes_conta');?></h4>
				</div>
				<div class="widget-body" style="padding-bottom: 0;">
			
					<hr class="separator bottom" />
					<div class="row-fluid">
						<div class="span3">
							<strong><?=lang('common_meusdados_label_detalhes_cliente');?></strong>
							<p class="muted"><?=lang('common_meusdados_label_detalhes_cliente_ajuda');?></p>
						</div>
						<div class="span9">
							<div class="row-fluid">
							<div class="span12">
                                                                <p><?=lang('common_meusdados_label_nao_sou_do_brasil');?></p>
                                                                
                                                                
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_cnpj_cpf');?></label>
                                                                        <div class="controls">
                                                                               <input type="text" id="cnpj_cpf" name="cnpj_cpf" class="span10" value="<?=$cliente->cnpj_cpf;?>" />
                                                                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_cnpj_cpf_ajuda');?>"><i></i></span>
                                                                        </div>
                                                                </div>                                                                  
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_nome_razao');?></label>
                                                                        <div class="controls">
                                                                               <input type="text" id="nome_razao" name="nome_razao" class="span10" value="<?=$cliente->nome_razao;?>" />                                                                
                                                                        </div>
                                                                </div> 
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_email');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                               <span class="add-on glyphicons e-mail"><i></i></span>
                                                                               <input type="text" id="email" name="email" class="input-large" value="<?=$cliente->email;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>    
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_telefone');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons phone"><i></i></span>
                                                                                <input type="text" id="telefone" name="telefone" class="input-large" value="<?=$cliente->telefone;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div> 
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_celular_responsavel');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons iphone"><i></i></span>
                                                                                <input type="text" id="celular" name="celular" class="input-large" value="<?=$cliente->celular;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>   
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_estado');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <select class="span12" name="uf" id="uf">
                                                                                    <option value=""><?=lang('common_meusdados_label_estado_escolha');?></option>
                                                                                    <? 
                                                                                    foreach($uf as $uf_item) {
                                                                                        echo '<option value="'.$uf_item->id.'">'.$uf_item->nome.'</option>';
                                                                                    } 
                                                                                    ?>                                                                                  
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                </div>   
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_city');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <?php echo form_dropdown('cidade', array('' => lang('common_meusdados_label_estado_escolha')), '','id="cidade" class="span12"' ); ?>
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                 
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco_escolhido');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">                                                                                
                                                                                <p><? if(!empty($local_atual)) echo $local_atual->cidade.' / '.$local_atual->sigla;?></p>
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                 
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons building"><i></i></span>
                                                                                <input type="text" class="input-large" id="endereco" name="endereco" value="<?=$cliente->endereco;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>   
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco_number');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons building"><i></i></span>
                                                                                <input type="text" class="input-small" id="end_numero" name="end_numero" value="<?=$cliente->end_numero;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                 
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco_complemento');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons building"><i></i></span>
                                                                                <input type="text" class="input-large" id="end_complemento" name="end_complemento" value="<?=$cliente->end_complemento;?>" />
                                                                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_endereco_complemento_ajuda');?>"><i></i></span>
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                  
                                                                
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco_bairro');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons building"><i></i></span>
                                                                                <input type="text" class="input-large" id="end_bairro" name="end_bairro" value="<?=$cliente->end_bairro;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                 
                                                                                                     
                                                                <div class="control-group">
                                                                        <label class="control-label"><?=lang('common_meusdados_label_endereco_cep');?></label>
                                                                        <div class="controls">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on glyphicons building"><i></i></span>
                                                                                <input type="text" class="input-small" id="end_cep" name="end_cep" value="<?=$cliente->end_cep;?>" />
                                                                            </div>
                                                                        </div>
                                                                </div>                                                                 					                                                                
						   
							</div>
							
							</div>
						</div>
					</div>
					<div class="form-actions" style="margin: 0; padding-right: 0;">
						<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok pull-right"><i></i><?=lang('common_label_salvar_alteracoes');?></button>
					</div>
                                        <p><?=lang('common_meusdados_cancelar_contate');?> </p><br />
				</div>
                            
                            
			</div>
			</form>
		</div>
	</div>
	
	
		

</div>
<br/>		

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>
