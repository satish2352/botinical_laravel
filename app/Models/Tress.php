<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tress extends Model
{
    use HasFactory;
    protected $table = 'tbl_trees';
    protected $primaryKey = 'id';
}
