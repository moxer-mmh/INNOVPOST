<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'account_number' => ['required', 'string', 'max:255', 'unique:users,account_number'],  // Validation du numéro de compte dans la table users
            'card_number' => ['unique:users,card_number' , 'required', 'string', 'size:16'],  // Validation du numéro de carte (taille standard de carte)
            'card_expiration_date' => ['required', 'date_format:Y-m'],  // Validation du format de date (mois et année)
            'phone_number' => ['required', 'regex:/^\+?[0-9]{10,15}$/'  , 'unique:users,phone_number'],  // Validation du numéro de téléphone (exemple international)
        ]);

        $user = User::create([
            'account_number' => $request->account_number,
            'card_number' => $request->card_number,
            'card_expiration_date' => $request->card_expiration_date ,
            'phone_number' => $request->phone_number ,
            'password' => $request->password
        ]);

        event(new Registered($user));

        Auth::login($user);

        return inertia_location('/dashboard');
    }
}
