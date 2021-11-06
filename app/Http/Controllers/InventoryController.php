<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barang.index', [
            'inventories' => Inventory::orderBy('nama_barang', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_barang' => 'required|max:100',
            'kode_barang' => 'required|max:100|unique:inventories',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|file|max:100|mimes:jpg,png'
        ];

        $valid = Validator::make($request->all(), $rules);

        if (!$valid->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $valid->errors()->toArray()
            ]);
        } else {

            $request->file('gambar')->store('img_barang');

            $data = [
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'gambar' => $request->file('gambar')->store('img_barang')
            ];

            Inventory::create($data);

            return response()->json([
                'status' => 1,
                'sukses' => 'Data barang berhasil ditambahkan!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {

        $data = Inventory::findOrFail($inventory);

        return view('barang.edit_barang')->with([
            'inventory' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $rules = [
            'nama_barang' => 'required|max:100',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'image|file|max:100|mimes:jpg,png'
        ];

        if ($request->kode_barang != $inventory->kode_barang) {
            $rules['kode_barang'] = 'required|max:100|unique:inventories';
        }

        $valid = Validator::make($request->all(), $rules);

        if (!$valid->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $valid->errors()->toArray()
            ]);
        } else {

            $data = [
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
            ];

            if ($request->file('gambar')) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }
                $request->file('gambar')->store('img_barang');
                $data['gambar'] = $request->file('gambar')->store('img_barang');
            } else {
                $data['gambar'] = $request->gambarLama;
            }

            Inventory::where('id', $inventory->id)->update($data);

            return response()->json([
                'data' => $data,
                'status' => 1,
                'sukses' => 'Data barang berhasil diubah!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        Storage::delete($inventory->gambar);
        Inventory::destroy($inventory->id);

        return response()->json([
            'sukses' => 'Data barang berhasil dihapus!'
        ]);
    }


    public function tampilData()
    {
        $inventories = Inventory::orderBy('nama_barang', 'asc')->get();

        return view('barang.data_barang')->with([
            'inventories' => $inventories
        ]);
    }

    public function getInventory()
    {
        return response()->json([
            Inventory::find($_POST['id'])
        ]);
    }

    public function cari(Request $request)
    {
        $cari = '%' . $request->key . '%';

        $inventories = Inventory::where('nama_barang', 'LIKE', $cari)
            ->orWhere('kode_barang', 'LIKE', $cari)
            ->orderBy('nama_barang', 'asc')
            ->get();

        return view('barang.data_barang')->with([
            'inventories' => $inventories
        ]);
    }
}
