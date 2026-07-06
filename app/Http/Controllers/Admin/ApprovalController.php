<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApprovalController extends Controller
{
    public function index(): View
    {
        return view('approve', [
            'pending' => User::where('status', 'pending')->latest()->get(),
            'active' => User::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function approve(User $user): RedirectResponse
    {
        $user->update(['status' => 'active']);

        return back()->with('toast', "{$user->name} disetujui");
    }

    public function reject(User $user): RedirectResponse
    {
        $user->update(['status' => 'rejected']);

        return back()->with('toast', "Pendaftaran {$user->name} ditolak");
    }
}
