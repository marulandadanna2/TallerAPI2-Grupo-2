<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('URL_BASE_API', "https://dummyjson.com");
    }

    public function index()
    {
        $response = Http::get($this->baseUrl . '/users');

        if ($response->successful()) {
            $users = $response->json()['users'] ?? [];
            return view('users.index', compact('users'));
        }

        return back()->withErrors(['error' => 'No se pudieron cargar los usuarios']);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request)
    {
        $response = Http::post($this->baseUrl . '/users/add', [
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'email'     => $request->email,
            'password'  => $request->password,
            'age'       => $request->age,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'username'  => $request->username,
        ]);

        return $response->successful()
            ? redirect()->route('users.index')->with('message', 'Usuario creado exitosamente')
            : back()->withErrors(['error' => $response->json()['message'] ?? 'Error al crear usuario']);
    }

    public function edit(string $id)
    {
        $response = Http::get($this->baseUrl . '/users/' . $id);

        if ($response->successful()) {
            $user = $response->json();
            return view('users.form', compact('user'));
        }

        return redirect()->route('users.index')->withErrors(['error' => 'Usuario no encontrado']);
    }

    public function update(Request $request, string $id)
    {
        $response = Http::put($this->baseUrl . '/users/' . $id, [
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'email'     => $request->email,
            'password'  => $request->password,
            'age'       => $request->age,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'username'  => $request->username,
        ]);

        return $response->successful()
            ? redirect()->route('users.index')->with('message', 'Usuario actualizado exitosamente')
            : back()->withErrors(['error' => $response->json()['message'] ?? 'Error al actualizar usuario']);
    }

    public function destroy(string $id)
    {
        $response = Http::delete($this->baseUrl . '/users/' . $id);

        return $response->successful()
            ? redirect()->route('users.index')->with('message', 'Usuario eliminado exitosamente')
            : back()->withErrors(['error' => $response->json()['message'] ?? 'Error al eliminar usuario']);
    }
}