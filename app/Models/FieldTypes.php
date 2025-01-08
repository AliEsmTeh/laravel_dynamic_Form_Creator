<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldTypes extends Model
{
    use HasFactory;

    protected $table = 'field_types';
    protected $fillable = [
        'name',
        'description',
        'is_optional',
    ];

    public function fields()
    {
        return $this->hasMany(Fields::class, 'field_type_id', 'id');
    }
}
