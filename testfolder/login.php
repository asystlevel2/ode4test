<body>
    <div class="container">
        <!-- Content here -->
        <div class='text-center'>
            <br>
            <h1></h1>
        </div>
        <div class="logo">
            <img src="gambar/logo.png">
        </div>
        <div class="registration-form">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('auth'); ?>" method="post">
                <i class="fa-sharp fa-solid fa-circle-user"></i>
                <div class="form-icon">
                    <!-- <span><i class="icon icon-user"></i></span> -->
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" name="email" placeholder="email" value="<?= set_value('email'); ?>" id="username">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" name="password" placeholder="password" id="password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <p><label for="remember"><input type="checkbox" name="remember" value="true" /> Remember Me</label></p>

                >
                <div class="text-center">
                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                </div>
            </form>
        </div>
    </div>


</body>