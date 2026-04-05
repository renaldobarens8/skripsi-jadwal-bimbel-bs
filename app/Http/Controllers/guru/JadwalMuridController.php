<?php

namespace App\Http\Controllers\guru;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalMuridController extends Controller
{
    private function buildViewData(Request $request, $userId = null)
    {
        $weekStart = $request->query('week')
            ? Carbon::parse($request->query('week'))->startOfWeek(Carbon::MONDAY)
            : Carbon::now()->startOfWeek(Carbon::MONDAY);

        $weekEnd  = $weekStart->copy()->addDays(5);
        $prevWeek = $weekStart->copy()->subWeek()->toDateString();
        $nextWeek = $weekStart->copy()->addWeek()->toDateString();

        $query = Jadwal::whereBetween('tanggal', [
            $weekStart->toDateString(),
            $weekEnd->toDateString(),
        ]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $jadwals = $query->get();

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

        return compact(
            'scheduleGrid', 'hariList', 'jamList',
            'weekStart', 'weekEnd', 'prevWeek', 'nextWeek'
        );
    }

    public function index(Request $request)
    {
        $teachers = User::where('role', 'teacher')->get();
        $data = $this->buildViewData($request);

        return view('jadwalmurid', array_merge($data, compact('teachers')));
    }

    public function show(Request $request, $id)
    {
        $teachers = User::where('role', 'teacher')->get();
        $showname = User::findOrFail($id);
        $data     = $this->buildViewData($request, $id);

        return view('jadwalmurid', array_merge($data, compact('teachers', 'showname')));
    }

    // Students cannot create/edit/delete — these are not used
    public function create() { abort(403); }
    public function store(Request $request) { abort(403); }
    public function edit($id) { abort(403); }
    public function update(Request $request, $id) { abort(403); }
    public function destroy($id) { abort(403); }
}