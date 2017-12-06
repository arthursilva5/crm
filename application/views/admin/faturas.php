<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){
            
            $('#btn-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              // Find form and submit it
              $('#form_edit').submit();
            });             
            


            });
            
            function edit_btn(id, nome_razao, valor_total, data_vencimento) // editar
            {                
                document.form_edit.elements['fatura_id'].value=id;
                document.form_edit.elements['nome_razao'].value=nome_razao; 
                document.form_edit.elements['valor_total'].value=valor_total;
                document.form_edit.elements['data_vencimento_pgm'].value=data_vencimento;
            }          
            
  
</script>


<div class="heading-buttons">
	<h3 class="glyphicons coins"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
    
    
<div class="widget widget-2 widget-body-white finances_summary">
	<div class="widget-head">
		<h4 class="heading glyphicons alarm"><i></i> <?=lang('common_comissoes_sumario');?></h4>
	</div>
	<div class="widget-body">
		<div class="row-fluid">
			<div class="span5">
				<div class="well">
					<?=lang('common_comissoes_total_pago');?><strong><?=$row_total_pago->total;?></strong>
				</div>
				<div class="separator bottom center">
					<span class="glyphicons flash standard"><i></i></span>
				</div>
				<div class="well">
					<?=lang('common_comissoes_total_a_receber');?><strong><?=$row_total_nao_pago->total;?></strong>
				</div>
			</div>
			<div class="span6">
                            <div style="height: 290px;">
                                <h3><?=lang('common_comissoes_seu_id');?> : <h1 style="color:blue;"> <?=$cliente_id;?></h1></h3>
                                <br />
                                <p><?=lang('common_comissoes_seu_id_ajuda');?></p>
                            </div>
                             
			</div>
		</div>		
	</div>
</div>    
    
    
    
<div class="widget widget-2 widget-body-white">
	<div class="widget-head">
		<h4 class="heading glyphicons fire"><i></i> <?=lang('common_comissoes_transacoes');?></h4>
	</div>
	<div class="widget-body">
		<table class="table table-condensed table-primary table-vertical-center table-thead-simple">
			<thead>
				<tr>
                                        <th><?=lang('common_label_id');?></th>
					<th><?=lang('common_fatura_informacoes_cliente_titulo');?></th>
					<th class="center"><?=lang('common_fatura_informacoes_data_vencimento');?></th>
					<th class="right"><?=lang('common_label_total');?></th>
                                        <th class="right"><?=lang('common_comissoes_marcar_como_pago');?></th>
				</tr>
			</thead>
			<tbody>
                            <?
                            foreach($rows as $rows_item) {
                                
                            ?>                            
				<tr class="selectable">
					<td class="center"><span class="label label-important"><?=$rows_item->fatura_id;?> </span></td>
                                        <td class="important"><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span><a href="<?php echo base_url();?>i/jesus/view_cliente/<?=$rows_item->cliente_id;?>"><?=$rows_item->nome_razao;?></a></td>
                                        <td class="center"><span class="label label-important"><?=$rows_item->data_vencimento;?> </span></td>
                                        <td class="center"><strong><?=$rows_item->valor;?></strong></td>
                                        <td class="center" style="width: 60px;">
                                            <a href="#modal-edit" data-toggle="modal" onclick="edit_btn('<?=$rows_item->fatura_id;?>', '<?=$rows_item->nome_razao;?>', '<?=$rows_item->valor_db;?>', '<?=$rows_item->data_vencimento;?>')"  title="<?=lang('common_label_editar');?>" class="btn-action glyphicons glass btn-success"><i></i></a>
                                        </td>                                        
				</tr>
                                <?
                                } // fim foreach
                                ?>
				</tbody>
		</table>
            <!--paginacao -->
            <div class="pagination pull-right" style="margin: 0;">
                    <?=$link_paginacao;?>
            </div>
            <!--paginacao -->
            <br />
            <div><span class="glyphicons up_arrow btn-success btn-action single"><i></i></span> = <?=lang('common_comissoes_data_credito');?></div>            
            <div><span class="glyphicons down_arrow btn-danger btn-action single"><i></i></span> = <?=lang('common_comissoes_data_pagamento');?></div>
            <div><span class="glyphicons rotation_lock btn-info btn-action single"><i></i></span> = <?=lang('common_comissoes_aguardando_pagamento');?></div>
            
	</div>
</div>    

    
</div>

<!-- Editar -->
<div class="modal hide fade" id="modal-edit">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_comissoes_marcar_como_pago');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/jesus/billing_paid">
                <input type="hidden" id="fatura_id" name="fatura_id" value="" />
		<div class="control-group">
                    <div class="controls"><input type="text" name="nome_razao" id="nome_razao" class="span3" value="" /></div>
                    <div class="controls"><input type="text" name="valor_total" id="valor_total" class="span3" value="" /></div>
                    <div class="controls"><input type="text" name="data_vencimento_pgm" id="data_vencimento" class="span3" value="" placeholder="YYYY-mm-dd" /></div>
                    <div class="controls">
                        <input type="radio" name="periodo_pgm" value="m" checked> <?=lang('common_fatura_informacoes_continuar_pagamento_por_mes');?>
                        <input type="radio" name="periodo_pgm" value="y"> <?=lang('common_fatura_informacoes_continuar_pagamento_por_ano');?>                         
                    </div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-edit" class="btn btn-primary"><?=lang('common_comissoes_marcar_como_pago');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Editar FIM -->


<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	