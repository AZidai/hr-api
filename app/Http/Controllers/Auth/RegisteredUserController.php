<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['required', 'string', 'max:100'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_country' => ['required', 'string', 'max:100'],
            'jmbg' => ['required', 'string', 'max:13'],
            'home_address' => ['string', 'max:100'],
            'home_place' => ['required', 'string', 'max:100'],
            'home_country' => ['required', 'string', 'max:100'],
            'phone' => ['string', 'max:15'],
            'seniority' => ['string', 'max:15'],
            'team_lead_id' => ['string', 'max:15'],
            'picture' => ['string', 'max:255']
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'birth_country' => $request->birth_country,
            'jmbg' => $request->jmbg,
            'home_address' => $request->home_address,
            'home_place' => $request->home_place,
            'home_country' => $request->home_country,
            'phone' => $request->phone,
            'seniority' => $request->seniority,
            'role_id' => 3,
            'team_lead_id' => $request->team_lead_id,
            'picture' => $request->picture,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->json($user);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function list(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => ['int', 'max:3']
        ]);

        $users = User::all()->where('role_id', $request->role_id);

        return response()->json($users);
    }
}
