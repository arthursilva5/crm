<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){  
            
            
            
            $('#btn_envia_teste').on('click', function(e){
              e.preventDefault();
              $.post("<?=base_url();?>i/config/ajax_email_server_test", { email_para: "<?=$this->session->userdata('email');?>" }).always(function(data) {                  
                  
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
                    bootbox.alert("<?=lang('common_newsletter_email_erro_nao_enviado');?>", function() 
                    {
                            $.gritter.add({
                                    title: '<?=lang('common_newsletter_email_erro_nao_enviado');?>',
                                    text: "<?=lang('common_newsletter_email_erro_nao_enviado');?>"
                            });
                    });                
                }
                
                                    
              });                        
            }); // btn fim
            
            

                $("#form_edit").validate({
                    rules:{                                                        
                        smtp_host: {
                            required:true
                        },
                        smtp_porta: {
                            required:true,
                            number: true
                        },                        
                        usar_ssl: {
                            required:true
                        },
                        usuario_email: {
                            required:true
                        },
                        senha_email: {
                            required:true
                        }                          
                    },
                     messages: {      
                        smtp_host: {
                            required: "<?=lang('common_form_campo_requerido');?>"                            
                        },
                        smtp_porta: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            number: "<?=lang('common_form_campo_numerico');?>"
                        },
                        usar_ssl: {
                            required: "<?=lang('common_form_campo_requerido');?>"                            
                        },
                        usuario_email: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }, 
                        senha_email: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }                         
                     }
                });                 

            });
            
</script>


<div class="heading-buttons">
	<h3 class="glyphicons e-mail"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <form id="form_edit" name="form_edit" method="post" action="<?=base_url();?>i/config/email_server_edit">
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_label_configuracao');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span9">		

                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_servidor_email_servidor_smtp');?></label>
                                    <div class="controls">
                                        <input class="span5" id="smtp_host" name="smtp_host" type="text" value="<?=$rows->smtp_host;?>" />                                        
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_servidor_email_porta');?></label>
                                    <div class="controls">
                                        <input class="span2" id="smtp_porta" name="smtp_porta" type="text" value="<?=$rows->smtp_porta;?>" />                                        
                                    </div>
                                    
                            </div>                            
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_configuracoes_servidor_email_usar_ssl');?></label>
                                    <div class="controls">
                                    
                                    <label>
                                            <input type="radio" class="radio" name="usar_ssl" id="usar_ssl" value="1" <? if($rows->usar_ssl == 1) echo 'checked'; ?> />
                                            <?=lang('common_label_sim');?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="radio" name="usar_ssl" id="usar_ssl" value="0" <? if($rows->usar_ssl == 0) echo 'checked'; ?> />
                                            <?=lang('common_label_nao');?>
                                    </label><br/>                                   
                                    </div>
                                    
                            </div>                            
                            
                             
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_servidor_email_login_email');?></label>
                                    <div class="controls">
                                        <input class="span5" id="usuario_email" name="usuario_email" type="text" value="<?=$rows->usuario_email;?>" />                                        
                                    </div>
                                    
                            </div>
                            
                            <div class="control-group">
                                    <label class="control-label"><?=lang('common_configuracoes_servidor_email_senha');?></label>
                                    <div class="controls">
                                        <input class="span5" id="senha_email" name="senha_email" type="password" value="<?=$rows->senha_email;?>" />                                        
                                    </div>
                                    
                            </div>                             
       
			</div>
			
			</div>                  
                   
                        <br />                        
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_label_salvar');?></button>                       
                        <a href="#" id="btn_envia_teste" class="btn btn-icon btn-info glyphicons e-mail"><i></i><?=lang('common_configuracoes_servidor_email_testar_email');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>
