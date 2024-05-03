<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAmenities extends Model
{
    use HasFactory;
    protected $table = 'tbl_amenities_category';
    protected $primaryKey = 'id';
}
