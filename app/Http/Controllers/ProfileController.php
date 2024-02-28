<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Network;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(){
        $network = Network::where('user_id',Auth::id())->count();
        $mynetworks = Network::where('parent_user_id',Auth::id())->where('refercode',Auth::user()->refercode)->get();

        
        $datelabel = [];
        $datedata = [];

        for($i = 30;$i >= 0;$i--){
            $datelabel[] = Carbon::now()->setTimezone('Asia/Dhaka')->subDays($i)->format('d-m-Y');
            $datedata[] = Network::whereDate('created_at',Carbon::now()->setTimezone('Asia/Dhaka')->subDays($i)->format('Y-m-d'))->where('parent_user_id',Auth::id())->count();
            // $datedata[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        
        $datelabel = json_encode($datelabel);
        $datedata  = json_encode($datedata);

        return view('dashboard',compact('network','mynetworks','datelabel','datedata'));
    }

    public function profilerefer(){
        $mynetworks = Network::where('parent_user_id',Auth::id())->where('refercode',Auth::user()->refercode)->get();
        $users = Network::where('parent_user_id',Auth::id())->where('refercode',Auth::user()->refercode)->paginate(10);

        $datelabel = [];
        $datedata = [];

        for($i = 30;$i >= 0;$i--){
            $datelabel[] = Carbon::now()->setTimezone('Asia/Dhaka')->subDays($i)->format('d-m-Y');
            $datedata[] = Network::whereDate('created_at',Carbon::now()->setTimezone('Asia/Dhaka')->subDays($i)->format('Y-m-d'))->where('parent_user_id',Auth::id())->count();
            // $datedata[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }

        $datelabel = json_encode($datelabel);
        $datedata  = json_encode($datedata);


        return view('profile.refer',compact('mynetworks','users','datelabel','datedata'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
