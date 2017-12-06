<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form_add").validate({
                    rules:{                       
                        titulo_db: {
                            required:true,
                            maxlength: 60
                        }                       
                    },
                     messages: {      
                        titulo_db: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        }
                     }
                }); 
                
                $("#form_edit").validate({
                    rules:{                                                        
                        titulo_db: {
                            required:true,
                            maxlength: 60
                        }                        
                    },
                     messages: {      
                        titulo_db: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        }
                     }
                });                 


            
            $('#btn-add').on('click', function(e){ // post the form ADD
              e.preventDefault();
              // Find form and submit it
              $('#form_add').submit();
            });
            
            $('#btn-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              // Find form and submit it
              $('#form_edit').submit();
            });  
            
            $('#btn-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });             
            


            });
            
            function edit_btn(id, titulo) // editar
            {                
                document.form_edit.elements['tipodb_id'].value=id;
                document.form_edit.elements['titulo_db'].value=titulo;                                   
            }
            
           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['tipodb_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>


<div class="heading-buttons">
	<h3 class="glyphicons building"><i></i> <?=$title;?></h3>
	<div class="buttons pull-right">
		<a href="#modal-add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> <?=lang('common_configuracoes_industrias_label_adicionar');?></a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
		<table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>
				<th style="width: 1%;" class="center">No.</th>
				<th><?=lang('common_label_titulo');?></th>
				<th class="right" colspan="3"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>
                    <?
                    foreach($lista_db as $lista_db_item) {                                            
                    ?>
                        <tr class="selectable">
				<td class="center"><?=$lista_db_item->id?></td>
				<td><strong><?=$lista_db_item->titulo?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="#modal-edit" data-toggle="modal" onclick="edit_btn('<?=$lista_db_item->id?>', '<?=$lista_db_item->titulo?>')"  title="<?=lang('common_label_editar');?>" class="btn-action glyphicons pencil btn-success"><i></i></a>
                                    <a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$lista_db_item->id?>', '<?=$lista_db_item->titulo?>')" title="<?=lang('common_label_remover');?>" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
				</td>
			</tr>
                        <? } ?>
            </tbody>
	</table>
</div>

<!-- Adicionar-->
<div class="modal hide fade" id="modal-add">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_industrias_label_adicionar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_add" name="form_add" method="post" action="<?=base_url();?>i/config/industry_add">
		<div class="control-group">
                    <div class="controls"><input type="text" name="titulo_db" placeholder="<?=lang('common_configuracoes_industrias_label_nome_grupo');?>" class="span3" /></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-add" class="btn btn-primary"><?=lang('common_configuracoes_industrias_label_adicionar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Adicionar FIM -->


<!-- Editar -->
<div class="modal hide fade" id="modal-edit">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_industrias_label_editar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/config/industry_edit">
                <input type="hidden" id="tipodb_id" name="tipodb_id" value="" />
		<div class="control-group">
                    <div class="controls"><input type="text" name="titulo_db" id="titulo_db" placeholder="<?=lang('common_configuracoes_industrias_label_nome_grupo');?>" class="span3" value="" /></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-edit" class="btn btn-primary"><?=lang('common_label_editar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Editar FIM -->

<!-- Remover -->
<div class="modal hide fade" id="modal-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_industrias_label_deletar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete" name="form_delete" method="post" action="<?php echo base_url();?>i/config/industry_delete">
                <input type="hidden" id="tipodb_id" name="tipodb_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_configuracoes_industrias_label_deletar_confirmar');?><br /><div id="div_html_group_delete"></div></div>
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

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	