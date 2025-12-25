<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_a_id',
        'criteria_b_id',
        'value',
        'is_admin_set'
    ];

    protected $casts = [
        'value' => 'decimal:6',
        'is_admin_set' => 'boolean'
    ];

    public function criteriaA()
    {
        return $this->belongsTo(Criteria::class, 'criteria_a_id');
    }

    public function criteriaB()
    {
        return $this->belongsTo(Criteria::class, 'criteria_b_id');
    }

    // AHP comparison scale interpretation
    public function getInterpretationAttribute()
    {
        $value = $this->value;
        
        if ($value == 1) return 'Equal importance';
        if ($value == 3) return 'Moderate importance of A over B';
        if ($value == 5) return 'Strong importance of A over B';
        if ($value == 7) return 'Very strong importance of A over B';
        if ($value == 9) return 'Extreme importance of A over B';
        if ($value == 1/3) return 'Moderate importance of B over A';
        if ($value == 1/5) return 'Strong importance of B over A';
        if ($value == 1/7) return 'Very strong importance of B over A';
        if ($value == 1/9) return 'Extreme importance of B over A';
        
        return 'Intermediate value';
    }
}