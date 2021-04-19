<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.users.index')->with('title_page', 'danh sách thành viên')
                                        ->with('create_page', 'user.create')
                                        ->with('list_page', 'user.index')
                                        ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')->with('title_page', 'Thêm thành viên')
                                        ->with('create_page', 'user.create')
                                        ->with('list_page', 'user.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            // 'rePassword' => 'required',
            'permission' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_id' => $request->permission
        ]);

        Session::flash('success', 'Thêm thành viên thành công');

        if($request->close){
            return redirect()->route('user.index');
        } else {
            return redirect()->back();
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
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('title_page', 'Thêm thành viên')
                                        ->with('create_page', 'user.create')
                                        ->with('list_page', 'user.index')
                                        ->with('user', $user);
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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'confirmed',
        ]);


        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->phone = $request->phone;
        // $user->permission_id = $request->permission;
        $user->status = $request->status;
        $user->updated_at = Carbon::now();
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Session::flash('success', 'Cập nhật thông tin thành viên thành công.');

        return redirect()->back();


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


    public function remove()
    {
        $user = User::find(request()->id);
        $user->delete();
    }

    public function updateStatus()
    {
        $data = request()->all();
        // dd($data);
        $user = User::find($data['id']);
        if($data['name'] == 'publish') {
            $user->status = $data['value'];
        }
        $user->updated_at = Carbon::now();
        $user->save();
    }
}
