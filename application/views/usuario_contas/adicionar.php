<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form_add").validate({
                    rules:{                       
                        conta_nome: {
                            required:true,
                            maxlength: 179
                        },
                        receita_anual: {
                            number: true
                        },
                        conta_numero: {
                            number: true
                        },
                        funcionarios: {
                            number: true
                        }                         
                    },
                     messages: {      
                        conta_nome: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        },
                        receita_anual: {
                            number: "<?=lang('common_form_campo_numerico');?>"
                        },
                        conta_numero: {
                            number: "<?=lang('common_form_campo_numerico');?>"
                        },
                        funcionarios: {
                            number: "<?=lang('common_form_campo_numerico');?>"
                        }
                        
                     }
                });     
        
            });
            
</script>

<div class="heading-buttons">
	<h3 class="glyphicons building"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <form id="form_add" name="form_add" method="post" action="<?=base_url();?>i/accounts/add_now">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_informacoes');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;">*<?=lang('common_label_nome_conta');?></label>
                                    <div class="controls"><input class="span12" id="conta_nome" name="conta_nome" type="text" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_numero');?></label>
                                    <div class="controls"><input class="span12" id="conta_numero" name="conta_numero" type="text" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_tipo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_conta" name="tipo_conta"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_contas_db as $tipos_contas_db_item) { 
                                                echo '<option value="'.$tipos_contas_db_item->id.'">'.$tipos_contas_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_industria');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_industria" name="tipo_industria"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_industrias_db as $tipos_industrias_db_item) { 
                                                echo '<option value="'.$tipos_industrias_db_item->id.'">'.$tipos_industrias_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div> 
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_receita_anual');?></label>
                                    <div class="controls">
                                        <input class="span4" id="receita_anual" name="receita_anual" type="text" />
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_receita_anual_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>                            
                                                     
			
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_telefone');?></label>
                                    <div class="controls"><input class="span12" id="telefone" name="telefone" type="text" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_site');?></label>
                                    <div class="controls"><input class="span12" id="site" name="site" type="text" /></div>
                            </div>
                            
                            <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_grupo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="grupo" name="grupo" data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                echo '<option value="'.$tipos_grupos_db_item->id.'">'.$tipos_grupos_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>                            
                            <? } else echo '<input type="hidden"  id="grupo" name="grupo" value="'.$this->session->userdata('grupoid').'">'; ?>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_propriedade');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="compartilhar" name="compartilhar" data-style="btn-default">
                                                <option value="0">- <?=lang('common_label_nenhum');?> -</option>
                                                <option value="1"><?=lang('common_contas_propriedade_privado');?></option>
                                                <option value="2"><?=lang('common_contas_propriedade_grupo');?></option>
                                                <option value="3"><?=lang('common_contas_propriedade_publico');?></option>
                                        </select>
                                    </div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_funcionarios');?></label>
                                    <div class="controls"><input class="span3" id="funcionarios" name="funcionarios" type="text" /></div>
                            </div>                           				
			
			</div>
			</div>
                   
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_informacao_endereco');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span6">			

                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_endereco');?></label>
                                    <div class="controls"><input class="span12" id="endereco" name="endereco" type="text" /></div>
                            </div>   
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_cidade');?></label>
                                    <div class="controls"><input class="span12" id="cidade_nome" name="cidade_nome" type="text" /></div>
                            </div>                                                    
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_endereco_numero');?></label>
                                    <div class="controls"><input class="span4" id="end_numero" name="end_numero" type="text" /></div>
                            </div>  			 	
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_endereco_complemento');?></label>
                                    <div class="controls"><input class="span12" id="end_complemento" name="end_complemento" type="text" /></div>
                            </div>  	                
                            
                           <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_cep');?></label>
                                    <div class="controls"><input class="span5" id="end_cep" name="end_cep" type="text" /></div>
                            </div>                             
                            
			</div>
			</div>                    
                        <!-- fim GRUPO -->                    
                    
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_midia_social');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span6">			

                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_linkedin');?></label>
                                    <div class="controls"><input class="span12" id="linkedin" name="linkedin" type="text" /></div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_facebook');?></label>
                                    <div class="controls"><input class="span12" id="facebook" name="facebook" type="text" /></div>
                            </div>                            
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_twitter');?></label>
                                    <div class="controls"><input class="span12" id="twitter" name="twitter" type="text" /></div>
                            </div>  			
			
			</div>
			</div>                    
                        <!-- fim GRUPO -->
                        
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_descricao_meta_tags');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span12">			

                            <div class="control-group">
                                    <label class="control-label">
                                        <?=lang('common_contas_meta_tags');?>
                                        
                                    </label>
                                    <div class="controls"><input class="span10" id="tags" name="tags" type="text" /><span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_meta_tags_ajuda');?>"><i></i></span></div>
                            </div> 
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_descricao');?></label>
                                    <div class="controls"><textarea rows="4" cols="50"  class="span12" id="descricao" name="descricao" /></textarea></div>
                            </div>                                                       
	
			</div>
			</div>                    
                        <!-- fim GRUPO -->                        

                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar');?></button>
                        <a href="<?=base_url();?>i/accounts" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>