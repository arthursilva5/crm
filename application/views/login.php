<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form-signin").validate({
                    rules:{                       
                        senha: {
                            required:true, 
                            minlength: 6
                        },                                                 
                        usuario : {
                            required:true, 
                            minlength: 4,
                            maxlength: 45
                        }                     
                        
                    },
                     messages: {      
                        senha: {
                            required: "<?=lang('pre_login_field_required');?>"
                        },
             
                        usuario: {
                            required: "<?=lang('pre_login_field_required');?>"                            
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
                <div id="login">
                    <form class="form-signin" id="form-signin" name="form-signin" method="post"  autocomplete="off" action="<?php echo base_url();?>i/login/signin">
                            <div class="widget widget-4">
                                    <div class="widget-head">
                                            <h4 class="heading"><?=lang('pre_login_titulo_restrito');?></h4>
                                    </div>
                            </div>
                            <h2 class="glyphicons unlock form-signin-heading"><i></i> <?=lang('pre_login_titulo_formulario');?></h2>
                            <div>
                                <div class="control-group">
                                    <div class="controls"><input type="text" name="usuario" class="input-block-level" placeholder="<?=lang('pre_login_label_email_ou_usuario');?>"> </div>
                                </div>
                                <div class="control-group">    
                                    <div class="controls"><input type="password" name="senha" class="input-block-level" placeholder="<?=lang('pre_login_label_password');?>"> </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-large btn-primary"><?=lang('pre_login_entrar');?></button> <span class="pull-right"><a href="<?=base_url(); ?>pricing"><?=lang('pre_login_label_experimente');?></a></span>
                            <br />
                            <span class="pull-left"><a href="<?=base_url(); ?>i/redefinir_senha"><?=lang('pre_login_label_password_esqueci');?></a></span>
                    </form>
                </div>
            
	</div>
	<div class="separator bottom"></div>
	
	
</div>		


<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>