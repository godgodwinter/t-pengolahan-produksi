<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bahan extends Model
{
        public $table = "bahan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
        ];

}
