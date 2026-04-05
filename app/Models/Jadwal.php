<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pelajaran', 'hari', 'jam', 'guru', 'notes', 'user_id', 'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'hari'    => 'integer',
        'jam'     => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}