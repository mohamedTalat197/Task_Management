<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'descrption',
        'employee_id',
        'manager_id',
        'status',
        ];

    public function employee()
    {
        return $this->belongsToOne(Employee::class);
    }
}
