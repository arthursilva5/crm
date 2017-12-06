        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){

                $("#redefsenha").validate({
                    rules:{
                      senha_conf: {
                        equalTo: "#senha"
                      },
                      senha: {
                        required:true,
                        minlength: 6,
                        maxlength: 150 
                      }
                        
                    },
                     messages: {
                        senha: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_password_minimum_size');?>"
                        },                         
                        user_email: {
                            required: "<?=lang('pre_login_field_required');?>"
                        }                       
                     }
                });
                
            });
            
        </script>
        <!-- oef jsp -->

    <div> 
        <div class="hero-unit">
             <!-- formulario redefinir -->
            
           <h2> <?=lang('common_resetar_senha_titulo'); ?></h2>
      
                <? if(!empty($usuario)) { print lang('common_resetar_senha_titulo_usuario').' <span style="color:red; font-size: larger;">'.$usuario.'</span>'; }?>
                <br />
               <span style="margin-left: 45px;"><? if(!empty($msg_erro)) { print $msg_erro; }?> <? if(!empty($msg)) { print $msg; }?> </span>                       
               <? if(!empty($usuario)){ ?>
                              <!-- formulario de cadastro -->
                              <form class="form-horizontal"  action="<?php echo base_url();?>i/redefinir_senha/alterar/<?=$passkey?>" method='post' name="redefsenha" id="redefsenha">                            
                        
                                          <span class="pull-left" style=" margin-right: 10px; padding-right: 10px;">
                                            <div class="control-group">
                                              <div class="controls"><input type="password" name="senha" id="senha" style="height: 43px; font-size: larger; margin-bottom: 15px; width: 400px;" placeholder="<?=lang('common_label_digite_nova_senha'); ?>" value="" /></div>
                                            </div>
                                          </span>
                                          <span class="pull-left">
                                            <div class="control-group">
                                              <div class="controls"><input type="password" name="senha_conf" id="password_conf" style="height: 43px; font-size: larger; margin-bottom: 15px; width: 400px;" placeholder="<?=lang('common_label_digite_nova_senha_novamente'); ?>" value="" /></div>
                                            </div>
                                          </span>                                    
                                          <button class="btn btn-primary btn-large"><?=lang('common_resetar_senha_btn_alterar'); ?> &raquo;</button>
                                          <br style="clear:both;" />                                    
                                                                 

                              </form>          
              <? } ?>

                       
        </div>
    </div>   
        
</div>         


<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>  