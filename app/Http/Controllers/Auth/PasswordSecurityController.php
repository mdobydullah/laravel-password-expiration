<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordSecurityController extends Controller
{
    // reset password form
    public function resetPasswordForm(Request $request)
    {
        $password_expired_id = $request->session()->get('password_expired_id');
        if (!isset($password_expired_id)) {
            return redirect('/login');
        }
        return view('auth.reset_password');
    }

    // reset password
    public function resetPassword(Request $request)
    {
        // check expire id
        $password_expired_id = $request->session()->get('password_expired_id');
        if (!isset($password_expired_id)) {
            return redirect('/login');
        }

        // validate
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // the requests
        $request_current_password = $request->current_password;
        $request_new_password = $request->new_password;
        $request_new_password_confirm = $request->new_password_confirm;

        // the passwords matches
        $user = User::find($password_expired_id);
        if (!(Hash::check($request_current_password, $user->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        // current password and new password are same
        if (strcmp($request_current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "New password cannot be same as your current password. Please choose a different password.");
        }

        // new password and new password confirm doesn't match
        if (strcmp($request_new_password, $request_new_password_confirm) == 1) {
            return redirect()->back()->with("error", "New password doesn't match with confirm password.");
        }

        // change Password
        $user->password = bcrypt($request->new_password);
        $user->save();

        // update password update time
        $user->passwordSecurity->password_updated_at = Carbon::now();
        $user->passwordSecurity->save();

        return redirect('/login')->with("status", "Password changed successfully. Now you can login!");
    }
}
