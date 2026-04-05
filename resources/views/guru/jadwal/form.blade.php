<div class="form-group">
    <label>Tanggal</label>
    <input type="date"
           name="tanggal"
           class="form-control"
           value="{{ old('tanggal', isset($jadwal) ? $jadwal->tanggal?->format('Y-m-d') : ($tanggal ?? '')) }}"
           required>
</div>

<div class="form-group">
    <label>Hari</label>
    <select name="hari" class="form-control" required>
        @foreach([1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu'] as $val => $label)
            <option value="{{ $val }}"
                {{ old('hari', isset($jadwal) ? $jadwal->hari : ($hari ?? '')) == $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Jam</label>
    <select name="jam" class="form-control" required>
        @foreach([1=>'10:00 - 12:00', 2=>'13:00 - 15:00', 3=>'15:30 - 17:30'] as $val => $label)
            <option value="{{ $val }}"
                {{ old('jam', isset($jadwal) ? $jadwal->jam : ($jam ?? '')) == $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Mata Pelajaran</label>
    <input type="text"
           name="pelajaran"
           class="form-control"
           value="{{ old('pelajaran', $jadwal->pelajaran ?? '') }}"
           required>
</div>

<div class="form-group">
    <label>Guru</label>
    <input type="text"
           name="guru"
           class="form-control"
           value="{{ auth()->user()->name }}"
           readonly
           style="background-color: #e9ecef; cursor: not-allowed;">
</div>

<div class="form-group">
    <label>Notes</label>
    <input type="text"
           name="notes"
           class="form-control"
           value="{{ old('notes', $jadwal->notes ?? '') }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $formMode === 'edit' ? 'Update' : 'Simpan' }}
    </button>
</div>

<script>
    const weekStart = "{{ \Carbon\Carbon::parse($tanggal ?? ($jadwal->tanggal ?? now()))->startOfWeek(\Carbon\Carbon::MONDAY)->format('Y-m-d') }}";

    const tanggalInput = document.querySelector('input[name="tanggal"]');
    const hariSelect   = document.querySelector('select[name="hari"]');

    // When date changes → update hari dropdown
    tanggalInput.addEventListener('change', function () {
        const date = new Date(this.value);
        // getDay(): 0=Sun,1=Mon,...,6=Sat — we want 1=Mon to 6=Sat
        let day = date.getDay(); // 0–6
        if (day === 0) day = 7;  // treat Sunday as 7 (won't happen but safe)
        hariSelect.value = day;
    });

    // When hari changes → update date to match that day in the same week
    hariSelect.addEventListener('change', function () {
        const monday = new Date(weekStart);
        // hari value: 1=Mon, 2=Tue, ... 6=Sat
        const offset = parseInt(this.value) - 1;
        monday.setDate(monday.getDate() + offset);
        const yyyy = monday.getFullYear();
        const mm   = String(monday.getMonth() + 1).padStart(2, '0');
        const dd   = String(monday.getDate()).padStart(2, '0');
        tanggalInput.value = `${yyyy}-${mm}-${dd}`;
    });
</script>