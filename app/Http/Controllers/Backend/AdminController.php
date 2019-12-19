<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->paginate(5);
        return view('backend.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|max:191',
            'password'=>'required|max:191|min:6',
            'first_name'=>'max:191',
            'last_name'=>'max:191',
        ]);

        $meassage = '';
        if (!$validator->fails()) {
            $request['password'] = Hash::make($request['password']);
            $result = User::create($request->all());
            if ($result) {
                $meassage = '新增成功';
            } else {
                $meassage = '新增失敗';
            }
            return redirect()->route('admin.user.index')->with('meassage', $meassage);
        } else {
           return view('backend.admin.create')->withErrors($validator);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.admin.edit')->with('user', $user);
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
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'email'=>'required|max:191',
            'first_name'=>'max:191',
            'last_name'=>'max:191',
        ]);

        $meassage = '';
        if (!$validator->fails()) {
            $result = $user->update($request->all());
            if ($result) {
                $meassage = '更新成功';
            } else {
                $meassage = '更新失敗';
            }
            return redirect()->route('admin.user.index')->with('meassage', $meassage);
        } else {
           return view('backend.admin.edit')->withErrors($validator);
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
        //
    }
}
