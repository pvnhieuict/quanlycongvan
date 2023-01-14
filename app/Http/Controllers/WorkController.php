<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Documentin;
use App\Models\Documentout;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $documentins = Documentin::where([['nguoiphutrach', Auth::id()], ['status', '<>', 3]])
                ->orderBy('in_date')->paginate(5);

            $documentouts = Documentout::where([['nguoiphutrach', Auth::id()], ['status', '<>', 3]])
                ->orderBy('out_date')->paginate(5);
            return view('works.index', compact('documentins','documentouts'));
        }
        return redirect("login")->withSuccess('Xin lỗi! Bạn chưa đăng nhập');
    }
}
