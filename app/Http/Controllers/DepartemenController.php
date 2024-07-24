<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Departemen;
use DataTables;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Departemen::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($departemens) {
                $edit = route('editdepartemen', $departemens->id);
                $delete = route('departemen.destroy', $departemens->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$departemens->id.'">
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
    return view('layout_departemen.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $departemen = Departemen::all();
        return view ('layout_departemen.create',compact(['departemen']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama'=>'required',       
        ],[
            'nama.required' => 'Nama wajib di isi',
        ]);
        $data = $request->except(["_token","submit"]);
        Departemen::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('departemen')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $departemen = Departemen::find($id); 
        return view('layout_departemen.edit', compact('departemen'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $departemen = Departemen::find($id); 
        $departemen->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('departemen')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
