<script charset="utf-8">
       
              
        $(document).ready(function(){                                  
    
            $('#btn-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });  
            
            
            $('#btn-note-add').on('click', function(e){
                e.preventDefault();
              $.post("<?php echo base_url();?>i/potentials/ajax_note_add", $("#form_add_note").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });
              
            });  
            
            $('#btn-note-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              $.post("<?=base_url();?>i/potentials/ajax_note_edit", $("#form_note_edit").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });               
            
            $('#btn-note-delete').on('click', function(){
              $.post("<?=base_url();?>i/potentials/ajax_note_delete", $("#form_note_delete").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });              
            
 
            }); //fim ready

                       
           function btn_view(id) // ver
            {                                
                document.form_edit.elements['id'].value=id; 
                document.forms["form_edit"].submit();
            }
            
           function btn_view_account(id) // ver
            {                                
                document.form_view_account.elements['conta_id'].value=id; 
                document.forms["form_view_account"].submit();
            }              

           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['db_id'].value=id;
                document.getElementById("div_html_oportunidade_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
            
            function note_edit_btn(id) // editar
            {                 
                var oportunidade_id = <?=$rows->oportunidade_id?>;
                $('#db_id_edit').val(id); // define o id                
                
                $.post("<?=base_url();?>i/potentials/ajax_get_note_by_id", {id: id, oportunidade_id: oportunidade_id }, function(data) {
                  $("#div_html_anotacao_edit").html('<textarea style="width: 90%; height:200px;" name="descricao_anotacao" id="descricao_anotacao">' + data.descricao + '</textarea>');
                },"json");                      
                         
            }

           function note_delete_btn(id) // deleta a anotacao
            {
                var oportunidade_id = <?=$rows->oportunidade_id?>;
                $('#db_id_delete').val(id); // define o id  
                
                $.post("<?=base_url();?>i/potentials/ajax_get_note_by_id", {id: id, oportunidade_id: oportunidade_id }, function(data) {
                  $("#div_html_anotacao_delete").html('<strong>' + data.descricao.substring(0,144) + '...</strong>');
                },"json");
                              
            } 
            
            
  
</script>

<div class="heading-buttons">
	<h3 class="glyphicons coins span8"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="menubar">
	<ul>
                <? if($rows->conta_id != NULL){ //link para a conta se tiver definida ?>
		<li><a href="#" onclick="btn_view_account('<?=$rows->conta_id?>')"><?=lang('common_contas_detalhes_conta');?></a> </li>
                <li class="divider"></li>            
                <? } ?>
		<li><a href="<?php echo base_url();?>i/potentials"><?=lang('common_oportunidades_titulo');?></a> </li>
                <li class="divider"></li>            
		<li><a href="#" onclick="btn_view('<?=$rows->oportunidade_id?>')"><?=lang('common_label_editar');?></a> </li>
                <li class="divider"></li>
		<li><a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$rows->oportunidade_id?>', '<?=$rows->nome_potencial?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_remover');?></a></li>
		<li class="divider"></li>
	</ul>
</div>
<div class="innerLR">
<div class="widget widget-gray widget-body-white">
   
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_oportunidades_informacao');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label strong" style="color: #710909;">*<?=lang('common_oportunidades_nome_oportunidade');?></label>
                                    <div class="controls"><?=$rows->nome_potencial;?></div>
                            </div>
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong" style="color: #710909;"><?=lang('common_label_conta');?></label>
                                    <div class="controls">
                                            <? foreach($nomes_contas_db as $nomes_contas_db_item) {                                                
                                                if($nomes_contas_db_item->id == $rows->conta_id)
                                                    echo $nomes_contas_db_item->conta_nome;                                               
                                            }
                                            ?>                         
                                    </div>
                            </div>  
                            <hr class="separator" />                            
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_tipo');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_negocio_db as $tipos_negocio_db_item) {
                                                if($tipos_negocio_db_item->id == $rows->tipo_negocio)
                                                    echo $tipos_negocio_db_item->titulo;                                                
                                            }
                                            ?>
                                    </div>
                            </div>                             
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_oportunidades_proximo_passo');?></label>
                                    <div class="controls"><?=$rows->proximo_passo;?></div>
                            </div>
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_oportunidades_fonte_contato');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_fontes_contato_db as $tipos_fontes_contato_db_item) {
                                                if($tipos_fontes_contato_db_item->id == $rows->tipo_fonte)
                                                    echo $tipos_fontes_contato_db_item->titulo;                                                 
                                            }
                                            ?>
                                    </div>
                            </div> 
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_criado_por');?></label>
                                    <div class="controls">
                                        <?=$rows->usuario_dono_nome;?> (<?=$rows->usuario_dono_usuario;?>) - <?=$rows->data_cadastro;?>  
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_data_cadastro_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>                             
                                              
			
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                <label class="control-label strong"><?=lang('common_label_quantia');?></label>
                                <div class="controls"><?=$rows->valor;?></div>                            
                            </div>  
                            <hr class="separator" />
                            
                            <div class="control-group">
                                <label class="control-label strong" style="color: #710909;">* <?=lang('common_oportunidades_data_fechamento');?></label>
                                <div class="controls"><?=$rows->data_expectativa_fechar;?></div>                                
                            </div>                              
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong" style="color: #710909;"><?=lang('common_label_etapa');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_estagio_venda_db as $tipos_estagio_venda_db_item) { 
                                                if($tipos_estagio_venda_db_item->id == $rows->tipo_estagio_venda)
                                                    echo $tipos_estagio_venda_db_item->titulo;                                                                                               
                                            }
                                            ?>
                                    </div>
                            </div>                                                       
                            <hr class="separator" />
                            
                            <? if($this->session->userdata('chmod') == 'rwxrwxrwx') { //administrador ?>
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_grupo');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                
                                                if($tipos_grupos_db_item->id == $rows->grupo_id)
                                                    echo $tipos_grupos_db_item->titulo;                                                                                                 
                                            }
                                            ?>
                                    </div>
                            </div>                            
                            <? } else echo '<input type="hidden"  id="grupo" name="grupo" value="'.$this->session->userdata('grupoid').'">'; ?>
                            <hr class="separator" />                            


                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_propriedade');?></label>
                                    <div class="controls">
                                        <?
                                        if($rows->compartilhar == 1)
                                            echo lang('common_contas_propriedade_privado');
                                        elseif ($rows->compartilhar == 2)
                                            echo lang('common_contas_propriedade_grupo');
                                        elseif ($rows->compartilhar == 3)
                                            echo lang('common_contas_propriedade_publico');                                        
                                        ?>  
                                    </div>
                            </div>                         				
                            <hr class="separator" />
                            
			</div>                            
                            <div class="control-group span12">
                                    <label class="control-label strong"><?=lang('common_contas_descricao');?></label>
                                    <div class="controls"><?=nl2br($rows->descricao);?></div>
                            </div>                             
			</div>
                    
                    
                        <div class="widget widget-4">
                                    <div class="widget-head"><h4 class="heading"><?=lang('common_label_anotacoes');?></h4></div>
                                    <br />
                                    <div class="buttons pull-right">
                                            <a href="#modal-note-add" data-toggle="modal" class="btn btn-primary btn-small btn-icon glyphicons circle_plus"><i></i> <?=lang('common_label_adicionar_anotacao');?></a>
                                    </div>                                       
                                    <br />
                                    <div class="widget-body">
                                            <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <div id="div_html_anotacao_listar"></div>
                                                        <?
                                                        foreach($lista_anotacoes as $lista_anotacoes_item) { 
                                                            ?>
                                                            <tr>
                                                            <td>
                                                            <?=nl2br($lista_anotacoes_item->descricao);?><br />
                                                            <span style="color:blue;" class="pull-right"> <?=$lista_anotacoes_item->data_cadastro;?> &nbsp;&nbsp;
                                                            <a href="#modal-note-edit" data-toggle="modal" onclick="note_edit_btn('<?=$lista_anotacoes_item->id;?>')" ><?=lang('common_label_editar');?></a>
                                                            <a href="#modal-note-delete" data-toggle="modal" onclick="note_delete_btn('<?=$lista_anotacoes_item->id;?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_remover');?></a>
                                                            </span>
                                                            </td>
                                                            </tr>
                                                           <?
                                                        }
                                                        ?>                                                          
                                                    </tbody>
                                            </table>
                                    </div>
                            </div>
                    
                    
                    
		</div>	
	</div>		
</div>

<!-- Remover -->
<div class="modal hide fade" id="modal-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_oportunidades_label_remover');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete" name="form_delete" method="post" action="<?php echo base_url();?>i/potentials/delete">
                <input type="hidden" id="db_id" name="db_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_oportunidades_label_remover_confirma');?><br /><div id="div_html_oportunidade_delete"></div></div>
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

<!-- Ver conta -->
<form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/potentials/edit">
    <input type="hidden" id="id" name="id" value="" />
</form>
<!-- fim Ver conta -->


<!-- Adicionar anotacao -->
<div class="modal hide fade" id="modal-note-add">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_label_adicionar_anotacao');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_add_note" name="form_add_note" method="post" action="<?php echo base_url();?>i/potentials/ajax_note_add">
		<input type="hidden" id="db_id" name="db_id" value="<?=$rows->oportunidade_id?>" />
                <div class="control-group">
                    <div class="controls"><textarea style="width: 90%;" name="descricao_anotacao" id="descricao_anotacao"></textarea></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-note-add" class="btn btn-primary"><?=lang('common_label_salvar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Adicionar anotacao FIM -->


<!-- Editar Anotacao -->
<div class="modal hide fade" id="modal-note-edit">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_label_anotacoes');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_note_edit" name="form_note_edit" method="post">
                <input type="hidden" id="oportunidade_id" name="oportunidade_id" value="<?=$rows->oportunidade_id?>" />
                <input type="hidden" id="db_id_edit" name="db_id_edit" value="" />
		<div class="control-group">         
                    <div class="controls"><div id="div_html_anotacao_edit"></div> </div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-note-edit" class="btn btn-primary"><?=lang('common_label_editar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Editar Anotacao FIM -->

<!-- Remover -->
<div class="modal hide fade" id="modal-note-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_label_remover_anotacao');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_note_delete" name="form_note_delete" method="post" action="<?php echo base_url();?>i/config/groups_delete">
                <input type="hidden" id="oportunidade_id" name="oportunidade_id" value="<?=$rows->oportunidade_id?>" />
                <input type="hidden" id="db_id_delete" name="db_id_delete" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_anotacoes_label_remover_confirma');?><br /><div id="div_html_anotacao_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-note-delete" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover FIM -->

<!-- Ver conta -->
<form id="form_view_account" name="form_view_account" method="post" action="<?php echo base_url();?>i/accounts/view">
    <input type="hidden" id="conta_id" name="conta_id" value="" />
</form>
<!-- fim Ver conta -->

<!-- form atualizar pagina -->
<form id="form_atualizar_pagina" name="form_atualizar_pagina" method="post" action="<?php echo base_url();?>i/potentials/view">
    <input type="hidden" id="id" name="id" value="<?=$rows->oportunidade_id?>" />
</form>
<!-- fim form update page -->

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>