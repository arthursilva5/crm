<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
                         

            });
            

           function btn_view_account(id) // ver
            {                
                document.form_view_account.elements['conta_id'].value=id; 
                document.forms["form_view_account"].submit();
            } 
            
           function btn_view_potential(id) // ver
            {                
                document.form_view_potential.elements['id'].value=id; 
                document.forms["form_view_potential"].submit();
            }
            
           function btn_view_contact(id) // ver
            {                
                document.form_view_contact.elements['contato_id'].value=id; 
                document.forms["form_view_contact"].submit();
            }             
            
  
</script>


<div class="heading-buttons span7">
	<h3 class="glyphicons search"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>
    <br /><br /><br />
    <!-- Contas -->
    <h3><?=lang('common_contas_titulo');?></h3>
    <div class="innerLR">
                    <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                    <thead>
                            <tr>				
                                    <th><?=lang('common_label_nome_conta');?></th>
                                    <th><?=lang('common_label_email');?></th>
                                    <th style="width: 20%;"><?=lang('common_label_telefone');?></th>                                    
                            </tr>
                    </thead>
                    <tbody>

                        <?
                        foreach($rows_contas as $rows_contas_item) {                                            
                        ?>                    
                            <tr class="selectable">				
                                    <td class="important"><a style="color: #000088;" href="#" onclick="btn_view_account('<?=$rows_contas_item->id?>')" ><?=$rows_contas_item->conta_nome;?></a></td>
                                    <td style="width: 80px;"><?=$rows_contas_item->site;?></td>
                                    <td class="important"><?=$rows_contas_item->telefone;?></td>                                    
                            </tr>
                        <? } ?>

                    </tbody>
            </table>
            <br />          

            <div class="clearfix"></div>
    </div>
    
    <br /><br /><br />
    <!-- Oportunidades -->
    <h3><?=lang('common_oportunidades_titulo');?></h3>
    <div class="innerLR">
                    <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                    <thead>
			<tr>				
				<th><?=lang('common_oportunidades_nome_oportunidade');?></th>
				<th><?=lang('common_label_quantia');?></th>
				<th style="width: 20%;"><?=lang('common_label_etapa');?></th>
                                <th><?=lang('common_oportunidades_data_fechamento');?></th>
                                <th style="width: 20%;"><?=lang('common_label_nome_conta');?></th>
			</tr>
                    </thead>
                    <tbody>

                        <?
                        foreach($rows_potenciais as $rows_potenciais_item) {                                            
                        ?>                    
                            <tr class="selectable">				
				<td class="important"><a style="color: #000088;" href="#" onclick="btn_view_potential('<?=$rows_potenciais_item->oportunidade_id?>')" ><?=$rows_potenciais_item->nome_potencial;?></a></td>
				<td class="important"><?=$rows_potenciais_item->valor;?></td>
				<td style="width: 80px;"><?=$rows_potenciais_item->estagvenda_titulo;?></td>
                                <td style="width: 80px;"><?=$rows_potenciais_item->data_expectativa_fechar;?></td>                              
				<td style="width: 80px;"><?=$rows_potenciais_item->conta_nome;?></td>                                   
                            </tr>
                        <? } ?>

                    </tbody>
            </table>
            <br />          

            <div class="clearfix"></div>
    </div> 
    
    <br /><br /><br />
    <!-- Contatos -->
    <h3><?=lang('common_contatos_titulo');?></h3>
    <div class="innerLR">
                    <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                    <thead>
			<tr>				
				<th><?=lang('common_label_nome_contato');?></th>
				<th style="width: 20%;"><?=lang('common_label_telefone');?></th>
				<th><?=lang('common_label_email');?></th>
			</tr>
                    </thead>
                    <tbody>

                        <?
                        foreach($rows_contatos as $rows_contatos_item) {                                            
                        ?>                    
                            <tr class="selectable">				
				<td class="important"><a style="color: #000088;" href="#" onclick="btn_view_contact('<?=$rows_contatos_item->contato_id?>')" ><?=$rows_contatos_item->nome;?></a></td>
				<td class="important"><?=$rows_contatos_item->telefone;?></td>
				<td style="width: 80px;"><?=$rows_contatos_item->email;?></td>                                          
                            </tr>
                        <? } ?>

                    </tbody>
            </table>
            <br />          

            <div class="clearfix"></div>
    </div>       
    
    
    
</div>


<!-- Ver conta -->
<form id="form_view_account" name="form_view_account" method="post" action="<?php echo base_url();?>i/accounts/view">
    <input type="hidden" id="conta_id" name="conta_id" value="" />
</form>
<!-- fim Ver conta -->

<!-- Ver oportunidade -->
<form id="form_view_potential" name="form_view_potential" method="post" action="<?php echo base_url();?>i/potentials/view">
    <input type="hidden" id="id" name="id" value="" />
</form>
<!-- fim Ver oportunidade -->

<!-- Ver contato -->
<form id="form_view_contact" name="form_view_contact" method="post" action="<?php echo base_url();?>i/contacts/view">
    <input type="hidden" id="contato_id" name="contato_id" value="" />
</form>
<!-- fim Ver contato -->