<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'descrption',
        ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($department) {
             if ($department->employees()->count() > 0)
            {
                return response()->json([
                    'success' => false,
                    'Message' => 'Cannot Delete Department Which Has Employee Assigned To it'
                ]);
            }
        });
    }
}


