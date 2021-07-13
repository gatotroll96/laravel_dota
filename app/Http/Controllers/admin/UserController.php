<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helper\helper;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
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
        //
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

    public function login()
    {
        return view('admin.user.login');
    }

    public function checkLogin(Request $request){
        $this->validate($request,
            [   'username'              =>  'required',
                'password'              =>  'required'
            ],
            [   'username.required'     => 'Vui lòng điền username !!!',
                'password.required'     => 'Vui lòng điền password !!!' 
            ]
        );
        $username = $request->username;
        $password = md5($request->password);
        $check = DB::table('users')
                        ->where('username','=',$username)
                        ->where('password','=',$password)
                        ->exists();

        if($check == true){
            $getInfo = DB::table('users')
                        ->select('id', 'username', 'avatar', 'email', 'group_acp')
                        ->where('username','=',$username)
                        ->where('password','=',$password)
                        ->get()->toArray();
            
            
     

            $arrData = array();
            $arrData['id'] = $getInfo[0]->id;
            $arrData['username'] = $getInfo[0]->username;
            $arrData['avatar'] = $getInfo[0]->avatar;
            $arrData['email'] = $getInfo[0]->email;
            $arrData['group_acp'] = $getInfo[0]->group_acp;

            Session::put('logged',$arrData);
            
            return redirect('admin');
            
        }else{
            
            return redirect('admin/login')->with('message', 'Username hoặc Password không đúng');
        }    

    }

    public function logout()
    {
        if (Session::exists('logged')) {
            Session::forget('logged');
            return redirect('admin/login');
        }
    }
}
