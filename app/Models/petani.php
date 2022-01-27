<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class petani extends Model
{
        public $table = "petani";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'kelompoktani',
        ];

}
