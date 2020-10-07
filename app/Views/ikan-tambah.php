<div class="card">
    <div class="card-header">
        TAMBAH DATA IKAN
    </div>
    <div class="card-body">
        <?= form_open("tambah-ikan") ?>
        <div class="form-group">
            <label for="">&nbsp;</label>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" id="9162">Kembali</button>
        </div>
        <div class="form-group">
            <label for="namaikan">Nama Ikan</label>
            <input type="text" class="form-control" id="namaikan" name="namaikan">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga">
        </div>
        
        <?= form_close() ?>
    </div>
</div>