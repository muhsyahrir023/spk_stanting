<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Departemen;
use DataTables;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {

         if ($request->ajax()) {
            $data = Karyawan::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('departemen', function ($karyawans) {
                    return $karyawans->departemen->nama ?? '';
                })
                ->addColumn('action', function ($karyawans) {
                    $edit = route('editkaryawan', $karyawans->id);
                    $delete = route('karyawan.destroy', $karyawans->id);
                    $deleteButton = '
                        <button class="btn btn-secondary btn-sm delete-button" data-id="'.$karyawans->id.'">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    ';
                    
                    return '<a href="'.$edit.'" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> 
                        <form action="'.$delete.'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            '.$deleteButton.'
                        </form>';
                })
                ->toJson();
        }
        return view('layout_karyawan.index')->with([
                'user' => Auth::user(),
             ]);
    }

    public function create(){
        $departemen = Departemen::all();
        return view ('layout_karyawan.create',compact(['departemen']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'alamat'=>'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat.required' => 'Alamat wajib di isi',
            'departemen_id'=>'required',
           
        ],[
            'nama.required' => 'Nama wajib di isi',
            'tempat_lahir.required' => 'Tempat lahir wajib di isi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'jenis_kelamin.required' => 'Anda harus memilih jenis kelamin',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid',
            'departemen_id.required' =>'Anda harus memilih departemen',
           
        ]);
        $data = $request->except(["_token","submit"]);
        Karyawan::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('karyawan')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id); 
        $departemen = Departemen::all(); 
        return view('layout_karyawan.edit', compact('karyawan', 'departemen'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $karyawan = Karyawan::find($id); 
        $karyawan->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('karyawan')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
