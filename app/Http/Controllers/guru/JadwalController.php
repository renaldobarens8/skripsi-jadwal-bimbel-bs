<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $weekStart = $request->query('week')
            ? Carbon::parse($request->query('week'))->startOfWeek(Carbon::MONDAY)
            : Carbon::now()->startOfWeek(Carbon::MONDAY);

        $weekEnd  = $weekStart->copy()->addDays(5); // Monday + 5 = Saturday
        $prevWeek = $weekStart->copy()->subWeek()->toDateString();
        $nextWeek = $weekStart->copy()->addWeek()->toDateString();

        $jadwals = Jadwal::where('user_id', Auth::id())
            ->whereBetween('tanggal', [
                $weekStart->toDateString(),
                $weekEnd->toDateString(),
            ])->get();

        $scheduleGrid = [];
        foreach ($jadwals as $jadwal) {
            $scheduleGrid[$jadwal->jam][$jadwal->hari] = $jadwal;
        }

        $hariList = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $jamList = [
            1 => '10:00 - 12:00',
            2 => '13:00 - 15:00',
            3 => '15:30 - 17:30',
        ];

        return view('guru.jadwal.index', compact(
            'scheduleGrid', 'hariList', 'jamList',
            'weekStart', 'weekEnd', 'prevWeek', 'nextWeek'
        ));
    }

    public function create($jam, $hari)
    {
        return view('guru.jadwal.create', compact('jam', 'hari'));
    }

    public function createWithTimeSlot(Request $request, $jam, $hari)
    {
        $tanggal = $request->query('tanggal'); // date string e.g. "2026-03-17"
        return view('guru.jadwal.create', compact('jam', 'hari', 'tanggal'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hari'      => ['required', 'integer'],
            'jam'       => ['required', 'integer'],
            'tanggal'   => ['required', 'date'],
            'pelajaran' => ['required', 'string', 'max:255'],
            'guru'      => ['nullable', 'string', 'max:255'],
            'notes'     => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = Auth::id();

        // Check for duplicate slot
        $exists = Jadwal::where('user_id', Auth::id())
            ->where('hari', $data['hari'])
            ->where('jam',  $data['jam'])
            ->where('tanggal', $data['tanggal'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['hari' => 'Slot ini sudah terisi. Pilih hari, jam, atau tanggal yang berbeda.']);
        }

        Jadwal::create($data);

        return redirect()->route('teacher.jadwal.index', [
            'week' => \Carbon\Carbon::parse($data['tanggal'])
                ->startOfWeek(\Carbon\Carbon::MONDAY)
                ->toDateString()
        ])->with('success', 'Jadwal dibuat.');
    }

    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('guru.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('guru.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $data = $request->validate([
            'hari'      => ['required', 'integer'],
            'jam'       => ['required', 'integer'],
            'tanggal'   => ['required', 'date'],
            'pelajaran' => ['required', 'string', 'max:255'],
            'guru'      => ['nullable', 'string', 'max:255'],
            'notes'     => ['nullable', 'string', 'max:255'],
        ]);

        // Check for duplicate slot — exclude the current record
        $exists = Jadwal::where('user_id', Auth::id())
            ->where('hari', $data['hari'])
            ->where('jam',  $data['jam'])
            ->where('tanggal', $data['tanggal'])
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['hari' => 'Slot ini sudah terisi. Pilih hari, jam, atau tanggal yang berbeda.']);
        }

        $jadwal->update($data);

        return redirect()->route('teacher.jadwal.index', [
            'week' => \Carbon\Carbon::parse($data['tanggal'])
                ->startOfWeek(\Carbon\Carbon::MONDAY)
                ->toDateString()
        ])->with('success', 'Jadwal diupdate.');
    }

    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Remember the week before deleting so we can redirect back to it
        $week = Carbon::parse($jadwal->tanggal)
            ->startOfWeek(Carbon::MONDAY)
            ->toDateString();

        $jadwal->delete();

        return redirect()->route('teacher.jadwal.index', compact('week'))
            ->with('success', 'Jadwal dihapus.');
    }
}