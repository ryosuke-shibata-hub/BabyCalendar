<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationTag extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $table = 'relation_tags';
}
