@extends('layouts.app2')

@section('content')
<style>
    .sched-wrap { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    .week-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    .week-nav a.arrow-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; height: 36px;
        border-radius: 50%;
        background: #4CAF50;
        color: white;
        font-size: 20px;
        text-decoration: none;
    }
    .week-nav a.arrow-btn:hover { background: #388e3c; }
    .week-nav .week-label {
        font-size: 15px; font-weight: 600; color: #333;
        min-width: 260px; text-align: center;
    }
    .week-nav a.today-btn {
        padding: 5px 14px;
        border-radius: 20px;
        background: #e8f5e9; color: #2e7d32;
        font-size: 13px; font-weight: 600;
        text-decoration: none;
        border: 1px solid #a5d6a7;
    }
    .week-nav a.today-btn:hover { background: #c8e6c9; }

    table { width: 100%; border-collapse: collapse; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    th, td { padding: 10px 12px; border-bottom: 1px solid #ddd; vertical-align: top; }
    th { background-color: #4CAF50; color: white; text-align: center; }
    th.today-col { background-color: #2e7d32; }
    td.today-col { background-color: #f1f8e9; }
    th .day-name { font-size: 14px; font-weight: 700; }
    th .day-date { font-size: 12px; font-weight: 400; opacity: 0.9; }
    td:first-child { font-weight: 600; color: #4CAF50; text-align: center; white-space: nowrap; background: #f9f9f9; }
    tbody tr:nth-child(even) td:first-child { background: #f0f0f0; }
    .cell-subject { font-weight: 600; font-size: 14px; }
    .cell-teacher { font-size: 13px; color: #555; }
    .cell-notes   { font-size: 12px; color: #888; font-style: italic; }
    .cell-actions { margin-top: 6px; display: flex; gap: 4px; flex-wrap: wrap; }
    .empty-dash   { color: #ccc; text-align: center; font-size: 13px; }
</style>

<div class="sched-wrap">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="week-nav">
        <a class="arrow-btn" href="{{ route('teacher.jadwal.index', ['week' => $prevWeek]) }}">&larr;</a>

        <span class="week-label">
            {{ \Carbon\Carbon::parse($weekStart)->locale('id')->isoFormat('D MMM') }}
            &ndash;
            {{ \Carbon\Carbon::parse($weekEnd)->locale('id')->isoFormat('D MMM YYYY') }}
        </span>

        <a class="arrow-btn" href="{{ route('teacher.jadwal.index', ['week' => $nextWeek]) }}">&rarr;</a>

        @php $thisMonday = \Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString(); @endphp
        @if(\Carbon\Carbon::parse($weekStart)->toDateString() !== $thisMonday)
            <a class="today-btn" href="{{ route('teacher.jadwal.index') }}">Minggu Ini</a>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Jam</th>
                @foreach ($hariList as $hariKey => $hariNama)
                    @php
                        $colDate = \Carbon\Carbon::parse($weekStart)->addDays($hariKey - 1);
                        $isToday = $colDate->isToday();
                    @endphp
                    <th class="{{ $isToday ? 'today-col' : '' }}">
                        <div class="day-name">{{ $hariNama }}</div>
                        <div class="day-date">{{ $colDate->format('d/m') }}{{ $isToday ? ' ●' : '' }}</div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($jamList as $jamKey => $jamLabel)
                <tr>
                    <td>{{ $jamLabel }}</td>
                    @for ($hariKey = 1; $hariKey <= 6; $hariKey++)
                        @php
                            $colDate = \Carbon\Carbon::parse($weekStart)->addDays($hariKey - 1);
                            $isToday = $colDate->isToday();
                        @endphp
                        <td class="{{ $isToday ? 'today-col' : '' }}">
                            @if (isset($scheduleGrid[$jamKey][$hariKey]))
                                @php $item = $scheduleGrid[$jamKey][$hariKey]; @endphp
                                <div class="cell-subject">{{ $item->pelajaran }}</div>
                                <div class="cell-teacher">{{ $item->guru }}</div>
                                @if($item->notes)
                                    <div class="cell-notes">{{ $item->notes }}</div>
                                @endif
                                <div class="cell-actions">
                                    <a href="{{ route('teacher.jadwal.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a>
                                    <form action="{{ route('teacher.jadwal.destroy', $item->id) }}"
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="empty-dash">&mdash;</div>
                                <div class="cell-actions" style="justify-content:center; margin-top:4px;">
                                    <a href="{{ route('teacher.jadwal.createWithTimeSlot', [
                                            'jam'    => $jamKey,
                                            'hari'   => $hariKey,
                                            'tanggal'=> $colDate->toDateString()
                                        ]) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus-circle"></i> Create
                                    </a>
                                </div>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection