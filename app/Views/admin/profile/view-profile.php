<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Mi perfil</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/perfil') ?>"><i class="zmdi zmdi-account"></i> Cuenta</a></li>
                        <li class="breadcrumb-item active">Mi perfil</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="<?= site_url('admin/perfil/editar') ?>" class="btn bg-orange btn-icon float-right" title="Editar perfil"><i class="zmdi zmdi-edit"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <a href="profile.html"><img src="<?= base_url('public/images/profile_av.jpg') ?>" class="rounded-circle shadow " alt="profile-image"></a>
                            <div class="row mt-3">
                                <div class="col-12">
                                <small class="text-muted">Estado cuenta: </small>
                                <?php
                                if ($userData['deleted'] == 'f') {
                                ?>
                                <span class="badge badge-success">ACTIVO</span>
                                <?php
                                } else {
                                ?>
                                <span class="badge badge-danger">INACTIVO</span>
                                <?php
                                }
                                ?>
                                </div>                          
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <small class="text-muted">Nombre: </small>
                            <p><?= $userData['nombre'] ?></p>
                            <hr>
                            <small class="text-muted">Apellido: </small>
                            <p><?= $userData['apellido'] ?></p>
                            <hr>
                            <small class="text-muted">Correo electrónico: </small>
                            <p><?= $userData['email'] ?></p>
                            <hr>
                            <small class="text-muted">Acceso: </small>
                            <p><?= $userData['tipo_acceso'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>