<div class="row">
	<div class="col-xs-6">
		<?= form_label('Nombre Completo', 'nombre') ?>
	</div>
	<div class="col-xs-6">
		<?= form_input('nombre', $nombre, array('id' => 'nombre', 'maxlength' => 100)) ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<?= form_label('Documento de Identidad', 'documento') ?>
	</div>
	<div class="col-xs-6">
		<?= form_input('documento', $documento, array('id' => 'documento', 'maxlength' => 10)) ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<?= form_label('Sexo', 'sexo') ?>
	</div>
	<div class="col-xs-6">
		<?= form_dropdown('sexo', array('' => '-', 'Femenino' => 'Femenino', 'Masculino' => 'Masculino'), $sexo, array('id' => 'sexo')) ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<?= form_label('Correo Electrónico', 'email') ?>
	</div>
	<div class="col-xs-6">
		<?= form_input('email', $email, array('id' => 'email', 'maxlength' => 100)) ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<?= form_label('Teléfono', 'tlf') ?>
	</div>
	<div class="col-xs-6">
		<?= form_input('tlf', $tlf, array('id' => 'tlf', 'maxlength' => 11)) ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<?= form_label('Foto', 'userfile') ?>
	</div>
	<div class="col-xs-6">
		<?= form_upload(array('name' => 'userfile', 'id' => 'userfile'), '') ?>
	</div>
</div>