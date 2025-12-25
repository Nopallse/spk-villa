<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price_min',
        'price_max',
        'address',
        'area',
        'bedrooms',
        'bathrooms',
        'garage',
        'swimming_pool',
        'garden',
        'location_score',
        'facilities_score',
        'accessibility_score',
        'security_score',
        'environment_score',
        'description',
        'image',
        'is_active'
    ];

    protected $casts = [
        'price_min' => 'integer',
        'price_max' => 'integer',
        'area' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'garage' => 'integer',
        'swimming_pool' => 'boolean',
        'garden' => 'boolean',
        'is_active' => 'boolean',
        'location_score' => 'decimal:2',
        'facilities_score' => 'decimal:2',
        'accessibility_score' => 'decimal:2',
        'security_score' => 'decimal:2',
        'environment_score' => 'decimal:2'
    ];

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_active', true);
    }

    public function getPriceRangeAttribute()
    {
        if ($this->price_min && $this->price_max) {
            return 'Rp ' . number_format($this->price_min) . ' - Rp ' . number_format($this->price_max);
        }
        return 'Contact for price';
    }
}