<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){  
            
                $("#form_contact").validate({
                    rules:{                       
                        nome: {
                            required:true
                        },
                        email: {
                            required: true
                        },                        
                        mensagem: {
                            required:true
                        }                       
                        
                    },
                     messages: {      
                        nome: {
                            required: "<?=lang('common_form_campo_requerido');?>"                            
                        },
                        email: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },                        
                        mensagem: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }                         
                        
                     }
                });     
        
            });
            
</script>

<div id="landing_1">
	<div class="separator-line margin-none"></div>
	<div class="mosaic-line mosaic-line-2">
		<div class="container-960 center">
			<h2 class="margin-none"><strong class="text-primary"><?=lang('pre_login_titulo_1');?></strong> <?=lang('pre_login_titulo_2');?> <span class="hidden-phone"><?=lang('pre_login_titulo_3');?></span></h2>
		</div>
	</div>
	
	
	
	
	<div class="container-960 innerTB">
		<div class="separator bottom"></div>
		<div class="row-fluid">
			<div class="span7">
				<h3 class="glyphicons google_maps"><i></i><?=lang('pre_login_titulo_contato');?></h3>
				<form class="row-fluid margin-none" id="form_contact" name="form_contact" method="post" action="<?php echo base_url();?>i/padrao/contact_send">
					<div class="span6">
						<input type="text" class="span12" name="nome" id="nome" placeholder="<?=lang('common_meusdados_label_nome');?>">
					</div>
					<div class="span6"> 
						<input type="text" class="span12" name="email" id="email" placeholder="<?=lang('common_label_email');?>">
					</div>
					<textarea name="mensagem" id="mensagem" class="span12" rows="5" placeholder="<?=lang('common_label_mensagem');?>"></textarea>
					<div class="right">
						<button class="btn btn-primary btn-icon glyphicons envelope"><i></i> <?=lang('pre_login_titulo_contato_enviar_mensagem');?></button>
					</div>
				</form>
			</div>
			<div class="span5">
				<div class="well margin-none">
					<address class="margin-none">
						<h2><?=lang('common_label_sitemap_principal');?></h2>						
						<abbr title="<?=lang('common_label_email');?>"><?=lang('common_label_email');?>:</abbr> <a href="mailto:<?=lang('common_fatura_informacoes_empresa_email');?>"><?=lang('common_fatura_informacoes_empresa_email');?></a><br /> 			
						<div class="separator line"></div>
						<p class="margin-none"><strong><?=lang('pre_login_titulo_contato_tambem_encontra');?>:</strong><br/>
                                                
                                                    <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F5lobos&amp;width=290&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=true&amp;appId=249547925078894" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:290px; height:290px;" allowTransparency="true"></iframe>                                                    
                                                    
                                                </p>
					</address>
				</div>
			</div>
		</div>
	</div>
	
	<div class="separator bottom"></div>
	<div class="separator-line margin-none"></div>

	
</div>		


<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	