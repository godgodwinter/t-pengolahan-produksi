<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produkrugilaba extends Model
{
        public $table = "produkrugilaba";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl',
            'produk_id',
            'jml_terjual',
            // 'jml_produk_diolah_perbulan',
            // 'jml_produk_terjual_perbulan',
            // 'jml_rugilaba',
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
