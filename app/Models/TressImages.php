<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TressImages extends Model
{
    use HasFactory;
    protected $table = 'tbl_tress_images';
    protected $primaryKey = 'id';
}
