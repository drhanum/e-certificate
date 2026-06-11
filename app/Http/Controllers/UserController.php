<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $certificates = Certificate::where(
            'email',
            Auth::user()->email
        )->latest()->get();

        return view(
            'user.dashboard',
            compact('certificates')
        );
    }
}