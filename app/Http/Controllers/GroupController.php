<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $re = $request->validate([
            'name'=>'required',
            'slug'=>'required'
        ]);

        $reGroups = Group::create($re);
        return redirect('/don-vi/create')->with('success','Đã lưu thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userOfGroup = Group::find($id)->users->toArray();
        //$users = $userOfGroup->users->name;
        dd($userOfGroup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $groups = Group::find($id);
        return view('groups.edit',compact('groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $reGroup = $request->validate([
            'name'=>'required',
            'slug'=>'required'
        ]);

        Group::whereId($id)->update($reGroup);
        return redirect('/don-vi')->with('success','Đã câp nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect('/don-vi')->with('success','Đã xóa thành công');
    }
}
