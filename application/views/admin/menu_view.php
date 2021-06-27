<div class="content-layout">
	<div class="content-layout-row">
		<div class="layout-cell" style="width:100%">
			<p style="text-align: right;">
				<a href="#" class="button" data-toggle="modal" data-target="#ModalEditarAdmin"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('username') ?></a>
				<a href="#" class="button" data-toggle="modal" data-target="#ModalClave"><span class="glyphicon glyphicon-lock"></span> Cambio de Contraseña</a>
				<a href="#" class="button" data-toggle="modal" data-target="#ModalLogout"><span class="glyphicon glyphicon-off"></span> Logout</a>
			</p>
		</div>
	</div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
        <div class="layout-cell layout-item-0" style="width: 100%" >
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>pacientes">
                            <img src="<?= base_url() ?>assets/images/clients.png">
                            <h3>Pacientes</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>medicos">
                            <img src="<?= base_url() ?>assets/images/doctor.png">
                            <h3>Médicos</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>especialidades">
                            <img src="<?= base_url() ?>assets/images/stethoscope.png">
                            <h3>Especialidades</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>citas">
                            <img src="<?= base_url() ?>assets/images/date.png">
                            <h3>Citas</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-layout">
    <div class="content-layout-row">
        <div class="layout-cell layout-item-0" style="width: 100%">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                       <a href="<?= base_url() ?>consultas">
                            <img src="<?= base_url() ?>assets/images/medical_case.png">
                            <h3>Consultas</h3>
                        </a> 
                    </div>                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>pagos">
                            <img src="<?= base_url() ?>assets/images/money.png">
                            <h3>Pagos</h3>
                        </a> 
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>usuarios">
                            <img src="<?= base_url() ?>assets/images/man_grey.png">
                            <h3>Usuarios</h3>
                        </a>
                    </div>
                </div>
                <!--<div class="col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="panel_item">
                        <a href="<?= base_url() ?>perfil_empresa">
                            <img src="<?= base_url() ?>assets/images/preferences_desktop_personal.png">
                            <h3>Configuración</h3>
                        </a>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!--Modal Logout-->
<?php $this->load->view('admin/logout_view'); ?>
<!--Modal Editar-->
<?php $this->load->view('admin/editar_view', array('preguntas' => $preguntas)); ?>
<!--Modal Clave-->
<?php $this->load->view('admin/cambio_clave_view') ?>