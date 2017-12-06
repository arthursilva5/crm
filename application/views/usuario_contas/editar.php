<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form_edit").validate({
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
	<h3 class="glyphicons building span8"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <form id="form_edit" name="form_edit" method="post" action="<?=base_url();?>i/accounts/edit_now">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_informacoes');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;">*<?=lang('common_label_nome_conta');?></label>
                                    <div class="controls"><input class="span12" id="conta_nome" name="conta_nome" type="text" value="<?=$rows_conta->conta_nome;?>" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_numero');?></label>
                                    <div class="controls"><input class="span12" id="conta_numero" name="conta_numero" type="text" value="<?=$rows_conta->conta_numero;?>" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_tipo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_conta" name="tipo_conta"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_contas_db as $tipos_contas_db_item) { 
                                                //confere o item
                                                if($tipos_contas_db_item->id == $rows_conta->tipo_conta_id)
                                                    $selected = "selected";
                                                else
                                                    $selected = "";
                                                echo '<option value="'.$tipos_contas_db_item->id.'" '.$selected.'>'.$tipos_contas_db_item->titulo.'</option>';                                               
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
                                                //confere o item
                                                if($tipos_industrias_db_item->id == $rows_conta->industria_id)
                                                    $selected = "selected";
                                                else
                                                    $selected = "";                                                
                                                
                                                echo '<option value="'.$tipos_industrias_db_item->id.'" '.$selected.'>'.$tipos_industrias_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div> 
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_receita_anual');?></label>
                                    <div class="controls">
                                        <input class="span4" id="receita_anual" name="receita_anual" type="text" value="<?=$rows_conta->receita_anual;?>" />
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_receita_anual_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>                            
                                                     
			
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_telefone');?></label>
                                    <div class="controls"><input class="span12" id="telefone" name="telefone" type="text" value="<?=$rows_conta->telefone;?>" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_site');?></label>
                                    <div class="controls"><input class="span12" id="site" name="site" type="text" value="<?=$rows_conta->site;?>" /></div>
                            </div>
                            
                            <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_grupo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="grupo" name="grupo" data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                //confere o item
                                                if($tipos_grupos_db_item->id == $rows_conta->grupo_id)
                                                    $selected = "selected";
                                                else
                                                    $selected = "";                                                
                                                echo '<option value="'.$tipos_grupos_db_item->id.'" '.$selected.'>'.$tipos_grupos_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>                            
                            <? } else echo '<input type="hidden"  id="grupo" name="grupo" value="'.$this->session->userdata('grupoid').'">'; // fim administrador ?>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_propriedade');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="compartilhar" name="compartilhar" data-style="btn-default">
                                                <option value="0">- <?=lang('common_label_nenhum');?> -</option>
                                                <option value="1" <? if($rows_conta->compartilhar == 1) echo " selected"; ?> ><?=lang('common_contas_propriedade_privado');?></option>
                                                <option value="2" <? if($rows_conta->compartilhar == 2) echo " selected"; ?> ><?=lang('common_contas_propriedade_grupo');?></option>
                                                <option value="3" <? if($rows_conta->compartilhar == 3) echo " selected"; ?> ><?=lang('common_contas_propriedade_publico');?></option>
                                        </select>
                                    </div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_funcionarios');?></label>
                                    <div class="controls"><input class="span3" id="funcionarios" name="funcionarios" type="text" value="<?=$rows_conta->funcionarios;?>" /></div>
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
                                    <div class="controls"><input class="span12" id="endereco" name="endereco" type="text" value="<?=$rows_conta->endereco;?>" /></div>
                            </div>   
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_cidade');?></label>
                                    <div class="controls"><input class="span12" id="cidade_nome" name="cidade_nome" type="text" value="<?=$rows_conta->cidade_nome;?>" /></div>
                            </div>                                                    
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_endereco_numero');?></label>
                                    <div class="controls"><input class="span4" id="end_numero" name="end_numero" type="text" value="<?=$rows_conta->end_numero;?>" /></div>
                            </div>  			 	
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_endereco_complemento');?></label>
                                    <div class="controls"><input class="span12" id="end_complemento" name="end_complemento" type="text" value="<?=$rows_conta->end_complemento;?>" /></div>
                            </div>  	                
                            
                           <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_cep');?></label>
                                    <div class="controls"><input class="span5" id="end_cep" name="end_cep" type="text" value="<?=$rows_conta->end_cep;?>" /></div>
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
                                    <div class="controls"><input class="span12" id="linkedin" name="linkedin" type="text" value="<?=$rows_conta->linkedin;?>" /></div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_facebook');?></label>
                                    <div class="controls"><input class="span12" id="facebook" name="facebook" type="text" value="<?=$rows_conta->facebook;?>" /></div>
                            </div>                            
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_twitter');?></label>
                                    <div class="controls"><input class="span12" id="twitter" name="twitter" type="text" value="<?=$rows_conta->twitter;?>" /></div>
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
                                    <div class="controls"><input class="span10" id="tags" name="tags" type="text" value="<?=$rows_conta->tags;?>" /><span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_meta_tags_ajuda');?>"><i></i></span></div>
                            </div> 
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_descricao');?></label>
                                    <div class="controls"><textarea rows="4" cols="50"  class="span12" id="descricao" name="descricao" /><?=$rows_conta->descricao;?></textarea></div>
                            </div>                                                       
	
			</div>
			</div>                    
                        <!-- fim GRUPO -->                        
                        <input type="hidden" name="conta_id" id="conta_id" value="<?=$rows_conta->id;?>" />
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_editar');?></button>
                        <a href="javascript:history.back(-1)" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>