<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 33%" >
	        <?= form_open('usuarios/', array('class' => 'search', 'id' => 'busquedaForm', 'method' => 'get')) ?>
			<?= form_input('campo', $campo, array('id' => 'campo', 'placeholder' => 'Documento, Nombre o Usuario')) ?><a class="search-button" href="#" onclick="javascript:jQuery(this).parents('form').submit();"><span class="search-button-text">Buscar</span></a>
			<?= form_close() ?>
	    </div>
	    <div class="layout-cell" style="width: 67%" >
	        <p style="text-align: right;">
	        	<?php if($this->session->userdata('tipo') == "Administrador"): ?>
	        	<a href="#" class="button" data-toggle="modal" data-target="#ModalAgregar"><span class="glyphicon glyphicon-plus-sign"></span> Agregar nuevo</a>
	        	<?php endif ?>
		        <a href="<?= base_url() ?>admin" class="button"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a>
	        </p>
	    </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
    	<div class="layout-cell" style="width: 100%" >
			<?php if($num_users > 0){ ?>
			<?php foreach ($usuarios as $user): ?>
			<div class="col-md-4 col-sm-6 col-xs-12">	
		        <p style="text-align: center;">
		        <img width="180" height="180" class="lightbox" src="<?= base_url() ?>assets/images/personas/<?= $user->foto ?>"><br></p>
		        <h3 style="text-align: center;"><?= $user->nombre ?></h3>
		        <h4 style="text-align: center;"><?= $user->documento ?></h4>
		        <p style="text-align: center;">
		        	<?php if($this->session->userdata('id') != $user->id && $this->session->userdata('tipo') == "Administrador"): ?>
						<a href="#" class="button" title="Editar" data-toggle="modal" data-target="#ModalEditar<?= $user->id ?>"><span class="glyphicon glyphicon-edit"></a>
						<a href="#" class="button" title="Eliminar" data-toggle="modal" data-target="#ModalEliminar<?= $user->id ?>"><span class="glyphicon glyphicon-remove"></a>
					<?php elseif($this->session->userdata('id') == $user->id): ?>
					<span class="label label-warning">Es usted</span>
					<?php else: ?>
					<span class="label label-danger">No tienes permisos</span>
					<?php endif?>
		        </p>
		    </div>
		    <!--Modal Editar-->
			<?php
			$data = array(
				'id' => $user->id,
				'nombre' => $user->nombre,
				'documento' => $user->documento,
				'sexo' => $user->sexo,
				'email' => $user->email,
				'tlf' => $user->tlf,
				'foto' => $user->foto,
				'username' => $user->username,
				'tipo' => $user->tipo,
				'tipos' => $tipos,
				);
			$this->load->view('usuarios/editar_view', $data);
			?>
			<!--Modal Eliminar-->
			<?php
			$data = array('id' => $user->id, 'nombre' => $user->nombre);
			$this->load->view('usuarios/eliminar_view', $data);
			?>
			<?php endforeach ?>
		</div>
	</div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
	    <?= $pagination ?>
	    </div>
   </div>
</div>
<?php } else { ?>
<div class="content-layout">
    <div class="content-layout-row">
	    <div class="layout-cell" style="width: 100%" >
		    <div class="alert alert-warning">
		    	<h3 class="text-center">No se han encontrado usuarios</h3>
		    </div>
	    </div>
    </div>
</div>
<?php } ?>
<!--Modal para agregar registros-->
<?php $this->load->view('usuarios/agregar_view', array('preguntas' => $preguntas, 'tipos' => $tipos)); ?>