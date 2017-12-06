<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form_edit").validate({
                    rules:{                                                        
                        lead_notificar: {
                            required:true
                        },
                        email_adm_cadastros_notificar: {
                            required:true
                        },                        
                        lead_fechar_dia_antes: {
                            required:true,
                            number: true
                        },
                        lead_fechar_dia_depois: {
                            required:true,
                            number: true
                        }                         
                    },
                     messages: {      
                        lead_notificar: {
                            required: "<?=lang('common_form_campo_requerido');?>"                            
                        },
                        email_adm_cadastros_notificar: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        lead_fechar_dia_antes: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            number: "<?=lang('common_form_campo_numerico');?>"
                        },
                        lead_fechar_dia_depois: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            number: "<?=lang('common_form_campo_numerico');?>"
                        }                           
                     }
                });                 

            });
            
</script>


<div class="heading-buttons">
	<h3 class="glyphicons alarm"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <form id="form_edit" name="form_edit" method="post" action="<?=base_url();?>i/config/notifications_edit">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_notificacoes_titulo');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span9">
			
			
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_configuracoes_notificacoes_lead_ativar');?></label>
                                    <div class="controls">
                                    
                                    <label>
                                            <input type="radio" class="radio" name="lead_notificar" id="lead_notificar" value="1" <? if($rows->lead_notificar == 1) echo 'checked'; ?> />
                                            <?=lang('common_label_sim');?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="radio" name="lead_notificar" id="lead_notificar" value="0" <? if($rows->lead_notificar == 0) echo 'checked'; ?> />
                                            <?=lang('common_label_nao');?>
                                    </label><br/>                                   
                                    </div>
                                    
                            </div>


                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_notificacoes_lead_dias_antes');?></label>
                                    <div class="controls">
                                        <input class="span3" id="lead_fechar_dia_antes" name="lead_fechar_dia_antes" type="text" value="<?=$rows->lead_fechar_dia_antes;?>" />
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_notificacoes_lead_dias_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_notificacoes_lead_dias_depois');?></label>
                                    <div class="controls">
                                        <input class="span3" id="lead_fechar_dia_depois" name="lead_fechar_dia_depois" type="text" value="<?=$rows->lead_fechar_dia_depois;?>" />
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_notificacoes_lead_dias_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>                                                     
       
			</div>
			
			</div>
                    
                    
                        <!-- general -->
                    
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_notificacoes_gerais');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span9">
			
			
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_configuracoes_notificacoes_email_cadastros_ativar');?></label>
                                    <div class="controls">
                                    
                                    <label>
                                            <input type="radio" class="radio" name="email_adm_cadastros_notificar" id="email_adm_cadastros_notificar" value="1" <? if($rows->email_adm_cadastros_notificar == 1) echo 'checked'; ?> />
                                            <?=lang('common_label_sim');?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="radio" name="email_adm_cadastros_notificar" id="email_adm_cadastros_notificar" value="0" <? if($rows->email_adm_cadastros_notificar == 0) echo 'checked'; ?> />
                                            <?=lang('common_label_nao');?>
                                    </label><br/>                                    
                                    </div>
                                    
                            </div>

			</div>
			
			</div>                    
                   
                        <br />
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar');?></button>
                        <a href="javascript:history.back(-1)" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>
