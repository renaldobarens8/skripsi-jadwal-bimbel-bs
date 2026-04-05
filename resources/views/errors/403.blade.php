@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 100px;">
    <h1 style="font-size: 3rem; color: #dc3545;">🚫 403 Forbidden</h1>
    <p style="font-size: 1.2rem;">You do not have permission to access this page.</p>

    <button onclick="window.history.back()" class="btn btn-secondary mt-3">
        🔙 Go Back
    </button>
</div>
@endsection
