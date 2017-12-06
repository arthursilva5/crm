<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){  
            
                $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" }); 

                $("#form_add").validate({
                    rules:{                       
                        nome_potencial: {
                            required:true,
                            maxlength: 179
                        },
                        valor: {
                            number: true
                        },                        
                        data_expectativa_fechar: {
                            required:true
                        },
                        tipo_estagio_venda: {
                            required:true
                        },
                        conta_id: {
                            required:true
                        }                        
                        
                    },
                     messages: {      
                        nome_potencial: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        },
                        valor: {
                            number: "<?=lang('common_form_campo_numerico');?>"
                        },                        
                        data_expectativa_fechar: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        tipo_estagio_venda: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        conta_id: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }                         
                        
                     }
                });     
        
            });
            
</script>

<div class="heading-buttons">
	<h3 class="glyphicons coins"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <form id="form_add" name="form_add" method="post" action="<?=base_url();?>i/potentials/add_now">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_oportunidades_informacao');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;">*<?=lang('common_oportunidades_nome_oportunidade');?></label>
                                    <div class="controls"><input class="span12" id="nome_potencial" name="nome_potencial" type="text" /></div>
                            </div>

                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;"><?=lang('common_label_conta');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="conta_id" name="conta_id"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($nomes_contas_db as $nomes_contas_db_item) { 
                                                echo '<option value="'.$nomes_contas_db_item->id.'">'.$nomes_contas_db_item->conta_nome.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>  
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_tipo');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_negocio" name="tipo_negocio"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_negocio_db as $tipos_negocio_db_item) { 
                                                echo '<option value="'.$tipos_negocio_db_item->id.'">'.$tipos_negocio_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>                             

                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_oportunidades_proximo_passo');?></label>
                                    <div class="controls"><input class="span12" id="proximo_passo" name="proximo_passo" type="text" /></div>
                            </div>
                       
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_oportunidades_fonte_contato');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_fonte" name="tipo_fonte"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_fontes_contato_db as $tipos_fontes_contato_db_item) { 
                                                echo '<option value="'.$tipos_fontes_contato_db_item->id.'">'.$tipos_fontes_contato_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>                               
                                              
			
			</div>
			<div class="span6">
			
                            <div class="control-group input-append">
                                <label class="control-label"><?=lang('common_label_quantia');?></label>
                                <input type="text" id="valor" name="valor" class="span6" value="" /> 
                                <span class="add-on glyphicons calculator"><i></i></span>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_oportunidades_quantia_ajuda');?>"><i></i></span>
                            </div>  
                            
                            <div class="control-group input-append">
                                <label class="control-label" style="color: #710909;">* <?=lang('common_oportunidades_data_fechamento');?></label>
                                <input type="text" id="datepicker" name="data_expectativa_fechar" class="span6" value="" /> 
                                <span class="add-on glyphicons calendar"><i></i></span>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_oportunidades_data_fechamento_ajuda');?>"><i></i></span>                                                            
                            </div>                              
                            
                            <div class="control-group">
                                    <label class="control-label" style="color: #710909;"><?=lang('common_label_etapa');?></label>
                                    <div class="controls">
                                        <select class="selectpicker span10" id="tipo_estagio_venda" name="tipo_estagio_venda"  data-style="btn-default">
                                            <option value="0">- <?=lang('common_label_nenhum');?> - </option>
                                            <? foreach($tipos_estagio_venda_db as $tipos_estagio_venda_db_item) { 
                                                echo '<option value="'.$tipos_estagio_venda_db_item->id.'">'.$tipos_estagio_venda_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                        </select>
                                    </div>
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
			
			</div>   
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_contas_descricao');?></label>
                                    <div class="controls"><textarea rows="4" cols="50"  class="span12" id="descricao" name="descricao" /></textarea></div>
                            </div>                             
			</div>
                     
                        <br />

                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar');?></button>
                        <a href="<?=base_url();?>i/potentials" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>