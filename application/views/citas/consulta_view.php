<!--Modal para consulta-->
<div class="modal fade" id="ModalConsulta<?= $id  ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<?= form_open('citas/consulta', array('id' => 'consultaForm'.$id)) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Datos de la Consulta</h4>
			</div>
			<div class="modal-body bg-info">
				<div class="row">
					<div class="alert alert-danger" id="errorsConsulta<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-remove-sign"></span> Han ocurrido varios errores de validación</strong>
						<div id="list_errorsConsulta<?= $id  ?>"></div>
					</div>
					<div class="alert alert-warning" id="warningConsulta<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-warning-sign"></span> ¡Ocurrio un Problema!</strong> No fue posible registrar el pago
					</div>
					<div class="alert alert-success" id="successConsulta<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-ok-sign"></span> ¡Excelente!</strong> Los datos de la consulta han sido guardados con éxito
					</div>
					<div class="alert alert-info" id="serverConsulta<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-exclamation-sign"></span> ¡Error de conexión!</strong> No fue posible la comunicación con el servidor
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6"><?= form_label('Nombre del Paciente') ?></div>
					<div class="col-xs-6">
						<?= form_input('nombre_paciente', $nombre_paciente, array('disabled' => true)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6"><?= form_label('Medico Tratante') ?></div>
					<div class="col-xs-6">
						<?= form_input('nombre_medico', $nombre_medico, array('disabled' => true)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Sintomas', 'sintomas'.$id) ?>
					</div>
					<div class="col-xs-6">
						<?= form_input('sintomas', '', array('id' => 'sintomas'.$id)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Diagnostico', 'diagnostico'.$id) ?>
					</div>
					<div class="col-xs-6">
						<?= form_input('diagnostico', '', array('id' => 'diagnostico'.$id)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Tratamiento', 'tratamiento'.$id) ?>
					</div>
					<div class="col-xs-6">
						<?= form_input('tratamiento', '', array('id' => 'tratamiento'.$id)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Observaciones', 'observaciones'.$id) ?>
					</div>
					<div class="col-xs-6">
						<?= form_input('observaciones', '', array('id' => 'observaciones'.$id)) ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?= form_submit('consulta', 'Guardar Consulta', array('class' => 'button')) ?>
				<button type="button" class="button" data-dismiss="modal">Cancelar</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
	$(function(){
		//Mensajes de Error
		recargar_consulta();
		//Acciones del Formulario
		$("#consultaForm<?= $id ?>").submit(function(){
			var formData = new FormData(document.getElementById("consultaForm<?= $id ?>"));
            $.ajax({
                url: "<?= base_url() ?>citas/consulta/<?= $id ?>",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(procesar)
            .fail(procesarError);
            return false;
		});
		function procesar(data)
		{
			if (data == "guardo")
			{
				recargar_consulta();
				$("#successConsulta<?= $id  ?>").show(400).delay(4000).hide(400);
				window.location = "<?= base_url() ?>consultas";
			}
			else
			{
				recargar_consulta();
				$("#list_errorsConsulta<?= $id  ?>").html(data);
				$("#errorsConsulta<?= $id  ?>").show(400).delay(5000).hide(400);
			}
		}
		function procesarError()
		{
			recargar_consulta();
			$("#serverConsulta<?= $id  ?>").show(400).delay(4000).hide(400);
		}
		function recargar_consulta() {
			$("#errorsConsulta<?= $id  ?>").hide();
			$("#warningConsulta<?= $id  ?>").hide();
			$("#successConsulta<?= $id  ?>").hide();
			$("#serverConsulta<?= $id  ?>").hide();
		}
	});
</script>