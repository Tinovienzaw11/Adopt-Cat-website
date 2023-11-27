<?php

namespace App\Http\Controllers;

use App\Models\CatType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(User::find($request->user()->id)->role !== 'admin'){
                return redirect()->route('home');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Kucing',
            'catTypes' => CatType::all()
        ];

        return view('admin.cat.type-index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse {
        $insert = CatType::create([
            'name' => ucwords($request->name)
        ]);

        if($insert->id > 0){
            return redirect()->back()->with('message',
                sweetAlert('Success!','Berhasil menambahkan Jenis Kucing.','success')
            );
        } else {
            return redirect()->back()->with('message',
                sweetAlert('Error!','Gagal menambahkan Jenis Kucing.','error')
            );
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(CatType $cat_type)
    {
        $data = [
            'title' => 'Edit Jenis Kucing '.$cat_type->name,
            'catType' => $cat_type
        ];

        return view('admin.cat.type-edit', $data);
    }

    public function update(Request $request, CatType $cat_type): \Illuminate\Http\RedirectResponse {
        $cat_type->name = ucwords( $request->name);
        $cat_type->save();

        return redirect()->back()->with('message',
            sweetAlert('Success!','Berhasil mengupdate Jenis Kucing.','success')
        );
    }

    public function destroy(CatType $cat_type): \Illuminate\Http\RedirectResponse {
        $cat_type->delete();
        return redirect()->back()->with('message',
            sweetAlert('Success!','Berhasil menghapus Jenis Kucing','success'));
    }
}
