<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitedForm extends Model
{
    protected $table = 'submitted_forms';
    protected $fillable = ['form_id', 'user_id', 'data'];
    use HasFactory;
}
