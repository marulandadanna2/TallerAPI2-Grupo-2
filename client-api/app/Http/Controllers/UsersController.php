<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_BASE_API',"https://dummyjson.com");
        $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/users');
        if($response->successful())
        {
            $users = $response->json()['users'];
            return view('users.index', compact('users'));
        }
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env('URL_BASE_API', "https://dummyjson.com");
        $response = Http::acceptJson()->withToken(Session::get('token'))->post($url . '/users/add', [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'age' => $request->age,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'username' => $request->username 
        ]);

        if($response->successful())
            {
                session()->flash('message', 'Usuarios creado exitosamente');
                return redirect()->route('users.index');
            }
        elseif($response->status() == Response::HTTP_BAD_REQUEST)
        {
            $errors = $response->json()['errors'];
            return redirect()->route('users.create')->withInput()->withErrors($errors);
        }
        else
        {
            abort($response->status());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = env('URL_BASE_API', "https://dummyjson.com");
        $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/users/' . $id);

        if($response->successful())
        {
            $user = $response->json();
            return view('users.edit', compact('user'));
        }
        elseif($response->status() == Response::HTTP_BAD_REQUEST)
        {
            $errors = $response->json()['errors'];
            return redirect()->route('users.index')->withInput()->withErrors($errors);
        }
        else
        {
            abort($response->status());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $url = env('URL_BASE_API', "https://dummyjson.com");
        $response = Http::acceptJson()->withToken(Session::get('token'))->put($url . '/users/' . $id, [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'age' => $request->age,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'username' => $request->username 
        ]);

        if($response->successful())
            {
                session()->flash('message', 'Usuarios actualizado exitosamente');
                return redirect()->route('users.index');
            }
        elseif($response->status() == Response::HTTP_BAD_REQUEST)
        {
            $errors = $response->json()['errors'];
            return redirect()->route('users.create')->withInput()->withErrors($errors);
        }
        else
        {
            abort($response->status());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $url = env('URL_BASE_API', "https://dummyjson.com");
        $response = Http::acceptJson()->withToken(Session::get('token'))->delete($url . '/users/' . $id);

        if($response->successful())
        {
            session()->flash('message', 'usuario eliminado exitosamente');
            return redirect()->route('users.index');
        }
        elseif($response->status() == Response::HTTP_BAD_REQUEST)
        {
            $errors = $response->json()['errors'];
            return redirect()->route('users.index')->withInput()->withErrors($errors);
        }
        else
        {
            abort($response->status());
        }
    }
}
