<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
            
            
            $('#btn_envia_teste').on('click', function(e){
              e.preventDefault();
              
              if($("#form_news").valid()){ // valida o formulário
                $('#loading_message').show();  //abre tela carregando
                 
                for ( instance in CKEDITOR.instances )
                    CKEDITOR.instances[instance].updateElement();

              $.post("<?=base_url();?>i/newsletter/ajax_send_email_test", $("#form_news").serialize()).always(function(data) {                  
                  
                if(data.erro == 0) {
                    bootbox.alert("<?=lang('common_newsletter_email_enviado');?>", function() 
                    {
                            $.gritter.add({
                                    title: '<?=lang('common_newsletter_enviar_email_teste');?>',
                                    text: "<?=lang('common_newsletter_email_enviado');?>"
                            });
                    });
                }
                else {
                    bootbox.alert("<?=lang('common_newsletter_email_erro_nao_enviado_teste');?>", function() 
                    {
                            $.gritter.add({
                                    title: '<?=lang('common_newsletter_email_erro_nao_enviado_teste');?>',
                                    text: "<?=lang('common_newsletter_email_erro_nao_enviado_teste');?>"
                            });
                    });                
                }
                $('#loading_message').hide(); //fecha tela carregando
              }); // always
              }// fim do if
            }); // btn fim 
            

            $('#btn_salva_email').on('click', function(e){
              e.preventDefault();
              
              if($("#form_news").valid()){ // valida o formulário
                $('#saving_message').show();  //abre tela carregando
                 
                for ( instance in CKEDITOR.instances )
                    CKEDITOR.instances[instance].updateElement();

              $.post("<?=base_url();?>i/config/ajax_email_birthday_edit", $("#form_news").serialize()).always(function(data) {                  
                  
                if(data.erro == 1) {
                    bootbox.alert("<?=lang('common_configuracoes_aniversario_email_erro_campos');?>", function() 
                    {
                            $.gritter.add({
                                    title: '<?=lang('common_configuracoes_aniversario_email_erro_campos');?>',
                                    text: "<?=lang('common_configuracoes_aniversario_email_erro_campos');?>"
                            });
                    });
                }
                else {
                    bootbox.alert("<?=lang('common_configuracoes_aniversario_email_salvo');?>", function() 
                    {
                            $.gritter.add({
                                    title: '<?=lang('common_configuracoes_aniversario_email_salvo');?>',
                                    text: "<?=lang('common_configuracoes_aniversario_email_salvo');?>"
                            });
                    });                
                }
                $('#saving_message').hide(); //fecha tela carregando
              }); // always
              }// fim do if
            }); // btn fim envia email
            
            

                $("#form_news").validate({
                    rules:{                                                        
                        nome_email: {
                            required:true
                        },                        
                        editor1: {
                            required:true
                        },
                        status: {
                            required:true
                        },
                        assunto_email: {
                            required:true
                        }                          
                    },
                     messages: {      
                        nome_email: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        editor1: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        status: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        assunto_email: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }                            
                     }
                }); // fim validade
      

            }); // fim ready
            
            
            
</script>
<script src="<?=base_url(); ?>common/theme/scripts/plugins/ckeditor/ckeditor.js"></script>

<div class="heading-buttons">
	<h3 class="glyphicons birthday_cake"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
                <form id="form_news" name="form_news" method="post" action="<?=base_url();?>">
		<div class="widget-body" style="padding: 10px 0 0;">

			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_aniversario_email_configure');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
                        
			<div class="row-fluid">
                           
			<div class="span12">
			
                            <h5><?=lang('common_newsletter_configurar');?></h5>
                                
                            <hr />
                            
                            
                            <div class="control-group">  
                            <label>
                                    <?=lang('common_label_ativar');?><br />
                                    <input type="radio" class="radio" name="status" id="status" value="1" <? if(!empty($rows)) { if($rows->status == 1) echo 'checked'; }?> />
                                    <?=lang('common_label_sim');?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" class="radio" name="status" id="status" value="0" <? if(!empty($rows)) { if($rows->status != 1) echo 'checked'; }?> />
                                    <?=lang('common_label_nao');?>
                            </label><br/>                             
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_newsletter_nome_para_aparecer');?></label>
                                    <div class="controls">
                                        <input class="span3" id="nome_email" name="nome_email" type="text" value="<? if(!empty($rows)) echo $rows->nome_email;?>" />                                         
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_label_mensagem');?></label>
                                    <div class="controls">
                                    <br />
                                    <label>
                                        <textarea name="editor1"><? if(!empty($rows)) echo $rows->mensagem;?></textarea>
                                    </label>                                 
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_newsletter_assunto');?></label>
                                    <div class="controls">
                                        <input class="span3" id="assunto_email" name="assunto_email" type="text" value="<? if(!empty($rows)) echo $rows->assunto_email;?>" />                                         
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_newsletter_enviar_email_teste');?></label>
                                    <div class="controls">
                                        <input class="span3" id="email_para" name="email_para" type="text" value="" />
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_newsletter_teste_este_email_ajuda');?>"><i></i></span>
                                    </div>                                   
                            </div>                             
                                                 
       
			</div>
			
			</div>
                        <br />
                        <a href="#modal-email-teste" id="btn_envia_teste" class="btn btn-icon btn-info glyphicons e-mail"><i></i><?=lang('common_newsletter_enviar_email_teste_agora');?></a>
                        <button type="submit" id="btn_salva_email" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar_alteracoes');?></button>                                                   
                        <div id='loading_message' class="pull-right" style='display:none; margin-right:20%; '>
                            <img src="<?=base_url(); ?>common/theme/images/icons/ajax-loader.gif"/> <?=lang('common_newsletter_email_enviando_emails');?>
                        </div>
                        <div id='saving_message' class="pull-right" style='display:none; margin-right:20%; '>
                            <img src="<?=base_url(); ?>common/theme/images/icons/ajax-loader.gif"/> <?=lang('common_label_salvando');?>
                        </div>                        
                        <br /><br />                        
		</div>	
                </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>




<script>
        CKEDITOR.replace( 'editor1' );
</script>



