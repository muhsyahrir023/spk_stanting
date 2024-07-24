<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jabatan;
use DataTables;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jabatan::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($jabatans) {
                $edit = route('editjabatan', $jabatans->id);
                $delete = route('jabatan.destroy', $jabatans->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$jabatans->id.'">
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
    return view('layout_jabatan.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $jabatan = Jabatan::all();
        return view ('layout_jabatan.create',compact(['jabatan']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama_jabatan'=>'required',       
        ],[
            'nama_jabatan.required' => 'Nama jabatan wajib di isi',
        ]);
        $data = $request->except(["_token","submit"]);
        Jabatan::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('jabatan')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id); 
        return view('layout_jabatan.edit', compact('jabatan'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $jabatan = Jabatan::find($id); 
        $jabatan->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('jabatan')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }


}
