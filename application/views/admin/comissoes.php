<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){
            
            $('#btn-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              // Find form and submit it
              $('#form_edit').submit();
            });             
            


            });
            
            function edit_btn(id, nome_razao, valor_total) // editar
            {                
                document.form_edit.elements['comissao_id'].value=id;
                document.form_edit.elements['nome_razao'].value=nome_razao; 
                document.form_edit.elements['valor_total'].value=valor_total;
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
					<?=lang('common_comissoes_total_a_pagar');?><strong><?=$row_total_a_pagar->total;?></strong>
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
					<th class="center"><?=lang('common_comissoes_data_credito');?></th>
					<th class="right"><?=lang('common_label_total');?></th>
                                        <th class="right"><?=lang('common_comissoes_marcar_como_pago');?></th>
				</tr>
			</thead>
			<tbody>
                            <?
                            foreach($rows as $rows_item) {
                                if($rows_item->status == 'u')
                                    $img_seta = 'up_arrow btn-success';
                                elseif($rows_item->status == 'p')
                                    $img_seta = 'down_arrow btn-danger';
                                else
                                    $img_seta = 'rotation_lock btn-info';
                                
                            ?>                            
				<tr class="selectable">
					<td class="center"><span class="label label-important"><?=$rows_item->cliente_id_indicou;?> </span></td>
                                        <td class="important"><span class="glyphicons <?=$img_seta;?> btn-action single"><i></i></span><a href="<?php echo base_url();?>i/jesus/view_cliente/<?=$rows_item->cliente_id_indicou;?>"><?=$rows_item->nome_razao;?></a></td>
                                        <td class="center"><span class="label label-important"><?=$rows_item->data_adicao;?> </span></td>
					<? if($rows_item->status == 'u') 
                                              echo '<td class="center"><strong>'.$rows_item->valor.'</strong></td>';
                                           elseif($rows_item->status == 'p')
                                              echo '<td class="center">('.$rows_item->valor.' )</td>';
                                           else
                                               echo '<td class="center">('.$rows_item->valor.' )</td>';
                                        ?>
                                        <td class="center" style="width: 60px;">
                                            <a href="#modal-edit" data-toggle="modal" onclick="edit_btn('<?=$rows_item->comissao_id;?>', '<?=$rows_item->nome_razao;?>', '<?=$rows_item->valor;?>')"  title="<?=lang('common_label_editar');?>" class="btn-action glyphicons glass btn-success"><i></i></a>
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
            <form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/jesus/commission_paid">
                <input type="hidden" id="comissao_id" name="comissao_id" value="" />
		<div class="control-group">
                    <div class="controls"><input type="text" name="nome_razao" id="nome_razao" class="span3" value="" /></div>
                    <div class="controls"><input type="text" name="valor_total" id="valor_total" class="span3" value="" /></div>
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

<!-- precos -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/price/jquery.price_format.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/plugins/price/jquery.price_format.min.js" type="text/javascript"></script>