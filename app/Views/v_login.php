<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<?php
$username = [
    'name'  => 'username',
    'id'    => 'username',
    'class' => 'form-control',
    'placeholder' => 'Enter your username',
    'required' => true
];

$password = [
    'name'  => 'password',
    'id'    => 'password',
    'class' => 'form-control',
    'placeholder' => 'Enter your password',
    'required' => true
];
?>

<body class="bg-gradient-info"> <!-- Ubah background jadi info -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <!-- KIRI: Gambar Login -->
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                             style="background-image: url('<?= base_url('img/login_side.jpg') ?>'); background-size: cover; background-position: center;">
                        </div>

                        <!-- KANAN: Form Login -->
                        <div class="col-lg-6">
                            <div class="p-5">

                                <!-- Gambar Logo Atas -->
                                <div class="text-center mb-4">
                                    <img src="<?= base_url('img/login_banner.jpg') ?>" 
                                         alt="Login Image" 
                                         class="img-fluid" style="max-width: 150px;">
                                    <h1 class="h4 text-gray-900 mt-3">Welcome Back!</h1>
                                </div>

                                <!-- Flashdata -->
                                <?php if (session()->getFlashData('failed')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashData('failed') ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Login Form -->
                                <?= form_open('login', ['class' => 'user']) ?>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <?= form_input($username) ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <?= form_password($password) ?>
                                </div>

                                <div class="form-group">
                                    <?= form_submit('submit', 'Login', ['class' => 'btn btn-info btn-block']) ?> <!-- Ubah tombol jadi info -->
                                </div>

                                <?= form_close() ?>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.html">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
