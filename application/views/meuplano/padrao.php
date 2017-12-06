
<div class="heading-buttons">
	<h3 class="glyphicons notes_2"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
        <div class="control-group">
                <hr/>
                <h5><?=lang('pre_login_label_escolher_plano');?></h5>
                <div>
                    <form  method="post" action="<?php echo base_url();?>i/plan/change">
                    <!-- buscar planos no banco de dados aqui -->
                        <select class="selectpicker span12" name="plano" id="plano">
                                <option value="1" <? if($plano_escolhido == 1) echo 'selected'; ?>><?=lang('pre_login_plano_a');?></option>
                                <option value="2" <? if($plano_escolhido == 2) echo 'selected'; ?>><?=lang('pre_login_plano_b');?></option>
                                <option value="3" <? if($plano_escolhido == 3) echo 'selected'; ?>><?=lang('pre_login_plano_c');?></option>
                                <option value="4" <? if($plano_escolhido == 4) echo 'selected'; ?>><?=lang('pre_login_plano_d');?></option>

                        </select>
                        <button class="btn btn-primary" type="submit"><?=lang('common_meuplano_atualizar_plano');?></button>
                    </form>
                </div>
        </div>
        <br />

        
    <!-- Pricing table -->
		<table class="table table-bordered table-vertical-center table-pricing table-pricing-2">
		
			<!-- Table heading -->
			<thead>
				<tr>
					<th class="center"><?=lang('pre_login_plano_a');?></th>
					<th class="center"><?=lang('pre_login_plano_b');?></th>
					<th class="center"><?=lang('pre_login_plano_c');?></th>
					<th class="center"><?=lang('pre_login_plano_d');?></th>
				</tr>
			</thead>
			<!-- // Table heading END -->
			
			<!-- Table body -->
			<tbody>
			
				<!-- Table pricing row -->
				<tr class="pricing">
					<td class="center">
						<span class="price"><?=lang('pre_login_plano_gratis');?></span>
					</td>
					<td class="center">
						<span class="price"><?=lang('pre_login_plano_b_valor');?></span>
						<span><?=lang('pre_login_plano_por_mes');?></span>
					</td>
					<td class="center">
						<span class="price"><?=lang('pre_login_plano_c_valor');?></span>
						<span><?=lang('pre_login_plano_por_mes');?></span>
					</td>
					<td class="center">
						<span class="price"><?=lang('pre_login_plano_d_valor');?></span>
						<span><?=lang('pre_login_plano_por_mes');?></span>
					</td>
				</tr>
				<!-- // Table pricing row END -->
				
				<!-- Table row -->
				<tr>
					<td class="center">
						<?=lang('pre_login_plano_recursos_a');?><br/>
						<div class="separator bottom"></div>
                                                <? if($plano_escolhido == 1)
                                                    echo '<button class="btn btn-info">'.lang('common_plano_label_titulo_seu_plano').'</button>';                                                        
                                                ?>
					</td>
					<td class="center">
						<?=lang('pre_login_plano_recursos_b');?><br/>
						<div class="separator bottom"></div>						
                                                <? if($plano_escolhido == 2)
                                                    echo '<button class="btn btn-info">'.lang('common_plano_label_titulo_seu_plano').'</button>';
                                                ?>                                                
					<td class="center">
						<?=lang('pre_login_plano_recursos_c');?><br/>
						<div class="separator bottom"></div>
                                                <? if($plano_escolhido == 3)
                                                    echo '<button class="btn btn-info">'.lang('common_plano_label_titulo_seu_plano').'</button>';
                                                ?>                                                
					</td>
					<td class="center">
						<?=lang('pre_login_plano_recursos_d');?><br/>
						<div class="separator bottom"></div>
                                                <? if($plano_escolhido == 4)
                                                    echo '<button class="btn btn-info">'.lang('common_plano_label_titulo_seu_plano').'</button>';                                                
                                                ?>                                                
					</td>
				</tr>
				<!-- // Table row END -->
				
			</tbody>
			<!-- // Table body END -->
			
		</table>
		<!-- // Pricing table END -->      
        
        
</div>
<br/>		
	