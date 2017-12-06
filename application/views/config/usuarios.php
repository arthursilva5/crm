<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){  
            
                $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });            

                $.validator.addMethod(
                    "brasilDate",
                    function(value, element) {
                        // put your own logic here, this is just a (crappy) example
                        return value.match(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/);
                    }
                );
                                       

                $("#form_add").validate({
                    rules:{
                        nome: {
                            required:true, 
                            minlength: 2,
                            maxlength: 45
                        },
                        sobrenome: {
                            required:true
                        },
                        data_nasc: {
                            required:true,
                            brasilDate:true
                        },                        
                        email: {
                            required:true, 
                            email:true
                        },
                        senha: {
                            required:true, 
                            minlength: 6
                        },                      
                        usuario : {
                            required:true, 
                            minlength: 4,
                            maxlength: 15
                        }                        
                        
                    },
                     messages: {
                        nome: "<?=lang('pre_login_field_required');?>",
                        sobrenome: "<?=lang('pre_login_field_required');?>",
                        data_nasc: {                            
                            brasilDate: "<?=lang('pre_login_field_date_format');?>"
                        },
                        senha: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_password_minimum_size');?>"
                        },
                        email: {
                            required: "<?=lang('pre_login_field_required');?>",
                            email: "<?=lang('pre_login_field_email_correct');?>"
                        },
                        usuario: {
                            required: "<?=lang('pre_login_field_required');?>",
                            minlength: "<?=lang('pre_login_field_usuario_minlenght');?>",
                            maxlength: "<?=lang('pre_login_field_usuario_maxlenght');?>"
                            
                        }                       
                     }
                });
                
                $("#form_edit").validate({
                    rules:{
                        nome: {
                            required:true, 
                            minlength: 2,
                            maxlength: 45
                        },
                        data_nasc: {
                            required:true,
                            brasilDate:true
                        },                        
                        email: {
                            required:true, 
                            email:true
                        },
                        senha: {
                            minlength: 6
                        }                         
                    },
                     messages: {
                        nome: "<?=lang('pre_login_field_required');?>",
                        data_nasc: {                            
                            brasilDate: "<?=lang('pre_login_field_date_format');?>"
                        },
                        senha: {
                            minlength: "<?=lang('pre_login_field_password_minimum_size');?>"
                        },
                        email: {
                            required: "<?=lang('pre_login_field_required');?>",
                            email: "<?=lang('pre_login_field_email_correct');?>"
                        }                      
                     }
                });                 


            
            $('#btn-group-add').on('click', function(e){ // post the form ADD
              e.preventDefault();
              // Find form and submit it
              $('#form_add').submit();
            });
            
            $('#btn-group-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              // Find form and submit it
              $('#form_edit').submit();
            });  
            
            $('#btn-group-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });


            });
            
            function edit_btn(id, nome, email, data_nascimento, usuario, grupo_nome, chmod_nome) // editar
            {                
                document.form_edit.elements['tipodb_id'].value=id;
                document.form_edit.elements['nome'].value=nome;
                document.form_edit.elements['email'].value=email;
                document.form_edit.elements['data_nasc'].value=data_nascimento; 
                document.getElementById("div_html_user").innerHTML = '<h5>'+ usuario + '</h5>';
                document.getElementById("div_html_atual_grupo").innerHTML = grupo_nome;
                document.getElementById("div_html_atual_chmod").innerHTML = chmod_nome;
                
                
                
            }
            
           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['tipodb_id'].value=id;
                document.getElementById("div_html_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>

<div class="heading-buttons">
	<h3 class="glyphicons user"><i></i> <?=$title;?></h3>
	<div class="buttons pull-right">
		<a href="#modal-add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons user_add"><i></i> <?=lang('common_configuracoes_usuarios_label_adicionar');?></a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="innerLR">
		<table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
		<thead>
			<tr>
				<th style="width: 1%;" class="center"><?=lang('common_meusdados_label_usuario');?></th>
				<th><?=lang('common_label_nome');?></th>
				<th class="right" colspan="3"><?=lang('common_label_acoes');?></th>
			</tr>
		</thead>
		<tbody>
                    <?
                    foreach($lista_db as $lista_db_item) {                                            
                    ?>
                        <tr class="selectable">
				<td class="center"><?=$lista_db_item->usuario?></td>
				<td><strong><?=$lista_db_item->nome ?></strong></td>
				<td class="center" style="width: 60px;">
                                    <a href="#modal-edit" data-toggle="modal" onclick="edit_btn('<?=$lista_db_item->id?>', '<?=$lista_db_item->nome?>', '<?=$lista_db_item->email?>', '<?=$lista_db_item->data_nascimento?>', '<?=$lista_db_item->usuario?>', '<?=$lista_db_item->grupo_nome?>', '<?=$lista_db_item->chmod_nome?>')"  title="<?=lang('common_label_editar');?>" class="btn-action glyphicons pencil btn-success"><i></i></a>
                                    <a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$lista_db_item->id?>', '<?=$lista_db_item->usuario?>')" title="<?=lang('common_label_remover');?>" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
				</td>
			</tr>
                        <? } ?>
            </tbody>
	</table>
</div>

<!-- Adicionar -->
<div class="modal hide fade" id="modal-add">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_usuarios_label_adicionar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_add" name="form_add" method="post" action="<?php echo base_url();?>i/config/users_add">
                
		<div class="control-group">
                    <div class="controls"><input type="text" id="nome" name="nome" placeholder="<?=lang('pre_login_label_nome');?>" class="span3" value="" /></div>
                    <div class="controls"><input type="text" id="sobrenome" name="sobrenome" placeholder="<?=lang('pre_login_label_sobrenome');?>" class="span3" value="" /></div>
                    <div class="controls"><input type="email" id="email" name="email" placeholder="<?=lang('pre_login_label_email');?>" class="span3" value="" /></div>
                    <div class="controls">
                        <div class="input-append">
                                <input type="text" id="datepicker" name="data_nasc" class="span3" placeholder="<?=lang('common_meusdados_label_aniversario');?>" value="" /> 
                                <span class="add-on glyphicons calendar"><i></i></span>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_aniversario_ajuda');?>"><i></i></span>
                        </div>
                    </div>
                    <div class="controls"><input id="senha" name="senha" type="password" placeholder="<?=lang('common_meusdados_label_senha');?>" class="span3" value="" /></div>                    
                    <div class="controls"><input type="text" id="usuario" name="usuario" placeholder="<?=lang('pre_login_label_usuario');?>" class="span3" value="" /></div>                    
                    <div class="control-group">
                        <h6><?=lang('common_contas_grupo');?></h6>
                        <div>
                                <select class="selectpicker span12" name="grupo_id" id="grupo_id">
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                echo '<option value="'.$tipos_grupos_db_item->id.'">'.$tipos_grupos_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                </select>                                
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_usuarios_label_grupo_ajuda');?>"><i></i></span>
                        </div>
                    </div>  
                    <div class="control-group">
                        <h5><?=lang('common_configuracoes_usuarios_label_tipo_usuario');?></h5>
                        <div>
                                <select class="selectpicker span12" name="tipo" id="tipo">                                        
                                        <option value="2"><?=lang('common_configuracoes_usuarios_label_tipo_usuario_usuario_comum');?></option>
                                        <option value="1"><?=lang('common_configuracoes_usuarios_label_tipo_usuario_administrador');?></option>                                        
                                </select>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_usuarios_label_tipo_usuario_usuario_ajuda');?>"><i></i></span>
                        </div>
                    </div>                     
                </div>

            </form>
            <p><?=lang('common_configuracoes_usuarios_label_ajuda_cobranca');?></p>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-group-add" class="btn btn-primary"><?=lang('common_configuracoes_usuarios_label_adicionar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Adicionar FIM -->


<!-- Editar  -->
<div class="modal hide fade" id="modal-edit">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_usuarios_label_editar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/config/users_edit">
                <input type="hidden" id="tipodb_id" name="tipodb_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_meusdados_label_usuario');?>: <div id="div_html_user"></div><strong></strong><br /></div>
                    <div class="controls"><input type="text" id="nome" name="nome" class="span3" value="" /></div>                    
                    <div class="controls"><input type="email" id="email" name="email" class="span3" value="" /></div>
                    <div class="controls">
                        <div class="input-append">
                                <input type="text" id="datepicker" name="data_nasc" class="span3" placeholder="<?=lang('common_meusdados_label_aniversario');?>" value="" /> 
                                <span class="add-on glyphicons calendar"><i></i></span>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_meusdados_label_aniversario_ajuda');?>"><i></i></span>
                        </div>
                    </div>
                    <div class="controls"><input id="senha" name="senha" placeholder="<?=lang('common_meusdados_label_senha_ajuda2');?>" type="password" class="span3" value="" /></div>
                    <div class="control-group">
                        <h6><?=lang('common_contas_grupo');?></h6>
                        <p><div id="div_html_atual_grupo"></div></p>
                        <div>
                                <select class="selectpicker span12" name="grupo_id" id="grupo_id">
                                        <option value="0">- <?=lang('common_label_nao_alterar');?> - </option>
                                            <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                                echo '<option value="'.$tipos_grupos_db_item->id.'">'.$tipos_grupos_db_item->titulo.'</option>';                                               
                                            }
                                            ?>
                                </select>                                
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_usuarios_label_grupo_ajuda');?>"><i></i></span>                                
                        </div>
                    </div>                      
                    <div class="control-group">
                        <h5><?=lang('common_configuracoes_usuarios_label_tipo_usuario');?></h5>
                        <p><div id="div_html_atual_chmod"></div></p>
                        <div>
                                <select class="selectpicker span12" name="tipo" id="tipo">
                                        <option value="0">- <?=lang('common_label_nao_alterar');?> - </option>
                                        <option value="2"><?=lang('common_configuracoes_usuarios_label_tipo_usuario_usuario_comum');?></option>
                                        <option value="1"><?=lang('common_configuracoes_usuarios_label_tipo_usuario_administrador');?></option>                                        
                                </select>
                                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_configuracoes_usuarios_label_tipo_usuario_usuario_ajuda');?>"><i></i></span>
                        </div>
                    </div>                     
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
<!-- EditarFIM -->

<!-- Remover -->
<div class="modal hide fade" id="modal-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_configuracoes_usuarios_label_deletar');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete" name="form_delete" method="post" action="<?php echo base_url();?>i/config/users_delete">
                <input type="hidden" id="tipodb_id" name="tipodb_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_configuracoes_usuarios_label_deletar_confirmar');?><br /><?=lang('common_meusdados_label_usuario');?>:<div id="div_html_delete"></div></div>
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
<!-- Remover FIM -->

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>	