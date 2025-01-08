<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $table = 'fields';
    protected $fillable = [
        'form_id',
        'label',
        'key',
        'options',
        'placeholder',
        'required',
        'sequence',
    ];



    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function fieldTypes()
    {
        return $this->hasOne(FieldTypes::class, 'id', 'field_type_id',);
    }
}
