<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaModel extends Model
{
    use HasFactory;

    protected $table = 'lembaga';
    protected $primaryKey = 'lembaga_id';

    public function siswa()
    {
        return $this->belongsTo(siswaModel::class, 'id');
    }
}
