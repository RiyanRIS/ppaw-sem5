<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PANEL PEMESANAN</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>

  <!-- ATAS -->
  <?= view('template/atas') ?>

  <!-- Page Content -->
  <div class="container pt-3 pb-5">
    <div class="row">

      <div class="col-md-12" id="3827">
        <div class="card">
            <div class="card-header">
                DATA PEMESANAN
            </div>
            <div class="card-body">
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>PEMESAN</th>
                            <th>IKAN</th>
                            <th>JUMLAH</th>
                            <th>TOTAL</th>
                            <th>STATUS</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no = 1; foreach($pemesanan as $key){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date("d F Y", strtotime($key['pesan'])) ?></td>
                                <td><?= $key['namapemesan'];?></td>
                                <td><?= $key['namaikan'];?></td>
                                <td><?= $key['jumlah'];?></td>
                                <td><?= "Rp " . number_format($key['total'],0,',','.') ?></td>
                                <td><span>
                                    <?php if(empty($key['bayar'])){
                                        echo "Belum Lunas";
                                    }elseif(empty($key['sampai'])){
                                        echo "Sedang Dikirim";
                                    }else{
                                        echo "Sampai";
                                    }
                                    ?>
                                    </span>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
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
