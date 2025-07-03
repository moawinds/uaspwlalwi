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

<body class="bg-gradient-primary">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
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
                                    <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary btn-block']) ?>
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
