@extends('layouts.app2')

@section('content')
<style>
    .week-nav {
        display: flex; align-items: center; justify-content: center;
        gap: 12px; margin-bottom: 16px;
    }
    .week-nav a.arrow-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 36px; height: 36px; border-radius: 50%;
        background: #4CAF50; color: white; font-size: 20px; text-decoration: none;
    }
    .week-nav a.arrow-btn:hover { background: #388e3c; }
    .week-nav .week-label {
        font-size: 15px; font-weight: 600; color: #333;
        min-width: 260px; text-align: center;
    }
    .week-nav a.today-btn {
        padding: 5px 14px; border-radius: 20px;
        background: #e8f5e9; color: #2e7d32;
        font-size: 13px; font-weight: 600;
        text-decoration: none; border: 1px solid #a5d6a7;
    }
    table { width: 100%; border-collapse: collapse; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-top: 10px; }
    th, td { padding: 14px; border-bottom: 1px solid #ddd; }
    th { background-color: #4CAF50; color: white; text-align: center; }
    th.today-col { background-color: #2e7d32; }
    td.today-col { background-color: #f1f8e9; }
    th .day-name { font-size: 14px; font-weight: 700; }
    th .day-date { font-size: 12px; opacity: 0.9; }
    td:first-child { font-weight: bold; color: #4CAF50; text-align: center; }
    tbody tr:nth-child(even) { background-color: #f9f9f9; }
</style>

{{-- Teacher selector --}}
<div style="margin-bottom: 16px; text-align:center;">
    <label for="teacher_dropdown">Pilih Guru:</label>
    <select name="teacher" id="teacher_dropdown" class="form-control d-inline-block" style="width:auto;">
        <option value="">-- Pilih Guru --</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}"
                {{ isset($showname) && $showname->id == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->name }}
            </option>
        @endforeach
    </select>

    @if(isset($showname))
        <p style="margin-top:8px; font-weight:600;">Guru: {{ $showname->name }}</p>
    @endif
</div>

{{-- Week navigation --}}
<div class="week-nav">
    @php
        $weekParam = isset($showname) ? $showname->id : null;
        $baseRoute = isset($showname) ? 'student.jadwal.show' : 'student.jadwal.index';
        $routeParams = isset($showname) ? ['jadwal' => $showname->id] : [];
    @endphp

    <a class="arrow-btn"
       href="{{ route($baseRoute, array_merge($routeParams, ['week' => $prevWeek])) }}">&larr;</a>

    <span class="week-label">
        {{ \Carbon\Carbon::parse($weekStart)->locale('id')->isoFormat('D MMM') }}
        &ndash;
        {{ \Carbon\Carbon::parse($weekEnd)->locale('id')->isoFormat('D MMM YYYY') }}
    </span>

    <a class="arrow-btn"
       href="{{ route($baseRoute, array_merge($routeParams, ['week' => $nextWeek])) }}">&rarr;</a>

    @php $thisMonday = \Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString(); @endphp
    @if(\Carbon\Carbon::parse($weekStart)->toDateString() !== $thisMonday)
        <a class="today-btn" href="{{ route($baseRoute, $routeParams) }}">Minggu Ini</a>
    @endif
</div>

{{-- Schedule table --}}
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
                            <strong>{{ $item->pelajaran }}</strong><br>
                            <span style="font-size:13px;color:#555;">{{ $item->guru }}</span><br>
                            @if($item->notes)
                                <span style="font-size:12px;color:#888;font-style:italic;">{{ $item->notes }}</span>
                            @endif
                        @else
                            <span style="color:#ccc;">—</span>
                        @endif
                    </td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    const dropdown = document.getElementById('teacher_dropdown');
    dropdown.addEventListener('change', function () {
        const teacherId = this.value;
        // Preserve the current week when switching teachers
        const urlParams  = new URLSearchParams(window.location.search);
        const weekParam  = urlParams.get('week') ? '?week=' + urlParams.get('week') : '';

        if (teacherId) {
            const baseUrl = "{{ route('student.jadwal.show', ['jadwal' => ':id']) }}";
            window.location.href = baseUrl.replace(':id', teacherId) + weekParam;
        } else {
            window.location.href = "{{ route('student.jadwal.index') }}" + weekParam;
        }
    });
</script>
@endsection