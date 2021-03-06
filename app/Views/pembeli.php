<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PANEL ATUR PEMBELI</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>

  <!-- ATAS -->
  <?= view('template/atas') ?>
 

  <!-- Page Content -->
  <div class="container pt-3 pb-5">
    <div class="row">

      <div class="col-md-8" id="3827">
        <div class="card">
            <div class="card-header">
                DATA PEMBELI
            </div>
            <div class="card-body">
                <button id="6342" class="btn btn-primary">Tambah Data</button>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>NOHP</t>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no = 1; foreach($pembeli as $key){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $key['nama'];?></td>
                                <td><?= $key['alamat'];?></td>
                                <td><?= $key['nohp'];?></td>
                                <td><button data="<?= $key['id'] ?>" class="btn btn-warning 8867">ubah</button>||<a onclick="return confirm('Anda yakin akan menghapus data?')" href="<?= base_url("hapus-pembeli/".$key['id']) ?>" class="btn btn-danger">hapus</a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="col-md-4" id="6527">
        <div class="card">
            <div class="card-header" id="9187">
                TAMBAH DATA PEMBELI
            </div>
            <div class="card-body">
                <?= form_open("aksi-pembeli") ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary" id="9162">Reset</button>
                </div>
                <div class="form-group">
                    <label for="namapembeli">Nama Pembeli</label>
                    <input type="hidden" name="status" value="tambah" id="2761">
                    <input type="hidden" name="id" id="1782">
                    <input type="text" class="form-control" required id="namapembeli" name="namapembeli" placeholder="Masukkan Nama Pembeli">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" required id="alamat" cols="30" rows="5" placeholder="Masukkan Alamat"></textarea>
                </div>
                <div class="form-group">
                    <label for="nohp">No Handphone</label>
                    <input type="text" class="form-control" required id="nohp" name="nohp" placeholder="Masukkan No Handphone">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" required id="username" name="username" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                    <small class="text-muted form-text" id="7725"></small>
                </div>
                
                <?= form_close() ?>
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
    
    <script>
        $(document).ready(function(){
            $(".table").dataTable();
            $("#6342").click(function(){ // KLIK TAMBAH
                
                $("#9187").html("TAMBAH DATA PEMBELI");
                $("#2761").val("tambah");
                $("#namapembeli").focus();
            });
            $('#data').on('click','.8867',function(){ // KLIK UBAH
                var id=$(this).attr('data');
                $.ajax({
                    type : "POST",
                    url: "<?= base_url("getJson/pembeli") ?>", 
                    data : {id:id},
                    dataType : "JSON",
                    success: function(result){
                        $("#9187").html("UBAH DATA PEMBELI");
                        $("#2761").val("ubah");
                        $("#namapembeli").focus();
                        $("#namapembeli").val(result.nama);
                        $("#1782").val(result.id);
                        $("#alamat").val(result.alamat);
                        $("#nohp").val(result.nohp);
                        $("#username").val(result.username);
                        $("#7725").html("Kosongi Password Jika Tidak Ingin Merubahnya");
                    }
                });
            });

            $('.toast').toast('show');
        });

        
    </script>
</body>

</html>
