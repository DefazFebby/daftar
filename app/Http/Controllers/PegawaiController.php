<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Exports\ExportExcel;
use Illuminate\Http\Request;
use App\Imports\PegawaiImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class PegawaiController extends Controller
{
   public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada pencarian, filter data pegawai
        $data = Pegawai::when($search, function ($query, $search) {
                    return $query->where('nama', 'like', "%{$search}%")
                                ->orWhere('alamat', 'like', "%{$search}%")
                                ->orWhere('kelamin', 'like', "%{$search}%")
                                ->orWhere('telp', 'like', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->withQueryString();

        return view('pegawai', compact('data'));
    }

    public function tambahpegawai(){
        return view('pegawaitambah');
    }

   public function insertpegawai(Request $request)
    {
        // Insert data pegawai kecuali foto
        $data = Pegawai::create($request->except('foto'));

        // Jika ada foto, upload dan update field foto
        if ($request->hasFile('foto')) {
            $filename = time().'_'.$request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('fotopegawai'), $filename);
            $data->foto = $filename;
            $data->save();
        }

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function insertpegawai1(Request $request){
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'kelamin' => 'required',
        'telp' => 'required',
        'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = Pegawai::create($request->all());
    if($request->hasFile('foto')) {
        $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
    }
    return redirect()->route('pegawai')->with('success','Data Berhasil Ditambahkan');
}


    public function tampilpegawai($id){
        $data = Pegawai::find($id);
        //dd($data);
        return view('pegawaitampil',compact('data'));
    }

    public function updatepegawai(request $request, $id){
        $data = Pegawai::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data Berhasil diRubah');
    }

    public function deletepegawai($id){
         $data = Pegawai::find($id);
         $data->delete();
         return redirect()->route('pegawai')->with('success','Data Berhasil diHapus');
    }

    public function exportpdf()
    {
       $data = Pegawai::all();
       view()->share('data', $data);
       $pdf =  pdf::loadview('pegawaipdf'); 
       return $pdf->download('data.pdf') ;
    }
    
    public function exportExcel()
    {
        return Excel::download(new ExportExcel, 'data_pegawai.xlsx');
    }

     public function importExcel(Request $request)
    {
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('PegawaiData', $namafile);

        Excel::import(new PegawaiImport, \public_path('/PegawaiData/'.$namafile) );
        return \redirect()->back();
    }
}


