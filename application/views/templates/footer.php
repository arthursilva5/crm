     
</div>
</div>
<div style="text-align: center;"><h5><a href="<?=base_url(); ?>i/padrao/contact"><?=lang('pre_login_titulo_contato');?></a></h5></div>
<p><?=lang('header_label_direitos');?> </p>

<?php 
if(!empty($msg) ) {
    $titulo_modal = lang('header_modal_mensagem');
    $msg_modal = $msg;    
}
/*
elseif(!empty($msg_erro_login)) {
    $titulo_modal = "Erro ao logar no 5lobos CRM";
    $msg_modal = $msg_erro_login;      
}
 */
elseif(!empty($msg_erro)) {
    $titulo_modal = lang('header_modal_erro');
    $msg_modal = $msg_erro;      
}
    
if(!empty($msg_modal)){    
    echo'
        
<div id="modalMensagem" class="modal hide fade">
  <div id="modalMensagem"  class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>'.$titulo_modal.'</h3>
  </div>
  <div class="modal-body">
    <p>'.$msg_modal.'</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-default" data-dismiss="modal">'.lang('header_label_fechar').'</a>    
  </div>
</div>
    ';
}
  ?>
        
        
<!-- JQueryUI v1.9.2 -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- MiniColors -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js"></script>
	
	<!-- Select2 -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/select2/select2.js"></script>
	
	<!-- jQuery Slim Scroll Plugin -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js"></script>
	
	<!-- Common Demo Script -->
	<script src="<?=base_url(); ?>common/theme/scripts/demo/common.js?1370451130"></script>
	
	<!-- Holder Plugin -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/other/holder/holder.js"></script>
	<script>Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9})</script>
	
	<!-- Twitter Feed 
	<script src="<?=base_url(); ?>common/theme/scripts/demo/twitter.js"></script>-->
	
	<!-- Colors -->
	<script>
	var primaryColor = '#4a8bc2',
		dangerColor = '#b55151',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	</script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = '#DA4C4C';
	</script>
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/jquery.cookie.js"></script>
	<script src="<?=base_url(); ?>common/theme/scripts/demo/themer.js"></script>
	
	
	<!-- Resize Script -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/other/jquery.ba-resize.js"></script>
	
	<!-- Uniform -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script>
	
	<!-- Bootstrap Script -->
	<script src="<?=base_url(); ?>common/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Extended -->
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="<?=base_url(); ?>common/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
	
	<!-- Layout Options DEMO Script -->
	<script src="<?=base_url(); ?>common/theme/scripts/demo/layout.js"></script>
	
	<!-- google-code-prettify -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/other/google-code-prettify/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js"></script>
	

</body>
</html>