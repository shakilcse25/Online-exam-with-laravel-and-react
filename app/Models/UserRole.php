<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * Get the user that owns the exam.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    protected $fillable = [
      'user_id', 'role_id'
    ];
}
