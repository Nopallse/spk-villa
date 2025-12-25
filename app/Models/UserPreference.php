<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'criteria_id',
        'villa_id',
        'preference_value',
        'notes'
    ];

    protected $casts = [
        'preference_value' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

    // Likert scale interpretation
    public function getLikertLabelAttribute()
    {
        $labels = [
            1 => 'Sangat Tidak Penting',
            2 => 'Tidak Penting', 
            3 => 'Cukup Penting',
            4 => 'Penting',
            5 => 'Sangat Penting'
        ];

        return $labels[$this->preference_value] ?? 'Unknown';
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCriteria($query, $criteriaId)
    {
        return $query->where('criteria_id', $criteriaId);
    }

    public function scopeByVilla($query, $villaId)
    {
        return $query->where('villa_id', $villaId);
    }
}