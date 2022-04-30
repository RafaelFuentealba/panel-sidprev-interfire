<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Usuarios activos</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/beta/usuarios/activos') ?>"><i class="zmdi zmdi-accounts-alt"></i> Usuarios beta</a></li>
                        <li class="breadcrumb-item active">Usuarios activos</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead class="bg-green">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo electrónico</th>
                                            <th>Fecha de registro</th>
                                            <th>Interfaces creadas</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($users as $user) {
                                        ?>
                                        <tr>
                                            <td><?= $user['nombre']. ' '. $user['apellido'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                            <td><?= $user['interfaces'] ?></td>
                                            <td>
                                                <a href="<?= site_url('admin/beta/usuario/'.$user['usuario_id']); ?>" class="btn btn-primary waves-effect waves-float btn-sm waves-blue" title="Ver usuario"><i class="zmdi zmdi-eye"></i></a>
                                                <button onclick="blockBetaUser(this)" value="<?= $user['usuario_id'] ?>" class="btn btn-danger waves-effect waves-float btn-sm waves-red" title="Bloquear usuario"><i class="zmdi zmdi-close"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="<?= base_url('public/js/pages/manage-users/main_active_users.js'); ?>"></script>