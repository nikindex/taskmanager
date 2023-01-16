<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'describe',
        'startTask',
        'endTask',
        'path_file',
        'userId'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
