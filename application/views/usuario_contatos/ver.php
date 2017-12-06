<script type="text/javascript" charset="utf-8">
       
              
        $(document).ready(function(){           
            
            $('#btn-delete').on('click', function(e){ // post the form DELETE
              e.preventDefault();
              // Find form and submit it
              $('#form_delete').submit();
            });             

            });
            

           function btn_view_account(id) // ver
            {                                
                document.form_view_account.elements['conta_id'].value=id; 
                document.forms["form_view_account"].submit();
            } 
           function btn_view(id) // ver
            {                
                document.form_edit.elements['contato_id'].value=id; 
                document.forms["form_edit"].submit();
            }  

           function delete_btn(id, titulo) // deletar
            {                
                document.form_delete.elements['db_id'].value=id;
                document.getElementById("div_html_group_delete").innerHTML = '<h3>'+ titulo + '</h3>';                                
            }            
            
  
</script>

<div class="heading-buttons">
	<h3 class="glyphicons building span8"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="menubar">
	<ul>
                <? if($rows->conta_id != NULL){ //link para a conta se tiver definida ?>
		<li><a href="#" onclick="btn_view_account('<?=$rows->conta_id?>')"><?=lang('common_contas_detalhes_conta');?></a> </li>
                <li class="divider"></li>            
                <? } ?>            
		<li><a href="<?php echo base_url();?>i/accounts"><?=lang('common_contas_titulo');?></a> </li>
                <li class="divider"></li>            
		<li><a href="#" onclick="btn_view('<?=$rows->contato_id?>')"><?=lang('common_label_editar');?></a> </li>
                <li class="divider"></li>
		<li><a href="#modal-delete" data-toggle="modal" onclick="delete_btn('<?=$rows->id?>', '<?=$rows->nome?>')" title="<?=lang('common_label_remover');?>"><?=lang('common_label_remover');?></a></li>
		<li class="divider"></li>
	</ul>
</div>
<div class="innerLR">
<div class="widget widget-gray widget-body-white">        
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contatos_informacao');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span6">
			
			
                            <div class="control-group">
                                    <label class="control-label strong" style="color: #710909;">*<?=lang('common_label_nome');?></label>
                                    <div class="controls"><?=$rows->nome;?></div>
                            </div>
                            <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_contatos_label_cargo');?></label>
                                    <div class="controls"><?=$rows->cargo;?></div>
                            </div>
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_telefone');?></label>
                                    <div class="controls"><?=$rows->telefone;?></div>
                            </div>                               
                             <hr class="separator" />
                             
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_celular');?></label>
                                    <div class="controls"><?=$rows->celular;?></div>
                            </div>   
                             <hr class="separator" />
                             
                            <div class="control-group">
                                <label class="control-label strong"><?=lang('common_label_aniversario');?></label>
                                <div class="controls"><?=$rows->data_nascimento;?></div>
                            </div> 
                
                             
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
                                    <label class="control-label strong"><?=lang('common_label_conta');?></label>
                                    <div class="controls">
                                            <? foreach($nomes_contas_db as $nomes_contas_db_item) {
                                                //confere o item
                                                if($nomes_contas_db_item->id == $rows->conta_id)
                                                    echo $nomes_contas_db_item->conta_nome;                                               
                                            }
                                            ?>  
                                    </div>
                            </div>
                            <hr class="separator" />

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_email');?></label>
                                    <div class="controls"><?=$rows->email;?></div>
                            </div>
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_email_secundario');?></label>
                                    <div class="controls"><?=$rows->email_secundario;?></div>
                            </div>                            
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_telefone_secundario');?></label>
                                    <div class="controls"><?=$rows->telefone_outro;?></div>
                            </div>                                                          
                            <hr class="separator" />
                            
                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_grupo');?></label>
                                    <div class="controls">
                                        <? foreach($tipos_grupos_db as $tipos_grupos_db_item) {
                                            //confere o item
                                            if($tipos_grupos_db_item->id == $rows->grupo_id)
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
                                        if($rows->compartilhar == 1)
                                            echo lang('common_contas_propriedade_privado');
                                        elseif ($rows->compartilhar == 2)
                                            echo lang('common_contas_propriedade_grupo');
                                        elseif ($rows->compartilhar == 3)
                                            echo lang('common_contas_propriedade_publico');                                        
                                        ?>  
                                    </div>
                            </div>

                            <div class="control-group">
                                    <label class="control-label strong"><?=lang('common_label_receber_newsletter');?></label>
                                    <div class="controls">
                                        <?
                                        if($rows->enviar_newsletter == 1)
                                            echo lang('common_label_sim');
                                        else
                                            echo lang('common_label_nao');                                       
                                        ?>  
                                    </div>
                            </div>                              
			
			</div>
                           
			</div>
                        <br />
                            <div class="control-group">
                                    <label class="control-label strong"><h4 class="heading"><?=lang('common_contas_descricao');?></h4></label>
                                    <div class="controls"><?=nl2br($rows->descricao);?></div>
                            </div>                       
                        <br />                       
		</div>	
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

<!-- Ver conta -->
<form id="form_edit" name="form_edit" method="post" action="<?php echo base_url();?>i/contacts/edit">
    <input type="hidden" id="contato_id" name="contato_id" value="" />
</form>
<!-- fim Ver conta -->

<!-- Ver conta -->
<form id="form_view_account" name="form_view_account" method="post" action="<?php echo base_url();?>i/accounts/view">
    <input type="hidden" id="conta_id" name="conta_id" value="" />
</form>
<!-- fim Ver conta -->