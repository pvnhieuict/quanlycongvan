<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Documentin;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DocumentinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $documentins = Documentin::where('secret', 1)
                ->orderBy('in_date')->paginate(8);
            return view('documentins.index', compact('documentins'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn chưa đăng nhập');
    }
    // Quan ly cong van den
    public function index_qlcvd()
    {
        if (Auth::check() && Gate::denies('nguoidungthuong')) {
            $documentins = DB::table('documentins')->orderBy('in_date', 'desc')->paginate(8);
            return view('documentins.index_qlcvd', compact('documentins'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn không có quyền truy cập');
    }

    //Quan ly cong van den tre han index_qlcvdt
    public function index_qlcvdth()
    {
        if (Auth::check() && Gate::denies('nguoidungthuong')) {
            $currentTime = Carbon::now();
            $documentins = Documentin::where([['status', '<>', 3], ['ngaydenhan', '<', $currentTime], ['ngaydenhan', '<>', '0000-00-00']])->orderBy('in_date', 'desc')->paginate(10);
            return view('documentins.index_qlcvdth', compact('documentins'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn không có quyền truy cập');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dataTypeDocuments = Type::all();
        return view('documentins.create', compact('dataTypeDocuments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validations

        $request->validate([
            'pathpdf' => 'required|mimes:pdf|max:20000'
        ]);
        if ($request->nguoiphutrach) {
            $id_nguoiphutrachtuform = DB::table('users')
                ->select('id')->where('name', $request->nguoiphutrach)
                ->first();

            $request->merge(['nguoiphutrach' => $id_nguoiphutrachtuform->id]);
        }
        $re = $request->toArray();
        //dd($re);

        if ($request->file('pathpdf')) {
            $fileName = time() . '_' . $request->pathpdf->hashName();
            $yearupload = date("Y");
            $filePath = $request->file('pathpdf')->storeAs('uploads', $fileName, 'public');
            $re['pathpdf'] = $filePath;
            $re['namepdf'] = $fileName;
            $show = Documentin::create($re);
            return redirect()->back()->with('success', 'Đã lưu thành công');
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
        $dataDocumentin = Documentin::find($id);
        $nguoiphutrach = DB::table('users')
            ->select('name')->where('id', $dataDocumentin->nguoiphutrach)
            ->first();
        return view('documentins.show', compact('dataDocumentin', 'nguoiphutrach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $dataTypeDocuments = Documentin::find($id);
        $typeDocument = Type::all();
        $nguoiphutrach = DB::table('users')
            ->select('name')->where('id', $dataTypeDocuments->nguoiphutrach)
            ->first();

        //$typeDocument = $dataTypeDocuments->type->name;
        return view('documentins.edit', compact('dataTypeDocuments', 'typeDocument', 'nguoiphutrach'));
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

        $request->validate([
            'label_number' => 'required|max:255',
            'title' => 'required|max:255',

        ]);
        if ($request->nguoiphutrach) {
            $id_nguoiphutrachtuform = DB::table('users')
                ->select('id')->where('name', $request->nguoiphutrach)
                ->first();
            $request->merge(['nguoiphutrach' => $id_nguoiphutrachtuform->id]);
        }
        $re['label_number'] = $request->label_number;
        $re['title'] = $request->title;
        $re['type_id'] = $request->type_id;
        $re['secret'] = $request->secret;
        $re['status'] = $request->status;

        if ($request->has('pathpdf')) {
            // Xoa file PDF cu
            $documentin = Documentin::findOrFail($id);
            $path = "//public/" . $documentin->pathpdf;
            if (Storage::exists($path)) {
                Storage::delete($path);
                /*
                        Delete Multiple File like this way
                        Storage::delete(['upload/test.png', 'upload/test2.png']);
                    */
            }

            //Upload file moi
            $fileName = time() . '_' . $request->pathpdf->hashName();
            $filePath = $request->file('pathpdf')->storeAs('uploads', $fileName, 'public');

            //Cap nhat path vao database
            $re['pathpdf'] = $filePath;
            $re['namepdf'] = $fileName;
        }
        $re['signature_date'] = $request->signature_date;
        $re['in_date'] = $request->in_date;
        $re['store_date'] = $request->store_date;
        $re['ngaydenhan'] = $request->ngaydenhan;
        $re['detail'] = $request->detail;
        $re['copy_number'] = $request->copy_number;
        $re['from_place'] = $request->from_place;
        if ($request->nguoiphutrach) {
            $re['nguoiphutrach'] = $request->nguoiphutrach;
        }
        //dd($re);
        Documentin::whereId($id)->update($re);

        return redirect()->back()->with('success', 'Đã cập nhật thành công');
    }

    public function cvdaxuly(Request $request, $id)
    {
        $re['status'] = $request->status;
        Documentin::whereId($id)->update($re);
        return redirect()->back()->with('success', 'Đã cập nhật thành công');
    }

    public function lanhdaogiaoviec(Request $request, $id)
    {
        if (Gate::denies('nguoidungthuong')) {
            $re['butphe'] = $request->butphe;
            $re['ngaydenhan'] = $request->ngaydenhan;
            if ($request->nguoiphutrach) {
                $id_nguoiphutrachtuform = DB::table('users')
                    ->select('id')->where('name', $request->nguoiphutrach)
                    ->first();
                $request->merge(['nguoiphutrach' => $id_nguoiphutrachtuform->id]);
                $re['nguoiphutrach'] = $request->nguoiphutrach;
            }
            $re['status'] = $request->status;
            Documentin::whereId($id)->update($re);
            return redirect()->back()->with('success', 'Đã cập nhật thành công');
        } else {
            abort(403, "Bạn không có quyền truy cập");
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $documentin = Documentin::findOrFail($id);
        //dd($documentin->pathpdf);
        $path = "//public/" . $documentin->pathpdf;
        if (Storage::exists($path)) {
            Storage::delete($path);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
            $documentin->delete();
            return redirect('/cong-van-den')->with('success', 'Đã xóa công văn');
            //dd(Storage::exists('uploads/1655831601_Jsd3lqZlXUUdJC9gTrSgSiLhrGlLqKEatZ61vSzL.pdf'));
        } else {

            return redirect('/cong-van-den')->with('success', 'Không xóa được file nhưng dữ liệu đã xóa');
            // echo $path;
            // dd(Storage::exists('/public/uploads/1655831601_Jsd3lqZlXUUdJC9gTrSgSiLhrGlLqKEatZ61vSzL.pdf'));
            // $url = Storage::url('uploads/1655831601_Jsd3lqZlXUUdJC9gTrSgSiLhrGlLqKEatZ61vSzL.pdf');
            // dd($url);

        }
    }
}
