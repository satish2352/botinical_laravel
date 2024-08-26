<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneCoOrdinate extends Model
{
    use HasFactory;
    protected $table = 'tbl_zone_coordinate';
    protected $primaryKey = 'id';
}
