<style>
	table
	{
		margin: auto;
	}
	th, td
	{
		padding: 10px;
	}
</style>
<page backtop="20px" backbottom="20px" backleft="50px" backright="50px">
	<img src="<?= APPPATH ?>third_party/logotipo.png" width="100">
	<p style="text-align:right;">RIF: J-12345678-9</p>
	<p style="text-align:center"><h3>Recibo de Pago</h3></p>
	<p style="text-align:right;">Fecha: <?= date("d/m/Y", strtotime($fecha_pago)) ?></p>
	<p><strong>Nº de Recibo:</strong> <?= $id ?></p>
	<p><strong>Documento de Identidad:</strong> <?= $doc_paciente ?></p>
	<p><strong>Nombres y Apellidos:</strong> <?= $nombre_paciente ?></p>
	<p><strong>Fecha de la cita:</strong> <?= date("d/m/Y", strtotime($fecha_cita)) ?></p>
	<p><strong>Turno:</strong> <?= $turno ?></p>
	<p><strong>Médico tratante:</strong> <?= $nombre_medico ?></p>
	<p style="text-align:right;">
		<h4>Monto Pagado</h4>
		<strong>Bs. <?= number_format($monto, 2, ",", ".") ?></strong>
	</p>
</page>