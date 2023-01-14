<?php

namespace App\Http\Controllers;

use App\Models\Documentout;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documenouts = Documentout::where('secret', 1)->orderBy('out_date', 'desc')->paginate(8);
        return view('documentouts.index', compact('documenouts'));
    }

    public function index_qlcvdi()
    {
        if (Auth::check() && Gate::denies('nguoidungthuong')) {
            $documentouts = DB::table('documentouts')->orderBy('out_date', 'desc')->paginate(10);
            return view('documentouts.index_qlcvdi', compact('documentouts'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn không có quyền truy cập');
    }

    public function index_qlcvdith()
    {
        if (Auth::check() && Gate::denies('nguoidungthuong')) {
            $currentTime = Carbon::now();
            $documentouts = Documentout::where([['status', '<>', 3], ['ngaydenhan', '<', $currentTime], ['ngaydenhan', '<>', '0000-00-00']])->orderBy('out_date', 'desc')->paginate(10);
            //dd($documentouts);
            return view('documentouts.index_qlcvdith', compact('documentouts'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn không có quyền truy cập');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::allows('vanthu', Auth::user())) {
            $dataTypeDocuments = Type::all();
            return view('documentouts.create', compact('dataTypeDocuments'));
        } else {
            abort(403, "Bạn không có quyền truy cập.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('vanthu', Auth::user())) {
            $request->validate([
                'pathpdf' => 'required|mimes:pdf|max:20048'
            ]);
            if ($request->nguoiphutrach) {
                $id_nguoiphutrachtuform = DB::table('users')
                    ->select('id')->where('name', $request->nguoiphutrach)
                    ->first();
                $request->merge(['nguoiphutrach' => $id_nguoiphutrachtuform->id]);
            }
            $re = $request->toArray();
            if ($request->file('pathpdf')) {
                $fileName = time() . '_' . $request->pathpdf->hashName();
                $filePath = $request->file('pathpdf')->storeAs('uploads', $fileName, 'public');
                $re['pathpdf'] = $filePath;
                $re['namepdf'] = $fileName;
                $show = Documentout::create($re);
                return redirect('/cong-van-di/create')->with('success', 'Đã lưu thành công');
            }
        } else {
            abort(403, "Bạn không có quyền truy cập.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documentout  $documentout
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataDocumentout = Documentout::find($id);
        $nguoiphutrach = DB::table('users')
            ->select('name')->where('id', $dataDocumentout->nguoiphutrach)
            ->first();
        return view('documentouts.show', compact('dataDocumentout', 'nguoiphutrach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documentout  $documentout
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('nguoidungthuong', Auth::user())) {
            $dataTypeDocuments = Documentout::find($id);
            $typeDocument = Type::all();
            $nguoiphutrach = DB::table('users')
                ->select('name')->where('id', $dataTypeDocuments->nguoiphutrach)
                ->first();
            //dd($nguoiphutrach);
            return view('documentouts.edit', compact('dataTypeDocuments', 'typeDocument', 'nguoiphutrach'));
        } else {
            abort(403, "Bạn không có quyền truy cập.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentoutRequest  $request
     * @param  \App\Models\Documentout  $documentout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Gate::denies('nguoidungthuong', Auth::user())) {
            $user = User::find(Auth::id());
            $request->validate([
                'label_number' => 'required|max:255',
                'title' => 'required|max:255',

            ]);
            if ($request->nguoiphutrach) {
                $id_nguoiphutrachtuform = DB::table('users')
                    ->select('id')
                    ->where('name', $request->nguoiphutrach)
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
                $documentout = Documentout::findOrFail($id);
                $path = "//public/" . $documentout->pathpdf;
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
            $re['out_date'] = $request->out_date;
            $re['store_date'] = $request->store_date;
            $re['ngaydenhan'] = $request->ngaydenhan;
            $re['detail'] = $request->detail;
            $re['copy_number'] = $request->copy_number;
            $re['to_place'] = $request->from_place;
            if ($request->nguoiphutrach) {
                $re['nguoiphutrach'] = $request->nguoiphutrach;
            }
            //dd($re);
            Documentout::whereId($id)->update($re);

            return redirect()->back()->with('success', 'Đã cập nhật thành công');
        } else {
            abort(403, "Bạn không có quyền truy cập.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentout  $documentout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('vanthu', Auth::user())) {
            $documentout = Documentout::findOrFail($id);
            $path = "//public/" . $documentout->pathpdf;
            if (Storage::exists($path)) {
                Storage::delete($path);
                $documentout->delete();
                return redirect('/cong-van-di')->with('success', 'Đã xóa công văn');
            } else {
                return redirect('/cong-van-di')->with('success', 'Không xóa được file nhưng dữ liệu đã xóa');
            }
        } else {
            abort(403, "Bạn không có quyền truy cập.");
        }
    }

    public function cvdidaxuly(Request $request, $id)
    {
        $re['status'] = $request->status;
        Documentout::whereId($id)->update($re);
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
            Documentout::whereId($id)->update($re);
            return redirect()->back()->with('success', 'Đã cập nhật thành công');
        } else {
            abort(403, "Bạn không có quyền truy cập");
        }
    }
}
