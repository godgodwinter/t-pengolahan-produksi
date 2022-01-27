<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengolahanbahan extends Model
{
        public $table = "pengolahanbahan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl',
            'hasilpanen_id',
            'waktupengolahan',
            'jml_pengolahan',
            'hasil_pengolahan',
            'produk_id',
            'jml',
        ];

        public function produk()
        {
            return $this->belongsTo('App\Models\produk');
        }
        public function hasilpanen()
        {
            return $this->belongsTo('App\Models\hasilpanen');
        }
}
