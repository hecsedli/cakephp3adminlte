<%
use Cake\Utility\Inflector;
%>
<div class="box box-warning">
    <div class="box-header">
    	<h3 class="box-title"><?php echo __('<%= $singularHumanName %>') ?> <?= __('<%= Inflector::humanize($action) %>') ?></h3>
    	<div class="pull-right">
	    	<?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add'], ['class'=>'btn btn-primary btn-xs addBtn']) ?>
	    	<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>],
                ['confirm' => __('Are you sure you want to delete # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>), 'class'=>'btn btn-danger btn-xs delBtn']
            )
        ?>
    	</div>
    </div>
    <?php echo $this->Flash->render(); ?>
    <% echo $this->element('form'); %>
    <div class="overlay" style="display:none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>

<script type="text/javascript">
$(function () {
	
	$('#<%= $pluralVar %><%= Inflector::humanize($action) %>Form').ajaxForm({
		replaceTarget: false,
		target: '#<%= $singularVar %>-1',
		beforeSubmit: function(arr, $form, options) {
			$('.overlay').show();
		},	
		success: function (response) {
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "<%= $pluralVar %>", "action" => "indexAjax"], true) ?>",
				cache: false
			})
			.done(function( html ) {
				$('#<%= $singularVar %>-2').html( html );
				$('.overlay').hide();
  			});
		},
		error: function(jqXHR, textStatus, errorThrown) {
			$('.overlay').hide();
	  		alert(errorThrown);
	  	}
	});
	
	$('.addBtn').click(function(event){
		event.preventDefault();
		var link = $(this).attr('href');
		$('.overlay').show();
		$.ajax({
				url: link,
				cache: false
			})
			.done(function( html ) {
				$('#<%= $singularVar %>-1').html( html );
				$('.overlay').hide();
  			});
		
	});

});
</script>