<%
$datepicker = false;
$datetimepicker = false;
$select2 = false;

 $fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->getColumnType($field) !== 'binary';
    });
    
   
foreach ($fields as $field) {
	if (!in_array($field, ['created', 'modified', 'updated'])) {
		$fieldData = $schema->getColumn($field);
        if (($fieldData['type'] === 'date')) $datepicker = true;
        if (($fieldData['type'] === 'datetime')) $datetimepicker = true;
	}
	
	if (isset($keyFields[$field])) {
		$select2 = true;
	}
}
%>
<?php
/**
 * @var \<%= $namespace %>\View\AppView $this
 * @var \<%= $entityClass %>[]|\Cake\Collection\CollectionInterface $<%= $pluralVar %>
 */
?>

<section class="content-header">
	<h1><?php echo __('<%= $pluralHumanName %>') ?></h1>
  	<ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['controller' => 'Pages', 'action' => 'dashboard']); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard') ?></a></li>
        <li class="active"><?php echo __('<%= $pluralHumanName %>') ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6 ajax-box" id="<%= $singularVar %>-1" data-url="<?php echo $this->Url->build(['action' => 'add']); ?>">
			
		</div>
		
		<div class="col-md-6 ajax-box" id="<%= $singularVar %>-2" data-url="<?php echo $this->Url->build(['action' => 'indexAjax']); ?>">
			
		</div>
		
	</div>
</section>

<%
if($datepicker === true || $datetimepicker === true):
%>
<?php
$this->Html->script([
  'AdminLTE./plugins/input-mask/jquery.inputmask.bundle.min.js',
],
['block' => 'script']);
?>

<%
endif;
%>

<%
if($datepicker === true):
%>
<?php
$this->Html->css([
    'AdminLTE./plugins/datepicker/datepicker3',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datepicker/bootstrap-datepicker',
  'AdminLTE./plugins/datepicker/locales/bootstrap-datepicker.pt-BR',
],
['block' => 'script']);
?>
<%
endif;
%>

<%
if($datetimepicker === true):
%>
<?php
$this->Html->css([
    'AdminLTE./plugins/datetimepicker/bootstrap-datetimepicker.min',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datetimepicker/moment-with-locales.min.js',
  'AdminLTE./plugins/datetimepicker/bootstrap-datetimepicker.min',
],
['block' => 'script']);
?>
<%
endif;
%>

<%
if($select2 === true):
%>
<?php
$this->Html->css([
    'AdminLTE./plugins/select2/select2.min',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/select2/select2.full.min',
],
['block' => 'script']);
?>
<%
endif;
%>




<?php $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js',['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>


<script type="text/javascript">
$(function(){
	$('.ajax-box').each(function(){
		var _this = $(this);
		
		$.ajax({
			url: _this.data('url'),
			cache: false
		})
		.done(function( html ) {
			_this.html( html );
  		});
	});
});
</script>
<?php $this->end(); ?>