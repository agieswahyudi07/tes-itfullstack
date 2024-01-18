<?php

namespace App\Models;

use App\Models\LembagaModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaModel extends Model
{
    use HasFactory;


    protected $table = 'siswa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nis',
        'nama_siswa',
        'email',
        'foto_path',
        'lembaga_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function lembaga()
    {
        return $this->belongsTo(LembagaModel::class, 'lembaga_id');
    }
}
