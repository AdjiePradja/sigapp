<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $mine = $user->isAdmin() ? \App\Models\Report::all() : $user->reports;
        $closed = $mine->where('status', 'done')->count();

        return view('profil', [
            'total' => $mine->count(),
            'closed' => $closed,
            'poin' => $mine->count() * 2 + $closed * 3,
        ]);
    }
}
