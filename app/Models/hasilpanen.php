<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hasilpanen extends Model
{
        public $table = "hasilpanen";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'bahan_id',
            'tgl_pelaporan',
            'petani_id',
            'waktu_panen',
            'jml',
            'kualitas',
        ];

        public function petani()
        {
            return $this->belongsTo('App\Models\User','petani_id','id');
        }
        public function bahan()
        {
            return $this->belongsTo('App\Models\bahan');
        }
}
