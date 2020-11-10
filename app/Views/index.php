<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PESAN IKAN ONLINE</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- ATAS -->
  <?= view('template/atas') ?>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Hai, Selamat Datang</h1>
        <p class="lead">Kami melayani berbagai macam pemesanan Ikan Asap Laut Segar dan Berkualitas</p> <hr>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="frameimage">  
          <img src="https://blogpictures.99.co/ikan-tongkol.jpg" class="card-img-top" alt="Gambar Ikan"></div>
          <div class="card-body">
            <h4 class="card-title">Nama Ikan</h4>
            <h6>Harga : Rp 50.000</h6>
            <p class="card-text">Deskripsi Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio similique corrupti iusto cum rerum quidem nulla autem quibusdam laboriosam animi nobis, mollitia perspiciatis! Vitae debitis quia, id molestias voluptatibus consequatur.</p>
            <a href="#" class="btn btn-primary">Pesan</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="frameimage">
          <img src="https://www.bfarm.id/wp-content/uploads/2019/05/pppppppppppppppppppppppppppppppppppp.jpg" class="card-img-top" alt="Gambar Ikan"> </div>
          <div class="card-body">
            <h4 class="card-title">Nama Ikan2</h4>
            <h6>Harga : Rp 23.000</h6>
            <p class="card-text">Deskripsi Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio similique corrupti iusto cum rerum quidem nulla autem quibusdam laboriosam animi nobis, mollitia perspiciatis! Vitae debitis quia, id molestias voluptatibus consequatur.</p>
            <a href="#" class="btn btn-primary">Pesan</a>
          </div>
        </div>
      </div>
        <!-- <ul class="list-unstyled">
          <li>Bootstrap 4.5.0</li>
          <li>jQuery 3.5.1</li>
        </ul> -->
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
