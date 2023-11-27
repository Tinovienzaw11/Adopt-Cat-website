<?php

namespace App\Http\Controllers;

use App\Models\BuktiPajak;
use App\Models\CatType;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CatController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kucing',
            'cats' => Auth::user()->role == 'admin' ? Cat::all() : Cat::guest()->get()
        ];

        return view('admin.cat.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kucing',
            'catTypes' => CatType::all()
        ];

        return view('admin.cat.create', $data);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse {
        $needValidate = [
            'name' => 'required|min:3|max:255',
            'fk_cat_type' => 'required|integer',
            'image' => 'required|mimes:png,jpg,jpeg'
        ];

        $validator = Validator::make($request->all(), $needValidate);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $data = [
                'name' => $request->name,
                'fk_cat_type' => $request->fk_cat_type,
                'fk_user' => Auth::id(),
                'image' => $this->imageRequestCreate($request)
            ];

            $store = Cat::query()->create($data);
            if($store->id > 0){
                return redirect()->back()->with('message',
                    sweetAlert('Success!','Berhasil menambahkan Data Kucing.','success')
                );
            } else {
                return redirect()->back()->with('message',
                    sweetAlert('Error!','Gagal menambahkan Data Kucing.','error')
                );
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Cat $cat)
    {
        if(Auth::user()->role == 'guest'){
            if($cat->fk_user != Auth::id()){
                return abort(404);
            }
        }
        $data = [
            'title' => 'Edit Data Kucing '.$cat->name,
            'cat' => $cat,
            'catTypes' => CatType::all()
        ];

        return view('admin.cat.edit', $data);
    }

    public function update(Request $request, Cat $cat): \Illuminate\Http\RedirectResponse {
        if(Auth::user()->role == 'guest'){
            if($cat->fk_user != Auth::id()){
                return abort(404);
            }
        }
        $needValidate = [
            'name' => 'required|min:3|max:255',
            'fk_cat_type' => 'required|integer',
            'status' => 'required|in:waiting,off,adopted',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ];

        $validator = Validator::make($request->all(), $needValidate);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $data = [
                'name' => $request->name,
                'fk_cat_type' => $request->fk_cat_type,
                'status' => $request->status,
                'image' => $this->imageRequestUpdate($request, $cat),
                'adopted_at' => $request->status == 'adopted' ? date('Y-m-d H:i:s') : NULL
            ];

            if($cat->update($data)){
                return redirect()->back()->with('message',
                    sweetAlert('Success!','Berhasil mengupdate Data Kucing.','success')
                );
            } else {
                return redirect()->back()->with('message',
                    sweetAlert('Error!','Gagal mengupdate Data Kucing.','error')
                );
            }
        }
    }

    public function destroy(Cat $cat): \Illuminate\Http\RedirectResponse {
        if(Auth::user()->role == 'guest'){
            if($cat->fk_user != Auth::id()){
                return abort(404);
            }
        }
        if(Storage::exists('public/'.$cat->image)){
            Storage::delete('public/'.$cat->image);
        }
        $cat->delete();
        return redirect()->back()->with('message',
            sweetAlert('Success!','Berhasil menghapus Data Kucing','success'));
    }

    private function imageRequestCreate($request) {
        if ($request->hasFile('image')) {
            try {
                $guessExtension = strtolower($request->file('image')->guessExtension());
                $fileName = pathinfo(
                    $request->file('image')
                        ->getClientOriginalName(), PATHINFO_FILENAME
                );
                $time = time();
                $image = $time.'-'.Str::slug(strtolower($fileName)).'.'.$guessExtension;

                $request
                    ->file('image')
                    ->storeAs('public/cat/', $time.'-'.Str::slug(strtolower($fileName)).'.'.$guessExtension);
            } catch (\Exception $exception) {
                return redirect()->back()->with('message',
                    sweetAlert('Error!','Failed Upload Cat Image '.$exception->getMessage(),'error')
                );
            }
        } else {
            return NULL;
        }
        return 'cat/'.$image;
    }

    private function imageRequestUpdate($request, $cat) {
        if ($request->hasFile('image')) {
            try {
                $guessExtension = strtolower($request->file('image')->guessExtension());
                $fileName = pathinfo(
                    $request->file('image')
                        ->getClientOriginalName(), PATHINFO_FILENAME
                );
                $time = time();
                $image = $time.'-'.Str::slug(strtolower($fileName)).'.'.$guessExtension;

                $request
                    ->file('image')
                    ->storeAs('public/cat/', $time.'-'.Str::slug(strtolower($fileName)).'.'.$guessExtension);

                if(Storage::exists('public/'.$cat->image)){
                    Storage::delete('public/'.$cat->image);
                }
            } catch (\Exception $exception) {
                return redirect()->back()->with('message',
                    sweetAlert('Error!','Failed Update Cat Image '.$exception->getMessage(),'error')
                );
            }
        } else {
            return $cat->image;
        }
        return 'cat/'.$image;
    }
}
