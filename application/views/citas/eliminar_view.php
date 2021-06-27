<!--Modal Eliminar-->
<div class="modal fade" id="ModalEliminar<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Cita Nº <?= $id ?></h4>
			</div>
			<div class="modal-body bg-danger">
			¿Estas realmente seguro de querer eliminar esta cita? El diagnostico realizado por el medico y los datos del pago efectuado por el paciente también serán borrados.
			</div>
			<div class="modal-footer">
				<a href="<?= base_url() ?>citas/eliminar/<?= $id ?>" class="button">Aceptar</a>
				<button type="button" class="button" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>