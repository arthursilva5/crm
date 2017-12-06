
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
                                                
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="separator bottom"></div>

	
	<?
            if($fatura_nao_paga->valor_db > 20) {
        ?>
	<!-- Row -->
	<div class="row-fluid">
            <h3><?=lang('common_fatura_informacoes_continuar_pagamento_por_mes');?>: <?=$fatura_nao_paga->valor;?></h3>
		<!-- Column -->
		<div class="span5">
			<div class="box-generic">
                            <?php echo form_open(base_url().'common/php/boleto/boleto.php', array('name' => 'boleto', 'id' => 'boleto', 'target' => '_blank', ));?>                             
                                <input type="hidden" name="id_fatura" value="<?=$fatura_nao_paga->id?>" />
                                <input type="hidden" name="valor" value="<?=$fatura_nao_paga->valor_db?>" />
                                <input type="hidden" name="descricao" value="<?=$fatura_nao_paga->descricao?>" />               
                                <input type="hidden" name="nome" value="<?=$dados_cliente->nome_razao?>" />                
                                <input type="hidden" name="endereco" value="<?=$dados_cliente->endereco?> nº: <?=$dados_cliente->end_numero?> <?=$dados_cliente->end_complemento?> - <?=$dados_cliente->end_bairro?>" />
                                <input type="hidden" name="endereco2" value="<?=$dados_cliente->cidade_nome?> / <?=$dados_cliente->estado_nome?> - <?=$dados_cliente->end_cep?>" />                                
				<p class="margin-none" style="text-align: center;"><img src="<?=base_url();?>common/theme/images/payments/boleto.png" /></p> <br />
                                <p><button type="submit" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><i></i><?=lang('common_fatura_informacoes_continuar_pagamento_boleto');?></p>
                            </form>
			</div>
		</div>
		<!-- Column END -->
                
		<!-- Column -->
		<div class="span5">
			<div class="box-generic">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<p class="margin-none" style="text-align: center;"><img src="<?=base_url();?>common/theme/images/payments/paypal_pgm.gif" /></p> <br />
                                <p><button type="submit" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><i></i><?=lang('common_fatura_informacoes_continuar_pagamento_paypal');?></p>
                                
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="2RDWKRR32XQX6">
                                <input type="hidden" name="lc" value="BR">
                                <input type="hidden" name="item_number" value="<?=$fatura_nao_paga->id?>"> 
                                <input type="hidden" name="item_name" value="<?=$fatura_nao_paga->descricao?>">
                                <input type="hidden" name="amount" value="<?=$fatura_nao_paga->valor_db?>">
                                <input type="hidden" name="currency_code" value="BRL">
                                <input type="hidden" name="button_subtype" value="services">                                
                                <input type="hidden" name="no_note" value="0">                                
                                <input type="hidden" name="no_shipping" value="1">                                                                                              
                            </form>    
                            
                           

                            
                                
                                
                                
			</div>
		</div>
		<!-- Column END -->                
		
		
	</div>
	<!-- // Row END -->
        <?
            }
            else {
                echo '<h5>'.lang('common_fatura_informacoes_continuar_pagamento_minimo_mensal').$fatura_nao_paga->valor.'</h5>';
            }
        ?>
        <br />
        <hr />
        <br />
        
<!-- Row -->
	<div class="row-fluid">
            <h3><?=lang('common_fatura_informacoes_continuar_pagamento_por_ano');?>: <?=$fatura_nao_paga->valor_anual;?></h3>
            <h5 style="color:blue;"><?=lang('common_fatura_informacoes_continuar_pagamento_desconto');?></h5>
		<!-- Column -->
		<div class="span5">
			<div class="box-generic">
                            <?php echo form_open(base_url().'common/php/boleto/boleto.php', array('name' => 'boleto', 'id' => 'boleto', 'target' => '_blank', ));?>                             
                                <input type="hidden" name="id_fatura" value="<?=$fatura_nao_paga->id?>" />
                                <input type="hidden" name="valor" value="<?=$fatura_nao_paga->valor_db_anual?>" />
                                <input type="hidden" name="descricao" value="<?=$fatura_nao_paga->descricao?>" />               
                                <input type="hidden" name="nome" value="<?=$dados_cliente->nome_razao?>" />                
                                <input type="hidden" name="endereco" value="<?=$dados_cliente->endereco?> nº: <?=$dados_cliente->end_numero?> <?=$dados_cliente->end_complemento?> - <?=$dados_cliente->end_bairro?>" />
                                <input type="hidden" name="endereco2" value="<?=$dados_cliente->cidade_nome?> / <?=$dados_cliente->estado_nome?> - <?=$dados_cliente->end_cep?>" />                                
				<p class="margin-none" style="text-align: center;"><img src="<?=base_url();?>common/theme/images/payments/boleto.png" /></p> <br />
                                <p><button type="submit" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><i></i><?=lang('common_fatura_informacoes_continuar_pagamento_boleto');?></p>
                            </form>
			</div>
		</div>
		<!-- Column END -->
                
		<!-- Column -->
		<div class="span5">
			<div class="box-generic">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<p class="margin-none" style="text-align: center;"><img src="<?=base_url();?>common/theme/images/payments/paypal_pgm.gif" /></p> <br />
                                <p><button type="submit" class="btn btn-block btn-primary btn-icon glyphicons right_arrow"><i></i><?=lang('common_fatura_informacoes_continuar_pagamento_paypal');?></p>
                                
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="2RDWKRR32XQX6">
                                <input type="hidden" name="lc" value="BR">
                                <input type="hidden" name="item_number" value="<?=$fatura_nao_paga->id?>"> 
                                <input type="hidden" name="item_name" value="<?=$fatura_nao_paga->descricao?>">
                                <input type="hidden" name="amount" value="<?=$fatura_nao_paga->valor_db_anual?>">
                                <input type="hidden" name="currency_code" value="BRL">
                                <input type="hidden" name="button_subtype" value="services">                                
                                <input type="hidden" name="no_note" value="0">                                
                                <input type="hidden" name="no_shipping" value="1">                                                                                              
                            </form>    
                            
                           

                            
                                
                                
                                
			</div>
		</div>
		<!-- Column END -->                
		
		
	</div>
	<!-- // Row END -->        
	
</div>    
        
        
</div>
<br/>		
	