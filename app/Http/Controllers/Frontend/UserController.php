<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const USER_GENDER = [
        'male' => 'Male',
        'female' => 'Female',
        'undefined' => 'Undefined',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function updateUser(array $data, $id)
    {
        try {
            $user = User::findOrFail($id);

            return $user->update($data);
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }

    }

    protected function uploadImage($image)
    {
        if ($image != null) {
            $image_name = $image->getClientOriginalName();
            $image->move(config('config.link_avatar'), $image_name);

            return $image_name;
        }
        return null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return view('frontend.users.view', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            if (Auth::user()->id == $id) {
                $user_gender = self::USER_GENDER;

                return view('frontend.users.update', compact('user', 'user_gender'));
            }
            return redirect()->route('homepage');

        } catch (Exception $e) {
            return redirect()->route('homepage');
        }
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
        $validate = User::validateUpdateUser($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $user_data = [
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'address' => $request['address'],
            'job' => $request['job'],
        ];
        $image_name = $this->uploadImage($request->avatar);
        if ($image_name != null) {
            $user_data['avatar'] = $image_name;
        }

        $user = $this->updateUser($user_data, $id);

        return redirect()->route('user.show', ['id' => $id]);
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
