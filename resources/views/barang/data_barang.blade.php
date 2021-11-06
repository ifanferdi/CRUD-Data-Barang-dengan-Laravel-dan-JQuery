@if (isset($inventories))



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
        @if (count($inventories) > 0)

        @foreach ($inventories as $inventory)
        <tr>
            <td class="align-middle" class="text-center">{{ $loop->iteration }}</td>
            <td class="align-middle" style="width: 10rem;">
                <img src="{{ asset('storage/' . $inventory->gambar) }}" class="img-preview img-fluid ">
            </td>
            <td class="align-middle">{{ $inventory->nama_barang }}</td>
            <td class="align-middle">{{ $inventory->kode_barang }}</td>
            <td class="align-middle">{{ $inventory->harga_beli }}</td>
            <td class="align-middle">{{ $inventory->harga_jual }}</td>
            <td class="align-middle">{{ $inventory->stok }}</td>
            <td class="align-middle">
                <button class="btn btn-success badge rounded-pill" onClick="ubah({{ $inventory->id }})">Ubah</button>
                <button class="btn btn-danger badge rounded-pill" onClick="hapus({{ $inventory->id }})"> Hapus </button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8" class="align-middle text-center"> Tidak Ada Data </td>
        </tr>
        @endif
    </tbody>
</table>
@endif