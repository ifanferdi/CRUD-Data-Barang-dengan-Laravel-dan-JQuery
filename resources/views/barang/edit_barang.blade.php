<div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUbahLabel">Ubah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data" class="mb-0" id="formUbah">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                            placeholder="Masukkan Nama Barang">
                        <div class="invalid-feedback nama_barang_error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang"
                            placeholder="Masukkan Kode Barang">
                        <div class="invalid-feedback kode_barang_error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="harga_beli">Harga Beli</label>
                            <input type="text" class="form-control" name="harga_beli" id="harga_beli"
                                placeholder="Masukkan Harga Beli">
                            <div class="invalid-feedback harga_beli_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="harga_jual">Harga Jual</label>
                            <input type="text" class="form-control" name="harga_jual" id="harga_jual"
                                placeholder="Masukkan Harga Jual">
                            <div class="invalid-feedback harga_jual_error"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok">
                        <div class="invalid-feedback stok_error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar</label>
                        <input class="form-control" type="file" name="gambar" id="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>