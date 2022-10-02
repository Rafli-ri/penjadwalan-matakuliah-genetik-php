<!doctype html>
<html lang="en">

<head>
    <title>Login | Penjadwalan </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('/assets/css/login.css')  ?>">


</head>

<body>
    <div class="alert">
        <?php if ($this->session->flashdata('msg')) { ?>
            <div class="alert alert-error alert-danger alert-dismissible fade show">
                <?php echo $this->session->flashdata('msg'); ?>
                <button type="button" class="close" onclick="this.parentElement.style.display='none';" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </div>
    <div class="container my-4">
        <div class="maindiv">

            <h1>Sign in</h1>
            <h3>Penjadwalan kuliah</h3>
            <div class="col">
                <form action="#" method="POST">
                    <div class="inputs">
                        <div class="Fields">
                            <div class="Fieldset">
                                <input type="text" class="input Before-FS" required name="txt_user" autocomplete="off">
                                <h1 class="Fs-H"><span>Username</span></h1>
                                <label class="placeholder">Username</label>
                            </div>
                        </div>
                        <div class="Fields">
                            <div class="Fieldset">
                                <input type="password" required name="txt_pass" class="input Before-FS" required="">
                                <h1 class="Fs-H"><span>Password</span></h1>
                                <label class="placeholder">Password</label>
                            </div>
                        </div>
                    </div>
                    <button class="button" type="submit" name="btn_login" value="Login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src=" <?= base_url('/assets/js/jquery.min.js'); ?> "></script>
    <script src="<?= base_url('/assets/js/popper.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/main.js'); ?>"></script>

</body>

</html>