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

            <i class="fa-sharp fa-solid fa-circle-user"></i>
            <div class="form-icon">
                <!-- <span><i class="icon icon-user"></i></span> -->
            </div>


            <p><label for="remember"><input type="checkbox" name="remember" value="true" /> Remember Me</label></p>

            >
            <div class="text-center">

            </div>
            </form>
        </div>
    </div>


</body>