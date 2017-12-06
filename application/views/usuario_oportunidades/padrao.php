<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
            
            $('#btn-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });             

            });
            

           function btn_view(id) // ver
            {                
                document.form_view.elements['id'].value=id; 
                document.forms["form_view"].submit();
            }  

           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['db_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>


<div class="heading-buttons">
	<h3 class="glyphicons coins"><i></i> <?=$title;?></h3>
	<div class="buttons pull-right">
		<a href="<?=base_url(); ?>i/potentials/add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> <?=lang('common_oportunidades_nova_oportunidade');?></a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


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
                    foreach($lista_db as $lista_db_item) {                                            
                    ?>                    
                        <tr class="selectable">				
				<td class="important"><a style="color: #000088;" href="#" onclick="btn_view('<?=$lista_db_item->oportunidade_id?>')" ><?=$lista_db_item->nome_potencial;?></a></td>
				<td class="important"><?=$lista_db_item->valor;?></td>
				<td style="width: 80px;"><?=$lista_db_item->estagvenda_titulo;?></td>
                                <td style="width: 80px;"><?=$lista_db_item->data_expectativa_fechar;?></td>                              
				<td style="width: 80px;"><?=$lista_db_item->conta_nome;?></td>
			</tr>
                    <? } ?>
						
                </tbody>
	</table>
	    <br />   
            <!--paginacao -->
            <div class="pagination pull-right" style="margin: 0;">
                    <?=$link_paginacao;?>
            </div>
            <!--paginacao -->            
            
            <div class="clearfix"></div>
	</div>
</div>


<!-- Ver conta -->
<form id="form_view" name="form_view" method="post" action="<?php echo base_url();?>i/potentials/view">
    <input type="hidden" id="id" name="id" value="" />
</form>
<!-- fim Ver conta -->