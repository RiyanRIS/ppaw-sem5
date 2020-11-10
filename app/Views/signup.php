<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
.my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
}
</style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Signup Page</title>
</head>
<body>
<?= view('template/atas') ?>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sign up</div>
                    <div class="card-body">
                    <?= form_open("signup-aksi") ?>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                        <div class="col-md-6">
                            <input type="text" id="nama" class="form-control" name="namapembeli" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                        <div class="col-md-6">
                            <input type="text" id="alamat" class="form-control" name="alamat" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nohp" class="col-md-4 col-form-label text-md-right">No Handphone</label>
                        <div class="col-md-6">
                            <input type="text" id="nohp" class="form-control" name="nohp" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                        <div class="col-md-6">
                            <input type="text" id="username" class="form-control" name="username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Sign up
                        </button>
                        <a href="<?= site_url("login") ?>" class="btn btn-link">
                            Have account yet?
                        </a>
                    </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.5/dist/sweetalert2.all.min.js"></script>
  <script>
    <?php if(@session()->get("info")[0] == 1){ ?>
      Swal.fire({
        title: 'Success!',
        text: '<?= session()->get("info")[1] ?>',
        icon: 'success',
        confirmButtonText: 'Okay'
      });
    <?php } ?>
    <?php if(@session()->get("info")[0] == 2){ ?>
      Swal.fire({
        title: 'Error!',
        text: '<?= session()->get("info")[1] ?>',
        icon: 'error',
        confirmButtonText: 'Okay'
      });
    <?php } ?>
  </script>
</body>
</html>