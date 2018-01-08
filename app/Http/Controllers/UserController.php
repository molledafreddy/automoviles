<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

	public function index()
    {
        return view('user.index'); 
    }
    
    public function profile()
    {
    	return [
    		'user' => User::FindOrFail(Auth::user()->id),
    		'images' => 'esta es una prueba'
    	];
        
        //return User::FindOrFail(Auth::user()->id);
        //return User::all();
    }


    public function show()
    {
        return view('admin.user.show') -> with(['id' => request() -> id]);
    }

    public function getData()
    {
       return User::FindOrFail(request()->id);
    }


    public function update($id)
    {
        $user = User::find($id);

        $user->fill(request()->all());

        $user->save();

        return ['message' => 'Se ha actualizada con exito'];
    }


}
