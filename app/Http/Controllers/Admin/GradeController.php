<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Jabatan;
use DataTables;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Grade::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jabatan', function ($grades) {
                return $grades->jabatan->nama_jabatan ?? '';
            })
            ->addColumn('action', function ($grades) {
                $edit = route('editgrade', $grades->id);
                $delete = route('grade.destroy', $grades->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$grades->id.'">
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
    return view('layout_grade.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $grade = Grade::all();
        $jabatan = Jabatan::all();
        return view ('layout_grade.create',compact(['grade','jabatan']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama_grade'=>'required',       
            'jabatan_id'=>'required',
            'biaya'=>'required',
        ],[
            'nama_grade.required' => 'Nama jabatan wajib di isi',
            'jabatan_id.required' =>'Anda harus memilih jabatan',
            'biaya.required' => 'Biaya wajib di isi',
        ]);
        $data = $request->except(["_token","submit"]);
        $data['biaya'] = str_replace('.', '', $data['biaya']);

        Grade::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('grade')->with([
            'user' => Auth::user(),
         ]);
    }
}
