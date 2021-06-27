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
	<p style="text-align:center"><h3>Consulta Medica</h3></p>
	<p style="text-align:right;">Fecha: <?= date("d/m/Y", strtotime($fecha_cita)) ?></p>
	<p><strong>Nº de Cita:</strong> <?= $id ?></p>
	<table border="1">
		<tr>
			<td colspan="2"><h4>Información del Paciente</h4></td>
			<td colspan="2"><h4>Información del Médico</h4></td>
		</tr>
		<tr>
			<td><strong>Nombres y Apellidos</strong></td>
			<td><?= $nombre_paciente ?></td>
			<td><strong>Nombres y Apellidos</strong></td>
			<td><?= $nombre_medico ?></td>
		</tr>
		<tr>
			<td><strong>Documento de Identidad</strong></td>
			<td><?= $doc_paciente ?></td>
			<td><strong>Documento de Identidad</strong></td>
			<td><?= $doc_medico ?></td>
		</tr>
		<tr>
			<td><strong>Sexo</strong></td>
			<td><?= $sexo ?></td>
			<td><strong>Especialidad</strong></td>
			<td><?= $especialidad ?></td>
		</tr>
		<tr>
			<td><strong>Tipo de Sangre</strong></td>
			<td><?= $adn ?></td>
			<td><strong>Correo Electrónico</strong></td>
			<td><?= $email_medico ?></td>
		</tr>
		<tr>
			<td><strong>Peso</strong></td>
			<td><?= $peso ?></td>
			<td><strong>Fecha de Ingreso</strong></td>
			<td><?= date("d/m/Y", strtotime($ingreso)) ?></td>
		</tr>
		<tr>
			<td><strong>Altura</strong></td>
			<td><?= number_format($altura, 2, ',', '.') ?></td>
			<td><strong>Consultorio</strong></td>
			<td><?= $consultorio ?></td>
		</tr>
		<tr>
			<td colspan="4"><h4>Información de la Consulta</h4></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Sintomas</strong></td>
			<td colspan="2" style="width:300px"><?= $sintomas ?></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Diagnostico</strong></td>
			<td colspan="2" style="width:300px"><?= $diagnostico ?></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Tratamiento</strong></td>
			<td colspan="2" style="width:300px"><?= $tratamiento ?></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Observaciones</strong></td>
			<td colspan="2" style="width:300px"><?= $observaciones ?></td>
		</tr>
	</table>
</page>