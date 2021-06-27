<!--Modal para agregar registros-->
<div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open('especialidades/agregar', array('id' => 'espForm')) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Nueva especialidad médica</h4>
			</div>
			<div class="modal-body bg-info">
				<div class="row">
					<div class="alert alert-danger" id="errors">
						<strong><span class="glyphicon glyphicon-remove-sign"></span> Han ocurrido varios errores de validación</strong>
						<div id="list_errors"></div>
					</div>
					<div class="alert alert-warning" id="warning">
						<strong><span class="glyphicon glyphicon-warning-sign"></span> ¡Ocurrio un Problema!</strong> No fue posible guardar el registro
					</div>
					<div class="alert alert-success" id="success">
						<strong><span class="glyphicon glyphicon-ok-sign"></span> ¡Excelente!</strong> La especialidad médica ha sido agregada con éxito
					</div>
					<div class="alert alert-info" id="server">
						<strong><span class="glyphicon glyphicon-exclamation-sign"></span> ¡Error de conexión!</strong> No fue posible la comunicación con el servidor
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<?= form_label('Descripción', 'descripcion') ?>
					</div>
					<div class="col-xs-6">
						<?= form_input('descripcion', '', array('id' => 'descripcion', 'maxlength' => 50)) ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?= form_submit('agregar', 'Agregar', array('class' => 'button')) ?>
				<button type="button" class="button" data-dismiss="modal">Cerrar</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
	$(function(){
		//Eventos del modal
		$('#ModalAgregar').on('hidden.bs.modal', function (e) {
		  window.location="<?= base_url() ?>especialidades";
		});
		//Mensajes de Error
		recargar();
		//Acciones del Formulario
		$("#espForm").submit(function(){
			var formData = new FormData(document.getElementById("espForm"));
            $.ajax({
                url: "<?= base_url() ?>especialidades/agregar",
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
				recargar();
				$("#success").show(400).delay(4000).hide(400);
				jQuery.fn.reset = function(){
                    $(this).each(function(){ this.reset(); });
                }
                $("#espForm").reset();
                $("#nombre").focus();
			}
			else
			{
				recargar();
				$("#list_errors").html(data);
				$("#errors").show(400).delay(5000).hide(400);
			}
		}
		function procesarError()
		{
			recargar();
			$("#server").show(400).delay(4000).hide(400);
		}
		function recargar() {
			$("#errors").hide();
			$("#warning").hide();
			$("#success").hide();
			$("#server").hide();
		}
	});
</script>