<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Binus</b>Online</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <!-- /. Untuk menampung pesan 'message' dari controller -->
            <!-- /. Ini berguna untuk memberi pesan kesalahan kepada user -->
            <?= $this->session->flashdata('message'); ?>

            <!-- /. Form dengan method POST untuk mengirimkan hasil inputan user kedalam COntroller Auth -->
            <form class="user" method="post" action="<?= base_url('auth'); ?>">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-0">
                <!-- /. Sebuah interaktif link apabila user hendak ingin melakukan registrasi -->
                <a href=" <?= base_url('auth/registration'); ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->