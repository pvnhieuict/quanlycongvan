<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('quantrihethong')){
        $users = User::with('group')->get();
        return view('users.index',compact('users'));
        } else {
            return redirect('/error')->with('error','Bạn không có quyền tạo người dùng. Vui lòng quay lại.');   
        }
        
    }

    // Get du lieu user json
    public function autocomplete(Request $request)
    {        
        $data = User::select("name","id")
                ->where("name","LIKE","%{$request->str}%")
                ->get('query');   
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('quantrihethong')){
            $groups = Group::all();
            return view('users.create',compact('groups'));
        } else
        {
            return redirect('/error')->with('error','Bạn không có quyền tạo người dùng. Vui lòng quay lại.');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestUserForm = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'personal_id'=>'required',
            'password'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>'required',
            'position'=>'required',
            'group_id'=>'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>'required'
        ]);

        $requestUserForm['password'] = Hash::make($request->password);
        $requestUser = User::create($requestUserForm);
        return redirect('/nguoi-dung/create')->with('success','Thêm người dùng thành công');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $groups = Group::all();
        return view('users.edit',compact('users','groups'));
    }

    public function profile($id)
    {
        $users = User::find($id);
        $groups = Group::all();
        return view('users.profile',compact('users','groups'));
    }

    public function updateprofile(Request $request, $id)
    {
        
            $requestUserForm = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone'=>'required',
                'position'=>'required']);

        User::whereId($id)->update($requestUserForm);
        return redirect()->back()->with('success','Đã câp nhật thành công');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        if ($request->is('password')) {
            $requestUserForm = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'personal_id'=>'required',
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone'=>'required',
                'position'=>'required',
                'group_id'=>'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role'=>'required'
            ]);
        } else {
            $requestUserForm = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'personal_id'=>'required',
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone'=>'required',
                'position'=>'required',
                'group_id'=>'required',
                'role'=>'required'
            ]);
        }

        User::whereId($id)->update($requestUserForm);
        return redirect('/nguoi-dung')->with('success','Đã câp nhật thành công');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/nguoi-dung')->with('success','Đã xóa thành công');
    }

    public function login(){
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'personal_id' =>'required',
            'password' => 'required|min:6'
        ];
        $messages = [
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('login')->withErrors($validator)->withInput();
        } else {
            // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
            $email = $request->input('personal_id');
            $password = $request->input('password');
     
            if( Auth::attempt(['personal_id' => $email, 'password' =>$password])) {
                // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
                return redirect('cong-van-den');
            } else {
                // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng!');
                return redirect('login');
            }
        }
    }
}
