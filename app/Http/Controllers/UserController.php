<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ResetPasswordUsersRequest;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin', User::class);
        $users = User::where('level', '!=', 'admin')->get();
        return view('pages.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin', User::class);
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('isAdmin', User::class);
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' =>$request->password,
            'level' => $request->level
        ]);

        Alert::success('Sukses', 'User berhasil ditambahkan');
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin', User::class);

        $user = User::findOrFail($id);

        return view('pages.users.edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('isAdmin', User::class);

        $user = User::findOrFail($id);

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'level' => $request->level

        ]);

        Alert::success('Sukses', 'Data user berhasil diupdate');
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
        $this->authorize('isAdmin', User::class);

        $user = User::findOrFail($id);

        $user->delete();

        Alert::success('Sukses', "User dengan nama {$user->name} berhasil dihapus");
        return redirect()->back();


    }

    public function resetPassword($id)
    {
        $this->authorize('isAdmin', User::class);
        $user = User::findOrFail($id);
        return view('pages.users.reset_password', ['user' => $user]);
    }

    public function UpdatePassword(ResetPasswordUsersRequest $request, $id)
    {
        $this->authorize('isAdmin', User::class);
        $user = User::findOrFail($id);
        $user->update([
            'password' => $request->kata_sandi_baru,
        ]);

        Alert::success('Sukses', "Kata sandi {$user->username} sukses direset");
        return redirect()->back();

    }
}
