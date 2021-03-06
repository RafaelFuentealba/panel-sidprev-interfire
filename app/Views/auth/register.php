<div class="authentication" style="margin-top:3%; margin-bottom:5%;">    
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" action="<?= site_url('auth/registro'); ?>" method="POST" autocomplete="off">

                    <?= csrf_field(); ?>

                    <div class="header">
                        <img class="logo" src="<?= base_url('public/images/logo-interfire.png'); ?>" alt="" style="width:90%;">
                        <h5 class="mt-4">Registro</h5>
                    </div>

                    <?php
                    if (!empty(session()->getFlashdata('register-fail'))) :
                    ?>
                        <div class="alert alert-danger text-center"><?= session()->getFlashdata('register-fail'); ?></div>
                    <?php
                    endif
                    ?>
                    
                    <div class="body">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'firstname') : '' ?></span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="firstname" placeholder="Nombre" value="<?= set_value('firstname'); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'lastname') : '' ?></span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="lastname" placeholder="Apellido" value="<?= set_value('lastname'); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Correo electr??nico" value="<?= set_value('email'); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>             
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Contrase??a" value="<?= set_value('password'); ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$" title="Debe contener al menos una letra may??scula, una letra min??scula, un n??mero, un car??cter especial y contener entre 8 y 25 caracteres">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="cpassword" placeholder="Repetir contrase??a" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$" title="Debe contener al menos una letra may??scula, una letra min??scula, un n??mero, un car??cter especial y contener entre 8 y 25 caracteres">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>
                        <input type="submit" class="btn btn-primary btn-block waves-effect waves-light" value="REGISTRARME">
                        <div class="signin_with mt-3">
                            <a class="link" href="<?= site_url('auth/ingresar'); ?>">??Ya tienes una cuenta?</a> / <a href="<?= site_url('auth/clave/recuperar'); ?>">??Olvidaste tu contrase??a?</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="https://interfire.cl/" target="_blank">Interfire SpA</a></span>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="<?= base_url('public/images/signup.svg'); ?>" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>