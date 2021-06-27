<!--Modal para notificar pagos-->
<div class="modal fade" id="ModalPagar<?= $id  ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<?= form_open('citas/pagar', array('id' => 'pagosForm'.$id)) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Notificar Pago</h4>
			</div>
			<div class="modal-body bg-info">
				<div class="row">
					<div class="alert alert-danger" id="errorsPagar<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-remove-sign"></span> Han ocurrido varios errores de validación</strong>
						<div id="list_errorsPagar<?= $id  ?>"></div>
					</div>
					<div class="alert alert-warning" id="warningPagar<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-warning-sign"></span> ¡Ocurrio un Problema!</strong> No fue posible registrar el pago
					</div>
					<div class="alert alert-success" id="successPagar<?= $id  ?>">
						<strong><span class="glyphicon glyphicon-ok-sign"></span> ¡Excelente!</strong> El pago ha sido registrado con éxito
					</div>
					<div class="alert alert-info" id="serverPagar<?= $id  ?>">
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
					<div class="col-xs-6"><?= form_label('Documento de Identidad') ?></div>
					<div class="col-xs-6">
						<?= form_input('doc_paciente', $doc_paciente, array('disabled' => true)) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6"><?= form_label('Fecha de la cita') ?></div>
					<div class="col-xs-6"><?= form_input(array('type' => 'date', 'value' => $fecha, 'disabled' => true)) ?></div>
				</div>
				<div class="row">
					<div class="col-xs-6"><?= form_label('Fecha del Pago', 'fecha_pago'.$id) ?></div>
					<div class="col-xs-6"><?= form_input(array('type' => 'date', 'name' => 'fecha_pago', 'id' => 'fecha_pago'.$id, 'placeholder' => 'Formato: Años-Mes-Dia')) ?></div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Monto a Pagar') ?>
					</div>
					<div class="col-xs-6">
						<?= form_input(array('type' => 'number', 'name' => 'monto', 'value' => $precio_consulta, 'min' => 0, 'max' => $precio_consulta)) ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?= form_submit('pagar', 'Notificar Pago', array('class' => 'button')) ?>
				<button type="button" class="button" data-dismiss="modal">Cancelar</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
	$(function(){
		//Mensajes de Error
		recargar_pagar();
		//Acciones del Formulario
		$("#pagosForm<?= $id ?>").submit(function(){
			var formData = new FormData(document.getElementById("pagosForm<?= $id ?>"));
            $.ajax({
                url: "<?= base_url() ?>citas/pagar/<?= $id ?>",
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
				recargar_pagar();
				$("#successPagar<?= $id  ?>").show(400).delay(4000).hide(400);
				window.location = "<?= base_url() ?>pagos";
			}
			else
			{
				recargar_pagar();
				$("#list_errorsPagar<?= $id  ?>").html(data);
				$("#errorsPagar<?= $id  ?>").show(400).delay(5000).hide(400);
				jQuery.fn.reset = function(){
                    $(this).each(function(){ this.reset(); });
                }
                $("#pagosForm<?= $id ?>").reset();
			}
		}
		function procesarError()
		{
			recargar_pagar();
			$("#serverPagar<?= $id  ?>").show(400).delay(4000).hide(400);
		}
		function recargar_pagar() {
			$("#errorsPagar<?= $id  ?>").hide();
			$("#warningPagar<?= $id  ?>").hide();
			$("#successPagar<?= $id  ?>").hide();
			$("#serverPagar<?= $id  ?>").hide();
		}
	});
</script>