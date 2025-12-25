<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criteria';

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'weight',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function comparisonsAsA()
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_a_id');
    }

    public function comparisonsAsB()
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_b_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}