
<div class="heading-buttons">
	<h3 class="glyphicons credit_card"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
       
    
   
<div class="innerLR innerB shop-client-products cart invoice">

	<table class="table table-invoice">
		<tbody>
			<tr>
				<td style="width: 58%;">
				
				</td>
				<td class="right">
					<div class="innerL">
						<h4>#<?=$fatura_nao_paga->id;?> - <?=$fatura_nao_paga->data_vencimento;?></h4>
						<button type="button" data-toggle="print" class="btn btn-default btn-icon glyphicons print hidden-print"><i></i> <?=lang('common_fatura_label_imprimir_fatura');?></button>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="separator bottom"></div>
	<div class="well">
		<table class="table table-invoice">
			<tbody>
				<tr>
					<td style="width: 50%;">
						<p class="lead"><?=lang('common_fatura_informacoes_empresa_titulo');?></p>
						<h2><?=lang('common_fatura_informacoes_empresa_nome');?></h2>
						<address class="margin-none">
							<abbr title="<?=lang('common_label_email');?>"><?=lang('common_label_email');?>:</abbr> <a href="mailto:<?=lang('common_fatura_informacoes_empresa_email');?>"><?=lang('common_fatura_informacoes_empresa_email');?></a><br /> 
						</address>
					</td>
					<td class="right">
						<p class="lead"><?=lang('common_fatura_informacoes_cliente_titulo');?></p>
						<h2><?=$dados_cliente->nome_razao;?></h2>
						<address class="margin-none">
							<strong><?=$title;?></strong> : 
							<strong><a href="#"><?=$dados_cliente->nome_razao;?></a></strong><br> 
							<abbr title="<?=lang('common_label_email');?>"><?=lang('common_label_email');?>:</abbr> <?=$dados_cliente->email;?><br /> 
							<div class="separator line"></div>
							<p class="margin-none"><strong><?=lang('common_label_anotacoes');?></strong><br/><?=lang('common_fatura_informacoes_anotacoes');?></p>
						</address>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<table class="table table-bordered table-primary table-striped table-vertical-center">
		<thead>
			<tr>
				<th style="width: 1%;" class="center"><?=lang('common_label_numero_abreviado');?>.</th>
				<th></th>
				<th style="width: 50px;"><?=lang('common_fatura_informacoes_data_vencimento');?></th>
				<th style="width: 80px;"><?=lang('common_label_usuarios');?></th>
				<th style="width: 80px;"><?=lang('common_label_total');?></th>
			</tr>
		</thead>
		<tbody>
		
						<!-- Cart item -->
			<tr>
				<td class="center"><?=$fatura_nao_paga->id;?></td>
				<td>
					<h5><?=$fatura_nao_paga->descricao;?></h5>
				</td>
				<td class="center"><?=$fatura_nao_paga->data_vencimento;?></td>
				<td class="center"><?=$plano_atual->total_usuarios;?></td>
				<td class="center"><?=$fatura_nao_paga->valor;?></td>				
			</tr>
			<!-- // Cart item END -->
		
						
		</tbody>
	</table>
	<div class="separator bottom"></div>
	
	<!-- Row -->
	<div class="row-fluid">
	
		<!-- Column -->
		<div class="span5">
			<div class="box-generic">
				<p class="margin-none"><strong><?=lang('common_label_anotacoes');?>:</strong><br/><?=lang('common_fatura_informacoes_anotacoes');?></p>
			</div>
		</div>
		<!-- Column END -->
		
		<!-- Column -->
		<div class="span4 offset3">
			<table class="table table-borderless table-condensed cart_total">
				<tbody>
					<tr>
						<td class="right"><?=lang('common_label_total');?>:</td>
						<td class="right strong"><?=$fatura_nao_paga->valor;?></td>
					</tr>
					<tr class="hidden-print">
						<td colspan="2"><a href="<?=base_url()?>i/invoice/payment_type" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><i></i><?=lang('common_fatura_informacoes_continuar_pagamento');?></a></span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- // Column END -->
		
	</div>
	<!-- // Row END -->
	
</div>    
        
        
</div>
<br/>		
	