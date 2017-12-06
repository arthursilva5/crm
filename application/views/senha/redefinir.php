
        <script type="text/javascript" charset="utf-8">
            //formulário de cidades e estados
            $(document).ready(function(){

                $("#redefsenha").validate({
                    rules:{
                      user_email: {
                        required: true
                      }
                        
                    },
                     messages: {
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
        <br class="clearboth" />   
        
           <h2><img src="<?=base_url()?>common/theme/images/icons/unlock_yellow.png" class="pull-left" style="width: 48; height: 48;" width="48" height="48" /> <?=lang('common_resetar_senha_titulo'); ?></h2>
             
             <form class="form-horizontal" action="<?php echo base_url();?>i/redefinir_senha" autocomplete="off" method='post' name="redefsenha" id="redefsenha">                
                 <div class="row-form clearfix">
                     <div class="span10">
                         <span>
                             
                             
                             <div class="control-group">                                                                                                
                                <div class="controls"><input type="text"  name="user_email" id="user_email" style="height: 43px; width: 402px; font-size: larger; margin-bottom: 15px;" placeholder="<?=lang('common_resetar_senha_digite_email_usuario'); ?>" value="" /></div>
                             <div style="color:red;">
                                <? if(!empty($pedido_feito)) {
                                     echo lang('common_resetar_senha_sucesso_email_enviado_1').' '.$email_senha.' '.lang('common_resetar_senha_sucesso_email_enviado_2');
                                }
                                ?>                         
                                <span><? if(!empty($msg_erro)) { print $msg_erro; }?> <? if(!empty($msg)) { print $msg; }?></span>
                             </div>                             
                             </div>

                             <br />
                             <button type="submit" class="btn btn-primary btn-large"><?=lang('common_resetar_senha_titulo'); ?> &raquo;</button>
                         </span>
                            <br />
  
                         
                     </div>
                     
                 </div>                                                     
                 
             </form>
        </div>
    </div>                                      
        
<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>        