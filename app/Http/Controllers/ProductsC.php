<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsM;

use App\Models\LogM;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;

class ProductsC extends Controller
{
    protected $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function countProduct()
    {
        $products = ProductsM::count();
        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Produk'
        ]);

        // $products = Products::latest()->paginate(5);

        // return view('products_index',compact('products'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        $subtitle = "Daftar Produk";
        // $productsM = ProductsM::all();
        // return view('products_index', compact('subtitle', 'productsM'));
        $vcari = request('search');
        $productsM = ProductsM::where('nama_produk', 'like', "%$vcari%")->orWhere('created_At', 'like', "%$vcari%")->paginate(10);
        return view('products_index', compact('subtitle', 'productsM', 'vcari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Dihalaman Tambah Produk'
        ]);

        $subtitle = "Tambah Produk";
        return view('products_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $logM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Proses Tambah Produk'
            ]);

            $request->validate([
                'nama_produk' => 'required',
                'harga_produk' => 'required',
                'jenis' => 'required|in:pans,knitware,crewneck,hoodie,jacket', // validate jenis
                'size' => 'required|in:XS,S,M,L,XL,XXL', // validate size
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // validating image
            ]);

            // create input to be overide ...
            $input = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $folderPath = 'images/product/';
                    $imgName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move(public_path($folderPath), $imgName);
                    $input['image'] = $imgName; // overide the image path
                } else {
                    return redirect()->back()->withErrors(['image' => 'Invalid image file.'])->withInput();
                }
            }

            productsM::create($input);

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->withErrors(['error' => 'Something went wrong.'])->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Edit Produk'
        ]);

        $subtitle = "Edit Produk";
        $products = ProductsM::find($id);
        return view('products_edit', compact('subtitle', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit'
        ]);

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
        ]);

        $data = request()->except(['_token', '_method', 'submit']);

        productsM::where('id', $id)->update($data);
        return redirect()->route('products.index')->with('success', 'Barang berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Hapus Produk'
        ]);

        productsM::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }

    public function pdf()
    {
        $productsM = ProductsM::all();
        // $pdf = PDF::loadview('products_pdf', ['productsM' => $productsM]);
        $this->pdf->loadView('products_pdf', ['productsM' => $productsM]);
        // Set paper size to A4 for landscape orientation
        $this->pdf->setPaper('a4', 'landscape');
        return $this->pdf->stream('products.pdf');
    }
}
