<table class="table table-bordered table-striped mt-3 table_barang">
    <thead class="table-secondary">
        <tr>
            <th class="text-center">No</th>
            <th>Foto Barang</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $inventory)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>foto</td>
            <td>{{ $inventory->nama_barang }}</td>
            <td>{{ $inventory->kode_barang }}</td>
            <td>{{ $inventory->harga_beli }}</td>
            <td>{{ $inventory->harga_jual }}</td>
            <td>{{ $inventory->stok }}</td>
            <td>
                <button class="btn btn-success badge rounded-pill" onClick="ubah({{ $inventory->id }})">Ubah</button>
                <button class="btn btn-danger badge rounded-pill" onClick="hapus({{ $inventory->id }})"> Hapus </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>