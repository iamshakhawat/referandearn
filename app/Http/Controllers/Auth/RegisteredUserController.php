<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Network;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $refercode = Str::upper(Str::random(6));

        $user_id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'refercode' => $refercode,
            'password' => Hash::make($request->password),
        ]);



        if($request->refercode){
            $user = User::where('refercode',$request->refercode)->get();
            if(count($user) > 0){
                Network::insert([
                    'refercode' => $request->refercode,
                    'user_id' => $user_id,
                    'parent_user_id' => $user[0]['id'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        }
        
        return redirect()->route('login');
    }
}
