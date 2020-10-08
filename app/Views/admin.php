<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PANEL ATUR ADMIN</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
                DATA ADMIN
            </div>
            <div class="card-body">
                <button id="6342" class="btn btn-primary">Tambah Data</button>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>LAST LOGIN</t>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no = 1; foreach($admin as $key){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $key['nama'];?></td>
                                <td><?= $key['username'];?></td>
                                <td><?= $key['lastlogin'];?></td>
                                <td><button data="<?= $key['id'] ?>" class="btn btn-warning 8867">ubah</button>||<a onclick="return confirm('Anda yakin akan menghapus data?')" href="<?= base_url("hapus-admin/".$key['id']) ?>" class="btn btn-danger">hapus</a></td>
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
                TAMBAH DATA ADMIN
            </div>
            <div class="card-body">
                <?= form_open("aksi-admin") ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary" id="9162">Reset</button>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Admin</label>
                    <input type="hidden" name="status" value="tambah" id="2761">
                    <input type="hidden" name="id" id="1782">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Admin">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $(".table").dataTable();
            $("#6342").click(function(){ // KLIK TAMBAH
                
                $("#9187").html("TAMBAH DATA ADMIN");
                $("#2761").val("tambah");
                $("#nama").focus();
            });
            $('#data').on('click','.8867',function(){ // KLIK UBAH
                var id=$(this).attr('data');
                $.ajax({
                    type : "POST",
                    url: "<?= base_url("getJson/admin") ?>", 
                    data : {id:id},
                    dataType : "JSON",
                    success: function(result){
                        $("#9187").html("UBAH DATA ADMIN");
                        $("#2761").val("ubah");
                        $("#nama").focus();
                        $("#nama").val(result.nama);
                        $("#1782").val(result.id);
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
