<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses dashboard.');
        }
        return view('dashboard.index');
    }
}
