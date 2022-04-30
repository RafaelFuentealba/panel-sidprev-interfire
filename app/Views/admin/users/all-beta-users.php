<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Todos los usuarios</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/beta/usuarios') ?>"><i class="zmdi zmdi-accounts-alt"></i> Usuarios beta</a></li>
                        <li class="breadcrumb-item active">Todos los usuarios</li>
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
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon blue"><i class="zmdi zmdi-accounts-add"></i></div>
                            <h4 class="mt-3"><?= sizeof($users) ?></h4>
                            <span class="text-muted">Total de usuarios</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon green"><i class="zmdi zmdi-portable-wifi"></i></div>
                            <h4 class="mt-3"><?= sizeof($activateUsers) ?></h4>
                            <span class="text-muted">Usuarios activos</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon pink"><i class="zmdi zmdi-portable-wifi-off"></i></div>
                            <h4 class="mt-3"><?= sizeof($blockUsers) ?></h4>
                            <span class="text-muted">Usuarios bloqueados</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon orange"><i class="zmdi zmdi-collection-image"></i></div>
                            <h4 class="mt-3"><?= sizeof($interfaces) ?></h4>
                            <span class="text-muted">Total de interfaces</span>
                       </div>
                    </div>
                </div>
            </div>

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
                                            <th>Estado</th>
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
                                            <td>
                                                <?php if ($user['deleted'] == 'f') { ?>
                                                <span class="badge badge-success">Activo</span>
                                                <?php } else { ?>
                                                <span class="badge badge-danger">Bloqueado</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button onclick="activateBetaUser(this)" value="<?= $user['usuario_id'] ?>" class="btn btn-success waves-effect waves-float btn-sm waves-green" title="Activar usuario"><i class="zmdi zmdi-check"></i></button>
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

<script src="<?= base_url('public/js/pages/manage-users/main_all_users.js'); ?>"></script>