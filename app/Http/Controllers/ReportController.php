<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public const CATEGORIES = [
        'Jalan / Tanggul',
        'Alat Berat',
        'Kelistrikan',
        'Kebakaran / Panas',
        'Lingkungan / Air',
        'Housekeeping',
    ];

    public const LOCATIONS = [
        'Pit A – Front Loading',
        'Jalan Hauling KM 3',
        'Workshop Utama',
        'Settling Pond 2',
        'Disposal Utara',
        'Area Kantor & Mess',
    ];

    public function home(Request $request): View
    {
        $mine = $request->user()->reports()->latest()->get();

        return view('home', [
            'stats' => $this->countByStatus($mine),
            'recent' => $mine->take(3),
        ]);
    }

    public function lapor(): View
    {
        return view('lapor', [
            'categories' => self::CATEGORIES,
            'locations' => self::LOCATIONS,
        ]);
    }

    public function storeHazard(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'location' => ['required', 'string', 'in:'.implode(',', self::LOCATIONS)],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:8192'],
            'gps_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'gps_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'gps_acc' => ['nullable', 'integer'],
            'gps_manual' => ['nullable', 'boolean'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reports', 'public');
        }

        Report::create([
            'no' => Report::nextNo('hazard'),
            'type' => 'hazard',
            'category' => $data['category'],
            'location' => $data['location'],
            'description' => $data['description'] ?: '(tanpa uraian)',
            'status' => 'open',
            'user_id' => $request->user()->id,
            'gps_lat' => $data['gps_lat'] ?? null,
            'gps_lng' => $data['gps_lng'] ?? null,
            'gps_acc' => $data['gps_acc'] ?? null,
            'gps_manual' => $request->boolean('gps_manual'),
            'photo' => $photoPath,
        ]);

        return redirect()->route('dash')->with('toast', 'Laporan terkirim ke Admin HSE');
    }

    public function darurat(): View
    {
        return view('darurat');
    }

    public function storeEmergency(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'gps_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'gps_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'gps_acc' => ['nullable', 'integer'],
        ]);

        $user = $request->user();
        $hasGps = isset($data['gps_lat'], $data['gps_lng']);

        $desc = $hasGps
            ? sprintf(
                'Sinyal darurat dari %s — koordinat %s, %s%s.',
                $user->name,
                $data['gps_lat'],
                $data['gps_lng'],
                isset($data['gps_acc']) ? " (±{$data['gps_acc']} m)" : ''
            )
            : "Sinyal darurat dari {$user->name} — GPS tidak aktif/diblokir.";

        Report::create([
            'no' => Report::nextNo('emg'),
            'type' => 'emg',
            'category' => 'SINYAL DARURAT',
            'location' => $hasGps ? "GPS {$data['gps_lat']}, {$data['gps_lng']}" : 'lokasi tidak tersedia',
            'description' => $desc,
            'status' => 'open',
            'user_id' => $user->id,
            'gps_lat' => $data['gps_lat'] ?? null,
            'gps_lng' => $data['gps_lng'] ?? null,
            'gps_acc' => $data['gps_acc'] ?? null,
        ]);

        return redirect()->route('dash')->with('toast', 'Sinyal darurat terkirim');
    }

    public function dash(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $reports = Report::with('user')->latest()->get();
        } else {
            $reports = $user->reports()->latest()->get();
        }

        return view('dash', [
            'reports' => $reports,
            'stats' => $this->countByStatus($reports),
        ]);
    }

    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:prog,done'],
        ]);

        $report->update(['status' => $data['status']]);

        return back()->with('toast', $data['status'] === 'prog' ? 'Status diubah: ditangani' : 'Status diubah: selesai');
    }

    private function countByStatus($reports): array
    {
        return [
            'open' => $reports->where('status', 'open')->count(),
            'prog' => $reports->where('status', 'prog')->count(),
            'done' => $reports->where('status', 'done')->count(),
        ];
    }
}
