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
    <div class="row" id="data">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Hai, Selamat Datang</h1>
        <p class="lead">Kami melayani berbagai macam pemesanan Ikan Asap Laut Segar dan Berkualitas</p> <hr>
      </div>

      <?php foreach ($ikan as $key) { ?>
        <div class="col-md-4">
        <div class="card">
          <div class="frameimage">  
          <img style="max-height: 220px; display: block; margin: auto; width: 100%;" src="<?= base_url('assets/img/'.$key['gambar']) ?>" class="card-img-top" onError="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png'" alt="Gambar Ikan"></div>
          <div class="card-body">
            <h4 class="card-title">Ikan <?= $key['nama'] ?></h4>
            <h6>Harga : <?= "Rp " . number_format($key['harga'],0,',','.'); ?></h6>
            <hr>
            <p class="card-text"><?= $key['deskripsi'] ?></p>
            <a class="8867" data="<?= $key['id'] ?>" href="javascript:void()" class="btn btn-primary">Pesan</a>
          </div>
        </div>
      </div>
      <?php } ?>
      
    </div>
  </div>

  <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <?php if(isLogin()){ ?>
              <?=  form_open("aksi-pemesanan") ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="2258"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="status" value="tambah" id="2761">
                        <input type="hidden" name="kode" value="2762" id="2762">
                        <input type="hidden" name="namapembeli" value="<?= session()->get('id') ?>">
                        <input type="hidden" name="namaikan" id="namaikan">
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                            <input required type="text" onchange="update()" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Pesanan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-2 col-form-label">Total</label>
                            <div class="col-sm-10">
                            <input required type="text" readonly name="total" id="total" placeholder="Total Pembayaran(otomatis)" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                            <textarea name="keterangan" placeholder="Masukkan Keterangan" class="form-control" id="keterangan" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save" ></i> Simpan</button>
                    </div>
                <?= form_close() ?>
            </div>
            <?php }else{ ?>
                <div class="modal-header">
                    <h4 class="modal-title">Anda Belum Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <p>login : <a href="<?= site_url("login") ?>">klik disini</a></p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
            <?php } ?>
            
          </div>
      </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.5/dist/sweetalert2.all.min.js"></script>
  <script>
      var hrg = 0;

      $('#data').on('click','.8867',function(){ // KLIK UBAH
        var id=$(this).attr('data');
        $.ajax({
          type : "POST",
          url: "<?= site_url("getJson/ikan") ?>", 
          dataType : "JSON",
          data : {id:id},
          success: function(data){
            $('#namaikan').val(data.id);
            $('#2258').html("Form Pesan Ikan "+data.nama);
            $('#modal').modal('show');
            hrg = data.harga;
          }
        });
        return false;
      });

      function update(){
          jumlah = $("#jumlah").val();
          $("#total").val(hrg*jumlah);
      }


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
