<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>
	<title>5lobos CRM . <?php echo $title ?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
        
        <meta property="og:title" content="5lobos CRM"/>     
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://crm.5lobos.com" />
        <meta property="og:image" content="http://www.5lobos.com/pub/marca_5lobos_crm_big.png" />     
        <meta property="og:description" content="5lobos CRM - Gerenciamento do Relacionamento com o Cliente / Customer Relationship Management" />
        
        <link rel="shortcut icon" href="http://www.5lobos.com/pub/favicon.png" />        
	
	<!-- Bootstrap -->
	<link href="<?=base_url(); ?>common/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url(); ?>common/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	
	<!-- Bootstrap Extended -->
	<link href="<?=base_url(); ?>common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url(); ?>common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?=base_url(); ?>common/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	
	<!-- Select2 -->
	<link rel="stylesheet" href="<?=base_url(); ?>common/theme/scripts/plugins/forms/select2/select2.css"/>
	
	<!-- Gritter Notifications Plugin -->
	<link href="<?=base_url(); ?>common/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css" rel="stylesheet" />
	
	<!-- JQueryUI v1.9.2 -->
	<link rel="stylesheet" href="<?=base_url(); ?>common/theme/scripts/plugins/system/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css" />
	
	<!-- Glyphicons -->
	<link rel="stylesheet" href="<?=base_url(); ?>common/theme/css/glyphicons.css" />
	
	<!-- Bootstrap Extended -->
	<link rel="stylesheet" href="<?=base_url(); ?>common/bootstrap/extend/bootstrap-select/bootstrap-select.css" />
	<link rel="stylesheet" href="<?=base_url(); ?>common/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
	
	<!-- Uniform -->
	<link rel="stylesheet" media="screen" href="../common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" />
	
	<!-- google-code-prettify -->
	<link href="<?=base_url(); ?>common/theme/scripts/plugins/other/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />

	<!-- JQuery v1.8.2 -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/jquery-1.8.2.min.js"></script>
	
	<!-- Modernizr -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/modernizr.custom.76094.js"></script>
	
	<!-- MiniColors -->
	<link rel="stylesheet" media="screen" href="<?=base_url(); ?>common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css" />
	
	<!-- Theme -->
	<link rel="stylesheet" href="<?=base_url(); ?>common/theme/css/style.css?1370451130" />
	
	<!-- LESS 2 CSS -->
	<script src="<?=base_url(); ?>common/theme/scripts/plugins/system/less-1.3.3.min.js"></script>
        
        <script type="text/javascript" charset="utf-8">
            //formulário de cidades e estados
            $(document).ready(function(){
                $( "#modalMensagem" ).modal('show')               
            });
        </script>       
	
</head>
<body>		
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25405458-1']);
  _gaq.push(['_setDomainName', '5lobos.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>    
    
<!-- Start Content -->
<div class="container-fluid fluid">

        <div class="navbar main hidden-print">


                <a href="<?=base_url(); ?>"><img style="margin-left:22px; margin-top:4px;" src="<?=base_url(); ?>common/theme/images/logo.png" /></a>

                <ul class="topnav pull-right">
                    
                        <li>
                            <a href="<?=base_url(); ?>i/language/portugues" title="Portugues"><img src="<?=base_url(); ?>common/theme/images/lang/br.png" alt="Português"></a>                            
                        </li>
                        <li>
                            <a href="<?=base_url(); ?>i/language/english" title="English"><img src="<?=base_url(); ?>common/theme/images/lang/en.png" alt="English"></a>
                        </li>                    
                        <!-- logado -->
                        <? if($this->session->userdata('validated')) { // mostra se estiver LOGADO ?>
                        <!--
                        <li class="visible-desktop">
                            <ul class="notif">
                                <li><a href="" class="glyphicons envelope" data-toggle="tooltip" data-placement="bottom" data-original-title="5 new messages"><i></i> 5</a></li>
                                <li><a href="" class="glyphicons shopping_cart" data-toggle="tooltip" data-placement="bottom" data-original-title="1 new orders"><i></i> 1</a></li>
                                <li><a href="" class="glyphicons log_book" data-toggle="tooltip" data-placement="bottom" data-original-title="3 new activities"><i></i> 3</a></li>
                            </ul>
                        </li>
                        -->
                            
                            <li class="dropdown visible-desktop">
                                <a href="" data-toggle="dropdown" class="glyphicons cogwheel"><i></i><?=lang('header_conta');?> <span class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                        <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                                        <li><a href="<?=base_url(); ?>i/config" class="glyphicons no-js settings"><i></i><?=lang('common_configuracoes_titulo');?></a></li>
                                        <li><a href="<?=base_url(); ?>i/plan" class="glyphicons no-js notes_2"><i></i><?=lang('common_plano_label_titulo_meu_plano');?></a></li>
                                        <? } //fim administrador?>
                                        <li><a href="<?=base_url(); ?>i/login/logout" class="glyphicons no-js circle_remove"><i></i><?=lang('header_label_logout');?></a></li>
                                </ul>
                            </li>                            
                        <? } //fim LOGADO?>
                        <!-- logado -->                        
                        
                        <!--
                        <li class="hidden-phone">
                            <?
                            if( $this->session->userdata('default_lang') == 'portugues')
                                $flag_img = 'br';                            
                            elseif ( $this->session->userdata('default_lang') == 'english')
                                $flag_img = 'en';
                            else
                                $flag_img = 'en';
                            ?>                                                       
                            
                            <a href="#" data-toggle="dropdown"><img src="<?=base_url(); ?>common/theme/images/lang/<?=$flag_img;?>.png" alt="<?=$flag_img;?>" /></a>                            
                            <ul class="dropdown-menu pull-right">
                                <li <? if($flag_img == 'br') echo 'class="active"'; ?>><a href="<?=base_url(); ?>i/language/portugues" title="Portugues"><img src="<?=base_url(); ?>common/theme/images/lang/br.png" alt="Português"> Português</a></li>
                                <li <? if($flag_img == 'en') echo 'class="active"'; ?>><a href="<?=base_url(); ?>i/language/english" title="English"><img src="<?=base_url(); ?>common/theme/images/lang/en.png" alt="English"> English</a></li>
                            </ul>
                        </li>
                        -->
                        
                        <? if($this->session->userdata('validated')) { // mostra se estiver LOGADO ?>
                        <li class="account">
                                <a href="<?=base_url(); ?>i/dashboard" class="glyphicons logout lock"><span class="hidden-phone text"><?=lang('header_welcome');?> <strong><?=$this->session->userdata('usuario');?></strong></span><i></i></a>
                        </li>
                        <? } else { //fim LOGADO?>
                        <li>
                            <a href="<?=base_url(); ?>pricing" class="glyphicons logout thumbs_up"><span class="hidden-phone text"><?=lang('pre_login_label_edicoes_precos');?></strong></span><i></i></a>    
                        </li>                        
                        <li>
                            <a href="<?=base_url(); ?>signup" class="glyphicons logout keys"><span class="hidden-phone text"><?=lang('pre_login_inscrever');?></strong></span><i></i></a>    
                        </li>
                        <li class="account">                            
                            <a href="<?=base_url(); ?>i/login" class="glyphicons logout lock"><span class="hidden-phone text"><?=lang('header_label_login');?></strong></span><i></i></a>
                        </li> 
                        <? } ?>
                </ul>

        </div>  
    
    
    
    
    
        
    
        <? if($this->session->userdata('validated')) // mostra se estiver LOGADO
            {
       
        ?>
    
    <div id="wrapper">
		<div id="menu" class="hidden-phone">
			<div id="menuInner">
			
				<!-- Scrollable menu wrapper with Maximum height -->
				<div class="slim-scroll" data-scroll-height="420px">
				
				<div id="search">
                                        <form id="form_busca" name="form_busca" method="post" action="<?php echo base_url();?>i/search">
                                            <input type="text" name="busca" id="busca" placeholder="<?=lang('common_buscas_busca_rapida');?>" />
                                            <button class="glyphicons search"><i></i></button>
                                        </form>
				</div>
				<ul>
					<li class="heading"><span><?=lang('common_label_seu_crm');?></span></li>
					<li class="glyphicons home"><a href="<?=base_url(); ?>i/dashboard"><i></i><span><?=lang('common_dashboard_title');?></span></a></li>
					
                                        
                                        <li class="glyphicons building"><a href="<?=base_url();?>i/accounts"><i></i><span><?=lang('common_contas_titulo');?></span></a></li>
                                        <li class="glyphicons coins"><a href="<?=base_url(); ?>i/potentials"><i></i><span><?=lang('common_oportunidades_titulo');?></span></a></li>
                                        <li class="glyphicons nameplate"><a href="<?=base_url(); ?>i/contacts"><i></i><span><?=lang('common_contatos_titulo');?></span></a></li>
                                        <li class="glyphicons e-mail"><a href="<?=base_url(); ?>i/newsletter"><i></i><span><?=lang('common_newsletter_titulo');?></span></a></li>
                                        
                                        
                                        <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                                        <li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons group" href="#menu_account"><i></i><span><?=lang('common_meusdados_titulo');?></span></a>
						<ul class="collapse" id="menu_account">
							<li class=""><a href="<?=base_url(); ?>i/myaccount"><span><?=lang('common_meusdados_titulo');?></span></a></li>
                                                        <li class=""><a href="<?=base_url(); ?>i/plan"><span><?=lang('common_plano_label_titulo_meu_plano');?></span></a></li>
							<li class=""><a href="<?=base_url(); ?>i/config"><span><?=lang('common_configuracoes_titulo');?></span></a></li>
						</ul>
					</li>
                                        <li class="glyphicons credit_card"><a href="<?=base_url(); ?>i/invoice"><i></i><span><?=lang('common_faturas_titulo');?></span></a></li>
                                        <? } // fim administrador ?>                                        
				</ul>
				<ul>
					<li class="heading"><span><?=lang('common_label_relatorios');?></span></li>
					<li class="glyphicons coins"><a href="<?=base_url(); ?>i/commissions"><i></i><span><?=lang('common_comissoes_titulo');?></span></a></li>
					
				</ul>
			</div>
			
			</div>
			<!-- // Nice Scroll Wrapper END -->
			
		</div>
    <?
    } //fim menu
    ?>
    

    
    
    <div id="content">
    
    <? if($this->session->userdata('validated')) { // mostra se estiver LOGADO    ?>
    <ul class="breadcrumb">
	<li><a href="<?=base_url(); ?>" class="glyphicons home"><i></i><?=lang('common_label_sitemap_principal');?></a></li>
	<li class="divider"></li>
        <li><a href="javascript:history.back(-1)"><?=lang('common_label_anterior');?></a></li>
        <li class="divider"></li>
	<li><?=$title;?></li>
        
    </ul>  
    <? } ?>
<div class="separator bottom"></div>
         	