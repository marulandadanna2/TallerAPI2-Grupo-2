<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('token')) {
            return redirect()->route('users.index');
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * login de usuarios
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $response = Http::acceptJson()->post(env('URL_BASE_API') . '/auth/login', [
                'username' => $request->username,
                'password' => $request->password
            ]);

            $data = $response->json();

            if (!$response->successful()) {
                $message = $data['message'] ?? 'Credenciales incorrectas';
                return back()
                    ->withInput()
                    ->withErrors(['error' => $message]);
            }

            Session::put('user', $data);
            Session::put('token', $data['accessToken']); // Cambiar token por accessToken

            return redirect()
                ->route('users.index')
                ->with('success', 'Bienvenido ' . ($data['firstName'] ?? 'Usuario'));

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    /**
     * logout de usuarios
     */
    public function logout()
    {
        Session::forget(['user', 'token']);
        return redirect()
            ->route('auth.index')
            ->with('success', 'Has cerrado sesión correctamente');
    }
    
}
