<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaTim'    => 'required|string',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // flash('error')->error();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('namaTim', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admin.home');
        }else{
            Session::flash('error-password','Password Salah');
            return redirect()->back()->withInput();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function regist(){
        $dict_provinsi = ApiController::call();
        return view('auth.register',[
            "listProv" => $dict_provinsi
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaTim'    => 'required|unique:users,namaTim',
            'emailTim' => 'unique:users,emailTim',
        ],
        [
            'namaTim.unique'=>'Nama Tim sudah diambil orang',
        ]
        );

        if ($validator->fails()) {
            // flash('error')->error();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return User::create([
            'namaTim' => $request->namaTim,
            'emailTim' => $request->email,
            'password' => Hash::make($request->password),
            'asalSekolah' => $request->asalSekolah,
            'kotaSekolah' => $request->kotaSekolah,
            'provinsiSekolah' => $request->provSekolah
        ]);

        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
