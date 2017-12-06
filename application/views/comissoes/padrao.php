<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           


               $('#total_sacar').priceFormat({
                       prefix: 'R$ ',
                       centsSeparator: ',',
                       thousandsSeparator: '.'
               });
               

            
            $('#btn-commission-get-money').on('click', function(e){ // post the form GROUP ADD
              e.preventDefault();
              // Find form and submit it
              if($("#form_get_money").valid()){ // valida o formulário
                $('#form_get_money').submit();
              }
            });            
            
            
                $("#form_get_money").validate({
                    rules:{                       
                        conta_pagar: {
                            required:true
                        },
                        total_sacar: {
                            required:true
                        }
                        
                    },
                     messages: {      
                        conta_pagar: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        },
                        total_sacar: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }
                     }
                });            
            
            
            });
            
  
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
					<?=lang('common_comissoes_total_a_receber');?><strong><?=$row_total_a_receber;?></strong>
				</div>
			</div>
			<div class="span6">
                            <div style="height: 290px;">
                                <h3><?=lang('common_comissoes_seu_id');?> : <h1 style="color:blue;"> <?=$cliente_id;?></h1></h3>
                                <br />
                                <p><?=lang('common_comissoes_seu_id_ajuda');?></p>
                            </div>
                            <div class="buttons pull-right">
                                    <a href="#modal-get-money" data-toggle="modal" class="btn btn-warning btn-icon glyphicons coins"><i></i> <?=lang('common_comissoes_sacar_dinheiro');?></a>
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
					<th><?=lang('common_fatura_informacoes_cliente_titulo');?></th>
					<th class="center"><?=lang('common_comissoes_data_pagamento');?></th>
					<th class="center"><?=lang('common_comissoes_data_credito');?></th>
					<th class="right"><?=lang('common_label_total');?></th>
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
                                
                            if(empty($rows_item->nome_razao_indicado)) { 
                                    $nome_razao = lang('common_comissoes_pagamento_requisitado');                                
                                } 
                                else { 
                                    $nome_razao = $rows_item->nome_razao_indicado;                                     
                                }                                
                                
                            ?>                                        
				<tr class="selectable">
					<td class="important"><span class="glyphicons <?=$img_seta;?> btn-action single"><i></i></span><?=$nome_razao;?></td>
					<td class="center"><span class="label label-important"><?=$rows_item->data_pagamento;?> </span></td>
                                        <td class="center"><span class="label label-important"><?=$rows_item->data_adicao;?> </span></td>
					<? if($rows_item->status == 'u') 
                                              echo '<td class="center"><strong>'.$rows_item->valor.'</strong></td>';
                                           elseif($rows_item->status == 'p')
                                              echo '<td class="center">('.$rows_item->valor.' )</td>';
                                           else
                                               echo '<td class="center">('.$rows_item->valor.' )</td>';
                                        ?>
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

<!-- Sacar dinheiro -->
<div class="modal hide fade" id="modal-get-money">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_comissoes_sacar_dinheiro');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_get_money" name="form_get_money" method="post" action="<?php echo base_url();?>i/commissions/request_money_add">
		<div class="control-group">
                    <div class="controls"><?=lang('common_label_total');?> <input type="text" name="total_sacar" id="total_sacar" class="span3" /></div>
                </div>
		<div class="control-group">
                    <div class="controls"><?=lang('common_comissoes_conta_saque');?> <textarea type="text" name="conta_pagar" id="conta_pagar" class="span3"></textarea></div>
                </div>                
                <div><?=lang('common_comissoes_conta_saque_ajuda');?></div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-commission-get-money" class="btn btn-primary"><?=lang('common_comissoes_sacar_dinheiro');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Sacar dinheiro FIM -->


<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	

<!-- precos -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/price/jquery.price_format.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/plugins/price/jquery.price_format.min.js" type="text/javascript"></script>