<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PANEL ATUR PEMESANAN</title>
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
                DATA PEMESANAN
            </div>
            <div class="card-body">
                <button id="6342" class="btn btn-primary">Tambah Data</button>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>PEMESAN</th>
                            <th>IKAN</th>
                            <th>JUMLAH</th>
                            <th>TOTAL</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no = 1; foreach($pemesanan as $key){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $key['namapemesan'];?></td>
                                <td><?= $key['namaikan'];?></td>
                                <td><?= $key['jumlah'];?></td>
                                <td><?= $key['total'];?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php if(empty($key['bayar'])){
                                            echo "Belum Lunas";
                                        }elseif(empty($key['sampai'])){
                                            echo "Sedang Dikirim";
                                        }else{
                                            echo "Sampai";
                                        }
                                        ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="<?= base_url("lunas-pemesanan/".$key['id']) ?>">Update Lunas</a>
                                        <a class="dropdown-item" href="<?= base_url("selesai-pemesanan/".$key['id']) ?>">Update Sampai</a>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                <button data="<?= $key['id'] ?>" class="btn btn-warning 8867">ubah</button>||<a onclick="return confirm('Anda yakin akan menghapus data?')" href="<?= base_url("hapus-pemesanan/".$key['id']) ?>" class="btn btn-danger">hapus</a></td>
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
                TAMBAH DATA PEMESANAN
            </div>
            <div class="card-body">
                <?= form_open("aksi-pemesanan") ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary" id="9162">Reset</button>
                </div>
                <div class="form-group">
                    <label for="namapembeli">Nama Pembeli</label>
                    <input type="hidden" name="status" value="tambah" id="2761">
                    <input type="hidden" name="id" id="1782">
                    <select name="namapembeli" required class="form-control" id="namapembeli">
                        <option value="">-- PILIH PEMBELI --</option>
                        <?php foreach ($pembeli as $key) { ?>
                            <option value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="namaikan">Nama Ikan</label>
                    <select name="namaikan" required class="form-control select2" onchange="harga()"  id="namaikan">
                        <option value="">-- PILIH IKAN --</option>
                        <?php foreach ($ikan as $key) { ?>
                            <option value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" required class="form-control" onchange="update()" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Ikan">
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" readonly class="form-control" id="total" name="total" placeholder="Total Pembayaran(otomatis)">
                </div>
                <div class="form-group">
                    <label for="password">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="5"></textarea>
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
        var hrg = 0;
        var jumlah = 1;
        $(document).ready(function(){
            $(".table").dataTable();
            $('[data-toggle="tooltip"]').tooltip()
            $("#6342").click(function(){ // KLIK TAMBAH
                $("#9187").html("TAMBAH DATA PEMESANAN");
                $("#2761").val("tambah");
                $("#namapembeli").focus();
            });
            $('#data').on('click','.8867',function(){ // KLIK UBAH
                var id=$(this).attr('data');
                $.ajax({
                    type : "POST",
                    url: "<?= base_url("getJson/pemesanan") ?>", 
                    data : {id:id},
                    dataType : "JSON",
                    success: function(result){
                        $("#9187").html("UBAH DATA PEMESANAN");
                        $("#2761").val("ubah");
                        $("#namapembeli").focus();
                        $('#namapembeli').val(result.pemesan);
                        $("#1782").val(result.id);
                        $("#namaikan").val(result.ikan);
                        $("#jumlah").val(result.jumlah);
                        $("#total").val(result.total);
                        harga(); update();
                    }
                });
            });

            
            $('.toast').toast('show');
        });
        
        function harga(){
            var id = $("#namaikan").val();
            $.ajax({
                type : "POST",
                url: "<?= base_url("getJson/ikan") ?>", 
                data : {id:id},
                dataType : "JSON",
                success: function(result){
                    hrg = result.harga
                    $("#total").val(hrg*jumlah);
                }
            });
        }

        function update(){
            jumlah = $("#jumlah").val();
            $("#total").val(hrg*jumlah);
        }
    </script>
</body>

</html>
