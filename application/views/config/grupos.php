<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           

                $("#form_add_group").validate({
                    rules:{                       
                        titulo_grupo: {
                            required:true,
                            maxlength: 60
                        }                       
                    },
                     messages: {      
                        titulo_grupo: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        }
                     }
                }); 
                
                $("#form_edit_group").validate({
                    rules:{                                                        
                        titulo_grupo: {
                            required:true,
                            maxlength: 60
                        }                        
                    },
                     messages: {      
                        titulo_grupo: {
                            required: "<?=lang('common_form_campo_requerido');?>",
                            maxlength: "<?=lang('common_form_campo_max_digitos');?>"
                        }
                     }
                });                 


            
            $('#btn-group-add').on('click', function(e){ // post the form GROUP ADD
              e.preventDefault();
              // Find form and submit it
              $('#form_add_group').submit();
            });
            
            $('#btn-group-edit').on('click', function(e){ // post the form GROUP EDIT
              e.preventDefault();
              // Find form and submit it
              $('#form_edit_group').submit();
            });  
            
            $('#btn-group-delete').on('click', function(e){ // post the form GROUP DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete_group').submit();
            });             
            


            });
            
            function edit_group(id, titulo) // editar o grupo
            {                
                document.form_edit_group.elements['group_id'].value=id;
                document.form_edit_group.elements['titulo_grupo'].value=titulo;                                   
            }
            
           function delete_group(id, titulo) // deletar o grupo
            {                
                document.form_delete_group.elements['group_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>

<div class="heading-buttons">
	<h3 class="glyphicons group"><i></i> <?=$title;?></h3>
	<div class="buttons pull-right">
		<a href="#modal-group-add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> <?=lang('common_configuracoes_grupos_label_adicionar');?></a>
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
                    foreach($grupos_lista as $grupos_lista_item) {                                            
                    ?>
                        <tr class="selectable">
				<td class="center"><?=$grupos_lista_item->id?></td>
				<td><strong><?=$grupos_lista_item->titulo?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="#modal-group-edit" data-toggle="modal" onclick="edit_group('<?=$grupos_lista_item->id?>', '<?=$grupos_lista_item->titulo?>')"  title="<?=lang('common_label_editar');?>" class="btn-action glyphicons pencil btn-success"><i></i></a>
                                    <a href="#modal-group-delete" data-toggle="modal" onclick="delete_group('<?=$grupos_lista_item->id?>', '<?=$grupos_lista_item->titulo?>')" title="<?=lang('common_label_remover');?>" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
				</td>
			</tr>
                        <? } ?>
            </tbody>
	</table>
</div>

<!-- Adicionar Grupo -->
<div class="modal hide fade" id="modal-group-add">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_grupos_label_adicionar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_add_group" name="form_add_group" method="post" action="<?php echo base_url();?>i/config/groups_add">
		<div class="control-group">
                    <div class="controls"><input type="text" name="titulo_grupo" placeholder="<?=lang('common_configuracoes_grupos_label_nome_grupo');?>" class="span3" /></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-group-add" class="btn btn-primary"><?=lang('common_configuracoes_grupos_label_adicionar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Adicionar Grupo FIM -->


<!-- Editar Grupo -->
<div class="modal hide fade" id="modal-group-edit">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_grupos_label_editar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_edit_group" name="form_edit_group" method="post" action="<?php echo base_url();?>i/config/groups_edit">
                <input type="hidden" id="group_id" name="group_id" value="" />
		<div class="control-group">
                    <div class="controls"><input type="text" name="titulo_grupo" id="titulo_grupo" placeholder="<?=lang('common_configuracoes_grupos_label_nome_grupo');?>" class="span3" value="" /></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-group-edit" class="btn btn-primary"><?=lang('common_label_editar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Editar Grupo FIM -->

<!-- Remover Grupo -->
<div class="modal hide fade" id="modal-group-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_grupos_label_deletar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete_group" name="form_delete_group" method="post" action="<?php echo base_url();?>i/config/groups_delete">
                <input type="hidden" id="group_id" name="group_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_configuracoes_grupos_label_deletar_confirmar');?><br /><div id="div_html_group_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-group-delete" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover Grupo FIM -->

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	