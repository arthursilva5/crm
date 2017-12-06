
<div class="heading-buttons">
	<h3 class="glyphicons settings"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
    
        <div class="widget widget-4">
                <div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_titulo_aba1');?></h4></div>
                <div class="separator"></div>
        </div>     
        <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>
				<th style="width: 1%;" class="center">No.</th>
				<th><?=lang('common_label_titulo');?></th>
				<th class="right" colspan="3"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>
                        <tr class="selectable">
				<td class="center">1</td>
				<td><strong><?=lang('common_configuracoes_usuarios_label_usuarios_sistema');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/users" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>    
                        
                        <tr class="selectable">
				<td class="center">2</td>
				<td><strong><?=lang('common_configuracoes_grupos_titulo');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/groups" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>                             
            </tbody>
	</table>    
        <br /><br />
    
        <div class="widget widget-4">
                <div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_titulo_aba2');?></h4></div>
                <div class="separator"></div>
        </div>       
		<table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>
				<th style="width: 1%;" class="center">No.</th>
				<th><?=lang('common_label_titulo');?></th>
				<th class="right" colspan="3"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>  
                        <tr class="selectable">
				<td class="center">3</td>
				<td><strong><?=lang('common_configuracoes_tipos_contas_label_titulo');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/accounttype" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>                         
                        <tr class="selectable">
				<td class="center">4</td>
				<td><strong><?=lang('common_configuracoes_industrias_titulo');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/industry" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr> 
                        <tr class="selectable">
				<td class="center">5</td>
				<td><strong><?=lang('common_configuracoes_notificacoes_titulo');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/notifications" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>
                        <tr class="selectable">
				<td class="center">6</td>
				<td><strong><?=lang('common_configuracoes_servidor_email_titulo');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/email_server" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>                         
            </tbody>
	</table>
        
        
        <br /><br />
    
        <div class="widget widget-4">
                <div class="widget-head"><h4 class="heading"><?=lang('common_configuracoes_titulo_aba3');?></h4></div>
                <div class="separator"></div>
        </div>       
		<table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>
				<th style="width: 1%;" class="center">No.</th>
				<th><?=lang('common_label_titulo');?></th>
				<th class="right" colspan="3"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>  
                        <tr class="selectable">
				<td class="center">7</td>
				<td><strong><?=lang('common_label_aniversario');?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="<?=base_url(); ?>i/config/email_birthday" class="btn-action glyphicons pencil btn-success"><i></i></a>
				</td>
			</tr>                        
            </tbody>
	</table>        
</div>
<br/>		
	