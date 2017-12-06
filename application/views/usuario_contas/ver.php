<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
            
            $('#btn-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });             
            
            //NOTES
            $('#btn-note-add').on('click', function(e){
                e.preventDefault();
              $.post("<?php echo base_url();?>i/accounts/ajax_note_add", $("#form_add_note").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });
              
            });  
            
            $('#btn-note-edit').on('click', function(e){ // post the form EDIT
              e.preventDefault();
              $.post("<?=base_url();?>i/accounts/ajax_note_edit", $("#form_note_edit").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });               
            
            $('#btn-note-delete').on('click', function(){
              $.post("<?=base_url();?>i/accounts/ajax_note_delete", $("#form_note_delete").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            }); 
            // NOTES end
            
            
            //POTENTIAL
            $('#btn-delete-potential').on('click', function(){
              $.post("<?=base_url();?>i/potentials/ajax_delete", $("#form_delete_potential").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });
            
            //CONTACTS
            $('#btn-delete-contact').on('click', function(){
              $.post("<?=base_url();?>i/contacts/ajax_delete", $("#form_delete_contact").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });
            
            //ATTACHMENTS
            $('#btn-attachment-add').on('click', function(){
                if($("#form_add_attachment").valid()){ // valida o formulário
                    $('#loading_message').show();  //abre tela carregando
                    $('#form_add_attachment').submit();
                    $('#loading_message').hide(); //fecha tela carregando
                }
            }); 
            
            $('#btn-attachment-delete').on('click', function(){
              $.post("<?=base_url();?>i/files/ajax_attachment_delete", $("#form_attachment_delete").serialize()).always(function() { 
                  $('#form_atualizar_pagina').submit();
              });                        
            });
        
            
                       
                       
            
                $("#form_add_attachment").validate({
                    rules:{                                                        
                        nome: {
                            required:true
                        }                       
                             
                    },
                     messages: {      
                        nome: {
                            required: "<?=lang('common_form_campo_requerido');?>"
                        }                           
                     }
                }); // fim validade
                  
            
            
            

            });//fim function
            

           function btn_view(id) // ver
            {                
                document.form_edit.elements['conta_id'].value=id; 
                document.forms["form_edit"].submit();
            }  
           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['db_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }  
            
            

           function btn_view_potential(id) // ver potencial
            {                
                document.form_view_potential.elements['id'].value=id; 
                document.forms["form_view_potential"].submit();
            } 
           function btn_edit_potential(id) // ver
            {                                
                document.form_edit_potential.elements['id'].value=id; 
                document.forms["form_edit_potential"].submit();
            } 
           function btn_delete_potential(id, titulo) // deletar
            {                
                document.form_delete_potential.elements['db_id'].value=id;
                document.getElementById("div_html_oportunidade_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }              
            
            
           function btn_view_contact(id) // ver
            {                
                document.form_view_contact.elements['contato_id'].value=id; 
                document.forms["form_view_contact"].submit();
            } 
           function btn_edit_contact(id) // ver
            {                
                document.form_edit_contact.elements['contato_id'].value=id; 
                document.forms["form_edit_contact"].submit();
            }              
           function btn_delete_contact(id, titulo) // deletar
            {                
                document.form_delete_contact.elements['db_id'].value=id;
                document.getElementById("div_html_contact_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            } 
            
            
           function btn_delete_file(id, titulo) // deletar
            {                
                document.form_attachment_delete.elements['db_id_delete'].value=id;
                document.getElementById("div_html_attachment_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }                         
            
            
            
            function note_edit_btn(id) // editar
            {                 
                var conta_id = <?=$rows_conta->id?>;
                $('#db_id_edit').val(id); // define o id                
                
                $.post("<?=base_url();?>i/accounts/ajax_get_note_by_id", {id: id, conta_id: conta_id }, function(data) {
                  $("#div_html_anotacao_edit").html('<textarea style="width: 90%; height:200px;" name="descricao_anotacao" id="descricao_anotacao">' + data.descricao + '</textarea>');
                },"json");                      
                         
            }

           function note_delete_btn(id) // deleta a anotacao
            {
                var conta_id = <?=$rows_conta->id?>;
                $('#db_id_delete').val(id); // define o id  
                
                $.post("<?=base_url();?>i/accounts/ajax_get_note_by_id", {id: id, conta_id: conta_id }, function(data) {
                  $("#div_html_anotacao_delete").html('<strong>' + data.descricao.substring(0,144) + '...</strong>');
                },"json");
                              
            }             
            
  
</script>

<div class="heading-buttons">
	<h3 class="glyphicons building span8"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="menubar">
	<ul>
		<li><a href="<?php echo base_url();?>i/accounts"><?=lang('common_contas_titulo');?></a> </li>
                <li class="divider"></li>            
		<li><a href="#" onclick="btn_view('<?=$rows_conta->id?>')"><?=lang('common_label_editar');?></a> </li>
                <li class="divider"></li>
		<li><a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$rows_conta->id?>', '<?=$rows_conta->conta_nome?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_remover');?></a></li>
		<li class="divider"></li>
	</ul>
</div>
<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    

		<div class="widget-body" style="padding: 10px 0 0;">
		
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_informacoes');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label strong" style="color: #710909;"><?=lang('common_label_nome_conta');?></label>
                                    <div class="controls"><?=$rows_conta->conta_nome;?></div>
                            </div>
                             <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_numero');?></label>
                                    <div class="controls"><?=$rows_conta->conta_numero;?></div>
                            </div>
                              <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_tipo');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_contas_db as $tipos_contas_db_item) { 
                                                //confere o item
                                                if($tipos_contas_db_item->id == $rows_conta->tipo_conta_id)
                                                    echo ''.$tipos_contas_db_item->titulo.'';                                                          
                                            }
                                            ?>
                                    </div>
                            </div>
                               <hr class="separator" />
                               
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_industria');?></label>
                                    <div class="controls">
                                            <? foreach($tipos_industrias_db as $tipos_industrias_db_item) { 
                                                //confere o item
                                                if($tipos_industrias_db_item->id == $rows_conta->industria_id)
                                                    echo ''.$tipos_industrias_db_item->titulo.'';
                                            }
                                            ?>
                                    </div>
                            </div> 
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_receita_anual');?></label>
                                    <div class="controls">
                                        <?=$rows_conta->receita_anual;?>                                    
                                    </div>
                                    
                            </div>
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_criado_por');?></label>
                                    <div class="controls">
                                        <?=$rows_conta->usuario_nome;?> (<?=$rows_conta->usuario_usuario;?>) - <?=$rows_conta->data_cadastro;?>  
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?=lang('common_contas_data_cadastro_ajuda');?>"><i></i></span>
                                    </div>
                                    
                            </div>                             
                                                     
			
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_telefone');?></label>
                                    <div class="controls"><?=$rows_conta->telefone;?></div>
                            </div>
                             <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_site');?></label>
                                    <div class="controls"><?=$rows_conta->site;?></div>
                            </div>
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_grupo');?></label>
                                    <div class="controls">
                                        <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                            //confere o item
                                            if($tipos_grupos_db_item->id == $rows_conta->grupo_id)
                                                echo ''.$tipos_grupos_db_item->titulo.'';
                                        }
                                        ?>                                        
                                    </div>
                            </div>                            
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_propriedade');?></label>
                                    <div class="controls">
                                        <?
                                        if($rows_conta->compartilhar == 1)
                                            echo lang('common_contas_propriedade_privado');
                                        elseif ($rows_conta->compartilhar == 2)
                                            echo lang('common_contas_propriedade_grupo');
                                        elseif ($rows_conta->compartilhar == 3)
                                            echo lang('common_contas_propriedade_publico');                                        
                                        ?>                                        
                                    </div>
                            </div>
                              <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_funcionarios');?></label>
                                    <div class="controls"><?=$rows_conta->funcionarios;?></div>
                            </div>                           				
			
			</div>
			</div>
                   
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_informacao_endereco');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span6">			

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_endereco');?></label>
                                    <div class="controls"><?=$rows_conta->endereco;?></div>
                            </div>   
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_cidade');?></label>
                                    <div class="controls"><?=$rows_conta->cidade_nome;?></div>
                            </div>                                                    
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_endereco_numero');?></label>
                                    <div class="controls"><?=$rows_conta->end_numero;?></div>
                            </div>  			 	
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_endereco_complemento');?></label>
                                    <div class="controls"><?=$rows_conta->end_complemento;?></div>
                            </div>  	                
                             <hr class="separator" />
                             
                           <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_cep');?></label>
                                    <div class="controls"><?=$rows_conta->end_cep;?></div>
                            </div>                             
                            
			</div>
			</div>                    
                        <!-- fim GRUPO -->                    
                    
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_midia_social');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span6">			

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_linkedin');?></label>
                                    <div class="controls"><?=$rows_conta->linkedin;?></div>
                            </div>
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_facebook');?></label>
                                    <div class="controls"><?=$rows_conta->facebook;?></div>
                            </div>                            
	
			</div>
			<div class="span6">
			
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contas_twitter');?></label>
                                    <div class="controls"><?=$rows_conta->twitter;?></div>
                            </div>  			
			
			</div>
			</div>                    
                        <!-- fim GRUPO -->
                        
                        <!-- GRUPO  -->
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contas_descricao_meta_tags');?></h4></div>
				<div class="separator"></div>
			</div>                     
                    
			<div class="row-fluid">
                           
			<div class="span12">			

                            <div class="control-group">
                                    <label class="control-label strong">
                                        <h4 class="heading"><?=lang('common_contas_meta_tags');?></h4>
                                        
                                    </label>
                                    <div class="controls"><?=$rows_conta->tags;?></div>
                            </div> 
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><h4 class="heading"><?=lang('common_contas_descricao');?></h4></label>
                                    <div class="controls"><?=nl2br($rows_conta->descricao);?></div>
                            </div>                                                       
	
			</div>
			</div>  
                        <br /><br />
                        <!-- fim GRUPO -->
		</div>
    
                <!-- anotacoes -->
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
                    <!-- anotacoes fim -->

                    <div class="separator bottom"></div>

                    <!-- Potentials -->
                    <div class="widget widget-4">
                        <div class="widget-head"><h4 class="heading"><?=lang('common_oportunidades_titulo');?></h4></div>
                            <br />
                            <div class="buttons pull-right">
                                    <a href="<?=base_url(); ?>i/potentials/add" class="btn btn-info btn-small btn-icon glyphicons circle_plus"><i></i> <?=lang('common_oportunidades_nova_oportunidade');?></a>
                            </div> 
                            <br />
                            <div class="widget-body">
                                    <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                                    <thead>
                                            <tr>				
                                                    <th style="width: 15%;" class="center uniformjs"><?=lang('common_label_acoes');?></th>                                                
                                                    <th><?=lang('common_oportunidades_nome_oportunidade');?></th>
                                                    <th style="width: 20%;"><?=lang('common_label_quantia');?></th>
                                                    <th><?=lang('common_label_etapa');?></th>
                                                    <th><?=lang('common_oportunidades_data_fechamento');?></th>                                                    
                                            </tr>
                                    </thead>
                                    <tbody>

                                        <?
                                        foreach($rows_oportunidades as $rows_oportunidades_item) {                                            
                                        ?>                    
                                            <tr class="selectable">				
                                                    <td class="center uniformjs">
                                                        <a href="#" title="<?=lang('common_label_editar');?>" onclick="btn_edit_potential('<?=$rows_oportunidades_item->oportunidade_id?>')"><?=lang('common_label_editar');?></a> | 
                                                        <a href="#modal-delete-potential" data-toggle="modal" onclick="btn_delete_potential('<?=$rows_oportunidades_item->oportunidade_id?>', '<?=$rows_oportunidades_item->nome_potencial;?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_del');?></a>
                                                    </td>                                                
                                                    <td class="important"><a style="color: #000088;" href="#" onclick="btn_view_potential('<?=$rows_oportunidades_item->oportunidade_id?>')" ><?=$rows_oportunidades_item->nome_potencial;?></a></td>
                                                    <td class="important"><?=$rows_oportunidades_item->valor;?></td>
                                                    <td style="width: 100px;"><?=$rows_oportunidades_item->estagvenda_titulo;?></td>
                                                    <td><?=$rows_oportunidades_item->data_expectativa_fechar;?></td>

                                            </tr>
                                        <? } ?>

                                    </tbody>
                            </table>
                            </div>
                    </div>
                    <!-- fim Potentials -->
                    
                    <div class="separator bottom"></div>

                    <!-- Contacts -->
                    <div class="widget widget-4">
                        <div class="widget-head"><h4 class="heading"><?=lang('common_contatos_titulo');?></h4></div>
                            <br />
                            <div class="buttons pull-right">
                                    <a href="<?=base_url(); ?>i/contacts/add" class="btn btn-info btn-small btn-icon glyphicons circle_plus"><i></i> <?=lang('common_contatos_novo_contato');?></a>
                            </div> 
                            <br />
                            <div class="widget-body">
                            <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                                    <thead>
                                            <tr>				
                                                    <th style="width: 15%;" class="uniformjs"><?=lang('common_label_acoes');?></th>                                                
                                                    <th><?=lang('common_label_nome_contato');?></th>
                                                    <th style="width: 20%;"><?=lang('common_contatos_label_cargo');?></th>
                                                    <th style="width: 20%;"><?=lang('common_label_telefone');?></th>
                                                    <th><?=lang('common_label_email');?></th>
                                            </tr>
                                    </thead>
                                    <tbody>

                                        <?
                                        foreach($rows_contatos as $rows_contatos_item) {                                            
                                        ?>                    
                                            <tr class="selectable">				
                                                    <td class="center uniformjs">
                                                        <a href="#" title="<?=lang('common_label_editar');?>" onclick="btn_edit_contact('<?=$rows_contatos_item->contato_id?>')"><?=lang('common_label_editar');?></a> | 
                                                        <a href="#modal-delete-contact" data-toggle="modal" onclick="btn_delete_contact('<?=$rows_contatos_item->contato_id?>', '<?=$rows_contatos_item->nome?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_del');?></a>
                                                    </td>                                                     
                                                    <td class="important"><a style="color: #000088;" href="#" onclick="btn_view_contact('<?=$rows_contatos_item->contato_id?>')" ><?=$rows_contatos_item->nome;?></a></td>
                                                    <td class="important"><?=$rows_contatos_item->cargo;?></td>
                                                    <td class="important"><?=$rows_contatos_item->telefone;?></td>
                                                    <td style="width: 80px;"><?=$rows_contatos_item->email;?></td>
                                            </tr>
                                        <? } ?>

                                    </tbody>
                            </table>
                            </div>
                    </div>
                    <!-- fim contacts --> 
                    
                    <!-- Files -->
                    <div class="widget widget-4">
                        <div class="widget-head"><h4 class="heading"><?=lang('common_anexos_titulo');?></h4></div>
                            <br />
                            <div class="buttons pull-right">
                                    <a href="#modal-attachment-add" data-toggle="modal" class="btn btn-info btn-small btn-icon glyphicons file"><i></i> <?=lang('common_anexos_novo_anexo');?></a>
                            </div> 
                            <br />
                            <div class="widget-body">
                            <table class="table table-bordered table-condensed table-striped table-vertical-center checkboxs js-table-sortable">
                                    <thead>
                                            <tr>				
                                                    <th style="width: 8%;" class="uniformjs"><?=lang('common_label_acoes');?></th>                                                
                                                    <th><?=lang('common_anexos_nome_arquivo');?></th>
          
                                                    <th><?=lang('common_label_download');?></th>
                                            </tr>
                                    </thead>
                                    <tbody>

                                        <?
                                        foreach($rows_arquivos as $rows_arquivos_item) {                                            
                                        ?>                    
                                            <tr class="selectable">				
                                                    <td class="center uniformjs">                                                        
                                                        <a href="#modal-attachment-delete" data-toggle="modal" onclick="btn_delete_file('<?=$rows_arquivos_item->id?>', '<?=$rows_arquivos_item->nome?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_del');?></a>
                                                    </td>                                                     
                                                    <td class="important"><a style="color: #000088;" href="<?=base_url();?>i/files/download_attachment_file?conta_id=<?=$rows_conta->id?>&id=<?=$rows_arquivos_item->id?>"><?=$rows_arquivos_item->nome;?></a></td>      
                                                    <td style="width: 80px;"><a href="<?=base_url();?>i/files/download_attachment_file?conta_id=<?=$rows_conta->id?>&id=<?=$rows_arquivos_item->id?>" class="glyphicons no-js download_alt"><i></i><?=lang('common_label_download');?></a></td>
                                            </tr>
                                        <? } ?>

                                    </tbody>
                            </table>
                            </div>
                    </div>
                    <!-- fim files -->                     
                    
                    
	</div><!-- div conteudo -->		
</div>

<!-- Remover -->
<div class="modal hide fade" id="modal-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_contas_label_remover');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete" name="form_delete" method="post" action="<?php echo base_url();?>i/accounts/delete">
                <input type="hidden" id="db_id" name="db_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_contas_label_remover_confirma');?><br /><div id="div_html_group_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-delete" class="btn btn-danger"><?=lang('common_contas_label_remover_confirma_btn');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover FIM -->

<!-- Ver conta -->
<form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/accounts/edit">
    <input type="hidden" id="conta_id" name="conta_id" value="" />
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
            <form id="form_add_note" name="form_add_note" method="post">
		<input type="hidden" id="db_id" name="db_id" value="<?=$rows_conta->id?>" />
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
                <input type="hidden" id="db_id" name="db_id" value="<?=$rows_conta->id?>" />
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
            <form id="form_note_delete" name="form_note_delete" method="post">
                <input type="hidden" id="db_id" name="db_id" value="<?=$rows_conta->id?>" />
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

<!-- Ver oportunidade -->
<form id="form_view_potential" name="form_view_potential" method="post" action="<?php echo base_url();?>i/potentials/view">
    <input type="hidden" id="id" name="id" value="" />
</form>
<!-- fim oportunidade -->

<!-- editar oportunidade -->
<form id="form_edit_potential" name="form_edit_potential" method="post" action="<?php echo base_url();?>i/potentials/edit">
    <input type="hidden" id="id" name="id" value="" />
</form>
<!-- fim editar oportunidade -->

<!-- Remover oportunidade -->
<div class="modal hide fade" id="modal-delete-potential">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_oportunidades_label_remover');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete_potential" name="form_delete_potential" method="post">
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
		<a href="#" id="btn-delete-potential" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover oportunidade FIM -->


<!-- Ver CONTATO -->
<form id="form_view_contact" name="form_view_contact" method="post" action="<?php echo base_url();?>i/contacts/view">
    <input type="hidden" id="contato_id" name="contato_id" value="" />
</form>
<!-- fim Ver CONTATO -->
<!-- Ver conta -->
<form id="form_edit_contact" name="form_edit_contact" method="post" action="<?php echo base_url();?>i/contacts/edit">
    <input type="hidden" id="contato_id" name="contato_id" value="" />
</form>
<!-- fim Ver conta -->
<!-- Remover CONTATO -->
<div class="modal hide fade" id="modal-delete-contact">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_contatos_label_remover');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_delete_contact" name="form_delete_contact" method="post">
                <input type="hidden" id="db_id" name="db_id" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_contatos_label_remover_confirma');?><br /><div id="div_html_contact_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-delete-contact" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover CONTATO FIM -->

<!-- Adicionar anexo -->
<div class="modal hide fade" id="modal-attachment-add">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_anexos_novo_anexo');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_add_attachment" name="form_add_attachment" method="post" enctype="multipart/form-data" action="<?=base_url();?>i/files/add_attachment_file">                
		<input type="hidden" id="db_id" name="db_id" value="<?=$rows_conta->id?>" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_anexos_nome_arquivo');?>: <br /><input type="text" name="nome" id="nome" placeholder="<?=lang('common_anexos_nome_arquivo');?>" class="span3" /></div>
                </div>                
                <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                        <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new"><?=lang('common_label_selecionar_arquivo');?></span><span class="fileupload-exists"><?=lang('common_label_mudar');?></span><input type="file" name="arquivo" id="arquivo" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?=lang('common_label_remover');?></a>
                        </div>
                </div>
                <div id='loading_message' class="pull-right" style='display:none; margin-right:20%; '>
                            <img src="<?=base_url(); ?>common/theme/images/icons/ajax-loader.gif"/> <?=lang('common_newsletter_email_enviando_emails');?>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('header_label_fechar');?></a> 
		<a href="#" id="btn-attachment-add" class="btn btn-primary"><?=lang('common_label_salvar');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Adicionar anexo FIM -->

<!-- Remover Anexo -->
<div class="modal hide fade" id="modal-attachment-delete">
	
	<!-- Modal heading -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?=lang('common_anexos_remover_arquivo');?></h3>
	</div>
	<!-- // Modal heading END -->
	
	<!-- Modal body -->
	<div class="modal-body">
            <form id="form_attachment_delete" name="form_attachment_delete" method="post">
                <input type="hidden" id="db_id" name="db_id" value="<?=$rows_conta->id?>" />
                <input type="hidden" id="db_id_delete" name="db_id_delete" value="" />
		<div class="control-group">
                    <div class="controls"><?=lang('common_anexos_remover_arquivo_confirma');?><br /><div id="div_html_attachment_delete"></div></div>
                </div>
            </form>
	</div>
	<!-- // Modal body END -->
	
	<!-- Modal footer -->
	<div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('common_label_cancelar');?></a> 
		<a href="#" id="btn-attachment-delete" class="btn btn-danger"><?=lang('common_label_remover');?></a>
	</div>
	<!-- // Modal footer END -->
	
</div>
<!-- Remover Anexo FIM -->


<!-- form atualizar pagina -->
<form id="form_atualizar_pagina" name="form_atualizar_pagina" method="post" action="<?php echo base_url();?>i/accounts/view">
    <input type="hidden" id="conta_id" name="conta_id" value="<?=$rows_conta->id?>" />
</form>
<!-- fim form update page -->

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>