<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    //i don't have to pass a parameter id in this function cuz i already have the user im searching for authenticated.
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([

            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'birthdate' => ['nullable','date','before:today'],
            'gender' => ['in:male,Female'],
            'country' => ['required','string','size:2']

        ]);

        
        $user = $request->user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated successfully!');

        /*the fill method is used to save the data if the user has no profile and is trying to make a profile
        and if the user has a profile then the fill method can set up the new values and replace it with old one
        -->notice that fill method only saves the data to database when i write the method save after.
        */

        // $profile = $user->profile;
        // if ($profile->first_name) {

        //     $profile->update($request->all());

        // } else {

        //     $user->profile->create($request->all());
        // }




    }



}
