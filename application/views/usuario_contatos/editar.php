<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){  
            
                $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" }); 

                $("#form_edit").validate({
                    rules:{                       
                        contato_nome: {
                            required:true,
                            maxlength: 179
                        },
                        email: {
                            email:true
                        },
                        email_secundario: {
                            email:true
                        }                         
                    },
                     messages: {      
                        contato_nome: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        },
                        email: {
                            email: "<?=lang('pre_login_field_email_correct');?>"
                        },
                        email_secundario: {
                            email: "<?=lang('pre_login_field_email_correct');?>"
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
    
    <form id="form_edit" name="form_edit" method="post" action="<?=base_url();?>i/contacts/edit_now">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contatos_informacao');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;">*<?=lang('common_label_nome');?></label>
                                    <div class="controls"><input class="span12" id="contato_nome" name="contato_nome" type="text" value="<?=$rows->nome;?>" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contatos_label_cargo');?></label>
                                    <div class="controls"><input class="span12" id="cargo" name="cargo" type="text" value="<?=$rows->cargo;?>" /></div>
                            </div>
                       
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_telefone');?></label>
                                    <div class="controls"><input class="span12" id="telefone" name="telefone" type="text" value="<?=$rows->telefone;?>" /></div>
                            </div>                               
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_celular');?></label>
                                    <div class="controls"><input class="span12" id="celular" name="celular" type="text" value="<?=$rows->celular;?>" /></div>
                            </div>   
                            
                            <div class="control-group input-append">
                                <label class="control-label"><?=lang('common_label_aniversario');?></label>
                                <input type="text" id="datepicker" name="data_nasc" class="span6" placeholder="<?=lang('common_meusdados_label_aniversario');?>" value="<?=$rows->data_nascimento;?>" /> 
                                <span class="add-on glyphicons calendar"><i></i></span>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_aniversario_ajuda');?>"><i></i></span>                                                            
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_receber_newsletter');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="enviar_newsletter" name="enviar_newsletter" data-style="btn-default">
                                                <option value="">- <?=lang('common_label_nenhum');?> -</option>
                                                <option value="1" <? if($rows->enviar_newsletter == 1) echo " selected"; ?> ><?=lang('common_label_sim');?></option>
                                                <option value="0" <? if($rows->enviar_newsletter == 2) echo " selected"; ?> ><?=lang('common_label_nao');?></option>
                                        </select>
                                    </div>
                            </div>                              
			
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_conta');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="conta_id" name="conta_id"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($nomes_contas_db as $nomes_contas_db_item) {
                                                //confere o item
                                                if($nomes_contas_db_item->id == $rows->conta_id)
                                                    $selected = "selected";
                                                else
                                                    $selected = "";                                                
                                                echo '<option value="'.$nomes_contas_db_item->id.'" '.$selected.'>'.$nomes_contas_db_item->conta_nome.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_email');?></label>
                                    <div class="controls"><input class="span12" id="email" name="email" type="text" value="<?=$rows->email;?>" /></div>
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_email_secundario');?></label>
                                    <div class="controls"><input class="span12" id="email_secundario" name="email_secundario" type="text" value="<?=$rows->email_secundario;?>" /></div>
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_telefone_secundario');?></label>
                                    <div class="controls"><input class="span12" id="telefone_outro" name="telefone_outro" type="text" value="<?=$rows->telefone_outro;?>" /></div>
                            </div>                             

                            <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_grupo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="grupo" name="grupo" data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                if($tipos_grupos_db_item->id == $rows->grupo_id)
                                                    $selected = "selected";
                                                else
                                                    $selected = "";                                                
                                                echo '<option value="'.$tipos_grupos_db_item->id.'" '.$selected.'>'.$tipos_grupos_db_item->titulo.'</option>';                                               
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
                                                <option value="1" <? if($rows->compartilhar == 1) echo " selected"; ?> ><?=lang('common_contas_propriedade_privado');?></option>
                                                <option value="2" <? if($rows->compartilhar == 2) echo " selected"; ?> ><?=lang('common_contas_propriedade_grupo');?></option>
                                                <option value="3" <? if($rows->compartilhar == 3) echo " selected"; ?> ><?=lang('common_contas_propriedade_publico');?></option>
                                        </select>
                                    </div>
                            </div>                         				
			
			</div>
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_descricao');?></label>
                                    <div class="controls"><textarea rows="4" cols="50"  class="span12" id="descricao" name="descricao" /><?=$rows->descricao;?></textarea></div>
                            </div>                             
			</div>
                     
                        <br />
                        <input type="hidden" name="contato_id" id="contato_id" value="<?=$rows->contato_id;?>" />
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar');?></button>
                        <a href="<?=base_url();?>i/contacts" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>