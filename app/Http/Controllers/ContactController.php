<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    // handles the validation and storing in the database

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Contact::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'mensaje' => $data['mensaje'],
        ]);

        return view('welcome');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mensaje' => ['required', 'string'],
        ]);
    }
}
