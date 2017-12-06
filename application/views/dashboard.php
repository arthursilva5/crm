    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['<?=lang('common_label_tipo');?>', '<?=lang('common_label_total');?>'],
          ['<?=lang('common_dashboard_potenciais_tipo1');?>',     <?=round($tipo1->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo2');?>',      <?=round($tipo2->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo3');?>',  <?=round($tipo3->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo4');?>', <?=round($tipo4->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo5');?>', <?=round($tipo5->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo6');?>', <?=round($tipo6->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo7');?>', <?=round($tipo7->total_db,0)?>],
          ['<?=lang('common_dashboard_potenciais_tipo8');?>', <?=round($tipo8->total_db,0)?>]
        ]);

        var options = {
          title: '<?=lang('common_oportunidades_titulo');?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    
<div class="heading-buttons">
	<h3 class="glyphicons display span8"><i></i> <?=$title;?></h3>
	<div class="clearfix"></div>
</div>
<div class="separator bottom"></div>

<div class="menubar">
	<ul>
		<li><a href="<?php echo base_url();?>">Home</a> </li>
                <li class="divider"></li>
		<li><a href="<?php echo base_url();?>i/accounts"><?=lang('common_contas_titulo');?></a> </li>
                <li class="divider"></li>  
		<li><a href="<?php echo base_url();?>i/contacts"><?=lang('common_contatos_titulo');?></a> </li>
                <li class="divider"></li>
		<li><a href="<?php echo base_url();?>i/potentials"><?=lang('common_oportunidades_titulo');?></a> </li>
                <li class="divider"></li>  
		<li><a href="<?php echo base_url();?>i/newsletter"><?=lang('common_newsletter_titulo');?></a> </li>
                <li class="divider"></li>                  
	</ul>
</div>

<div class="innerLR">
    <?
    if($this->session->userdata('plano') > 1){
      echo '<div id="chart_div" style="width: 800px; height: 500px;"></div>';  
    }
    else
    {
        echo '<div style="text-align:center;">';
        echo lang('common_dashboard_graficos_erro');
        echo '<img src="'.base_url().'common/theme/images/demo/graph_demo.png" />';
        echo '</div>';
    }   

    ?>
    
</div>