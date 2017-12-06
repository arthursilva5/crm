<div class="heading-buttons">
	<h3 class="glyphicons nameplate"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>


<div class="innerLR">
<div class="widget widget-gray widget-body-white">
    
    <?php echo form_open_multipart(base_url().'i/contacts/add_imported_file_now', array('name' => 'form_add', 'id' => 'form_add'));?>    
		<div class="widget-body" style="padding: 10px 0 0;">
			
			<div class="widget widget-4">
				<div class="widget-head"><h4 class="heading"><?=lang('common_contatos_arquivo_do_contato');?></h4></div>
				<div class="separator"></div>
			</div> 
                    
			<div class="row-fluid">
                           
			<div class="span12">
			
                        <div>
                        <label><?=lang('common_contatos_exemplo_arquivo_csv');?></label>
                        <span class="thumb view">
                                <img src="<?=base_url();?>pub/images/img_formato_csv.png" alt="Album" />
                                <br />
                                <a href="<?=base_url();?>/pub/downloads/5lobos_crm_csv_import_sample.csv" class="pull-right"><?=lang('common_contatos_exemplo_arquivo_csv_download');?></a>
                        </span>
                        </div>
			<br /><br /><br />
                        
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new"><?=lang('common_label_selecionar_arquivo');?></span><span class="fileupload-exists"><?=lang('common_label_mudar');?></span><input type="file" name="arquivo_importar" id="arquivo_importar" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?=lang('common_label_remover');?></a>
                                </div>
                        </div>
                        
                                                
			
			</div>
			
			</div>
                     
                        <br />

                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=lang('common_contatos_importar_agora');?></button>
                        <a href="<?=base_url();?>i/contacts" class="btn btn-icon btn-default glyphicons circle_remove"><i></i><?=lang('common_label_cancelar');?></a>

		</div>	
        </form>
	</div>		
</div>

<!-- jQuery Validate -->
<script src="<?=base_url(); ?>common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>common/theme/scripts/demo/form_validator.js" type="text/javascript"></script>