<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PANEL ATUR IKAN</title>
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
                DATA IKAN
            </div>
            <div class="card-body">
                <button id="6342" class="btn btn-primary">Tambah Data</button>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>DESKRIPSI</th>
                            <th>HARGA</t>
                            <th>GAMBAR</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no = 1; foreach($ikan as $key){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $key['nama'];?></td>
                                <td><?= $key['deskripsi'];?></td>
                                <td><?= $key['harga'];?></td>
                                <td><?= $key['gambar'];?></td>
                                <td><button data="<?= $key['id'] ?>" class="btn btn-warning 8867">ubah</button>||<a onclick="return confirm('Anda yakin akan menghapus data?')" href="<?= base_url("hapus-ikan/".$key['id']) ?>" class="btn btn-danger">hapus</a></td>
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
                TAMBAH DATA IKAN
            </div>
            <div class="card-body">
                <?= form_open("aksi-ikan") ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary" id="9162">Reset</button>
                </div>
                <div class="form-group">
                    <label for="namaikan">Nama Ikan</label>
                    <input type="hidden" name="status" value="tambah" id="2761">
                    <input type="hidden" name="id" id="1782">
                    <input type="text" class="form-control" required id="namaikan" name="namaikan" placeholder="Masukkan Nama Ikan">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="5" placeholder="Masukkan Deskripsi"></textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" required id="harga" name="harga" placeholder="Masukkan Harga">
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
    
    <script>
        $(document).ready(function(){
            $(".table").dataTable();
            $("#6342").click(function(){ // KLIK TAMBAH
                
                $("#9187").html("TAMBAH DATA IKAN");
                $("#2761").val("tambah");
                $("#namaikan").focus();
            });
            $('#data').on('click','.8867',function(){ // KLIK UBAH
                var id=$(this).attr('data');
                $.ajax({
                    type : "POST",
                    url: "<?= base_url("getJson/ikan") ?>", 
                    data : {id:id},
                    dataType : "JSON",
                    success: function(result){
                        $("#9187").html("UBAH DATA IKAN");
                        $("#2761").val("ubah");
                        $("#namaikan").focus();
                        $("#namaikan").val(result.nama);
                        $("#1782").val(result.id);
                        $("#deskripsi").val(result.deskripsi);
                        $("#harga").val(result.harga);
                    }
                });
            });

            $('.toast').toast('show');
        });

        
    </script>
</body>

</html>
