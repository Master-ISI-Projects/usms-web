<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Constant;
use App\Helpers\Helper;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index', [
            'admins' => User::where('role', Constant::USER_ROLES['admin'])
                            ->filter(request()->all())
                            ->paginate(Constant::COUNT_PER_PAGE)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'gender' => $request->gender, 
            'picture' => Helper::saveFileFromRequest($request, 'picture'), 
            'tel' => $request->tel, 
            'email' => $request->email, 
            'password' => bcrypt($request->password), 
            'visible_password' => $request->password, 
            'role' => Constant::USER_ROLES['admin']
        ]);

        session()->flash('success', 'Saved');

        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.admins.show', [
            'admin' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.admins.edit', [
            'admin' => User::findOrFail($id)
        ]);
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
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'gender' => $request->gender, 
            'picture' => Helper::saveFileFromRequest($request, 'picture', $user->picture) ?? $user->picture, 
            'tel' => $request->tel, 
            'email' => $request->email, 
            'password' => $request->password ? bcrypt($request->password) : $user->password, 
            'visible_password' => $request->password ? $request->password : $user->visible_password, 
            'is_active' => $request->is_active ? true : false, 
        ]);

        session()->flash('success', 'Updated');

        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'Updated');

        return redirect()->route('admins.index');
    }
}
