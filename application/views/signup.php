
<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           


                $.validator.addMethod(
                    "brasilDate",
                    function(value, element) {
                        // put your own logic here, this is just a (crappy) example
                        return value.match(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/);
                    }
                );

                $("#frm_signup").validate({
                    rules:{
                        nome: {
                            required:true, 
                            minlength: 2,
                            maxlength: 45
                        },
                        sobrenome: {
                            required:true
                        },
                        data_nasc: {
                            required:true,
                            brasilDate:true
                        },                        
                        email: {
                            required:true, 
                            email:true
                        },
                        senha: {
                            required:true, 
                            minlength: 6
                        },   
                        usuario_quantidade : {
                            required:true,
                            number: true
                        },                        
                        usuario : {
                            required:true, 
                            minlength: 4,
                            maxlength: 45
                        },
                        nome_razao : {
                            required:true, 
                            minlength: 3
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
                        usuario_quantidade: {
                            required: "<?=lang('pre_login_field_required');?>",
                            number: "<?=lang('pre_login_field_number');?>"
                        },
                        usuario: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_usuario_minlenght');?>",
                            maxlength: "<?=lang('pre_login_field_usuario_maxlenght');?>"
                            
                        },
                        nome_razao: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_minimum_size');?>"
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
		<div class="row-fluid row-merge">
			<div class="span11">
                            
                            <h3 class="glyphicons no-js keys"><i></i> <?=lang('pre_login_inscrever');?></h3>
                            <form class="form-horizontal" id="frm_signup" method="post" autocomplete="off" action="<?php echo base_url();?>i/login/signup_now">	                                

                            <hr class="separator" />
                            <div class="row-fluid">
                                    <div class="span6">
                                            <div class="control-group">
                                                    <label class="control-label" for="nome"><?=lang('pre_login_label_nome');?></label>
                                                    <div class="controls"><input class="span12" id="nome" name="nome" type="text" value="<?php echo set_value('nome'); ?>"/></div>
                                            </div>
                                            <div class="control-group">
                                                    <label class="control-label" for="sobrenome"><?=lang('pre_login_label_sobrenome');?></label>
                                                    <div class="controls"><input class="span12" id="sobrenome" name="sobrenome" type="text" value="<?php echo set_value('sobrenome'); ?>" /></div>
                                            </div>
                                            <div class="control-group">
                                                    <label class="control-label" for="email"><?=lang('pre_login_label_email');?></label>
                                                    <div class="controls"><input class="span12" id="email" name="email" type="email" value="<?php echo set_value('email'); ?>" /></div>
                                            </div>                                       
                                            <div class="control-group">
                                                    <label class="control-label" for="data_nasc"><?=lang('pre_login_label_data_nascimento');?></label>
                                                    <div class="controls"><input class="span4" id="data_nasc" name="data_nasc" type="text" value="<?php echo set_value('data_nasc'); ?>" /></div>
                                            </div>
                                            <div class="control-group">
                                                    <label class="control-label" for="senha"><?=lang('pre_login_label_senha');?></label>
                                                    <div class="controls"><input class="span12" id="senha" name="senha" type="password" value="<?php echo set_value('senha'); ?>" /></div>
                                            </div>  
                                            <div class="control-group">
                                                    <label class="control-label" for="nome_razao"><?=lang('pre_login_label_nome_razao');?></label>
                                                    <div class="controls"><input class="span12" id="nome_razao" name="nome_razao" type="text" value="<?php echo set_value('nome_razao'); ?>" /></div>
                                            </div>                                            
                                            <div class="control-group margin-none">
                                                    <label class="control-label" for="usuario"><?=lang('pre_login_label_usuario');?></label>
                                                    <div class="controls"><input class="span12 bold" id="usuario" name="usuario" type="text" value="<?php echo set_value('usuario'); ?>" /></div>
                                            </div>
                                            <div class="control-group">
                                                            <hr/>
                                                            <h5><?=lang('pre_login_label_escolher_plano');?></h5>
                                                            <div>
                                                                
                                                                <!-- buscar planos no banco de dados aqui -->
                                                                    <select class="selectpicker span12" name="plano" id="plano">
                                                                            <option value="1" <? if($plano_escolhido == 1) echo 'selected'; ?>><?=lang('pre_login_plano_a');?></option>
                                                                            <option value="2" <? if($plano_escolhido == 2) echo 'selected'; ?>><?=lang('pre_login_plano_b');?></option>
                                                                            <option value="3" <? if($plano_escolhido == 3) echo 'selected'; ?>><?=lang('pre_login_plano_c');?></option>
                                                                            <option value="4" <? if($plano_escolhido == 4) echo 'selected'; ?>><?=lang('pre_login_plano_d');?></option>
                                                                            
                                                                    </select>
                                                            </div>
                                                            <div>
                                                                <a href="<?php echo base_url();?>pricing" target="_new"><?=lang('pre_login_label_planos_veja');?></a>
                                                            </div>
                                            </div>                                            
                                            <div class="control-group margin-none">
                                                    <label class="control-label" for="usuario_quantidade"><?=lang('pre_login_label_quantidade_usuario');?></label>
                                                    <div class="controls"><input class="span5" id="usuario_quantidade" name="usuario_quantidade" type="text" value="<?php echo set_value('usuario'); ?>"/></div>
                                                    
                                            </div>
                                        
                                            <div class="control-group margin-none">
                                                    <label class="control-label" for="usuario_quantidade"><?=lang('pre_login_label_quem_indicou');?></label>
                                                    <div class="controls"><input class="span5" id="id_indicou" name="id_indicou" type="text" value=""/></div>
                                                    
                                            </div>                                          
                                     
                                    </div>

                            </div>   
                            <br />
                            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('pre_login_label_comecar_experimentar');?></button>                            
                            
                            </form>
			</div>
		</div>
	</div>
	
	

	
</div>		

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>