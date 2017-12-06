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
                document.form_view.elements['contato_id'].value=id; 
                document.forms["form_view"].submit();
            }  

           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['db_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>


<div class="heading-buttons">
	<h3 class="glyphicons nameplate"><i></i> <?=$title;?></h3>
	<div class="buttons pull-right">            
            <a href="<?=base_url(); ?>i/contacts/add" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> <?=lang('common_contatos_novo_contato');?></a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


<div class="innerLR">
		<table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>				
				<th><?=lang('common_label_nome_contato');?></th>
				<th style="width: 20%;"><?=lang('common_label_telefone');?></th>
				<th><?=lang('common_label_email');?></th>
                                <th style="width: 15%;" class="uniformjs"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>
                    
                    <?
                    foreach($lista_db as $lista_db_item) {                                            
                    ?>                    
                        <tr class="selectable">				
				<td class="important"><a style="color: #000088;" href="#" onclick="btn_view('<?=$lista_db_item->contato_id?>')" ><?=$lista_db_item->nome;?></a></td>
				<td class="important"><?=$lista_db_item->telefone;?></td>
				<td style="width: 80px;"><?=$lista_db_item->email;?></td>
                                <td class="center uniformjs">
                                    <a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$lista_db_item->contato_id?>', '<?=$lista_db_item->nome?>')" title="<?=lang('common_label_remover');?>" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
                                </td>
				
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
            <a href="<?php echo base_url();?>i/contacts/add_imported_file" class="btn btn-inverse btn-small btn-icon glyphicons circle_plus"><i></i> <?=lang('common_contatos_importar_contatos');?></a>
	</div>        
</div>


<!-- Remover -->
<div class="modal hide fade" id="modal-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_contatos_label_remover');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete" name="form_delete" method="post" action="<?php echo base_url();?>i/contacts/delete">
                <input type="hidden" id="db_id" name="db_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_contatos_label_remover_confirma');?><br /><div id="div_html_group_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-delete" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover FIM -->

<!-- Ver contato -->
<form id="form_view" name="form_view" method="post" action="<?php echo base_url();?>i/contacts/view">
    <input type="hidden" id="contato_id" name="contato_id" value="" />
</form>
<!-- fim Ver contato -->