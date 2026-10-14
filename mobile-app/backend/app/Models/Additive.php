<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Additive extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_number',
        'name',
        'description',
        'risk_level',
        'common_uses',
    ];

    /**
     * The products that contain this additive.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_additive', 'additive_id', 'product_id')->withTimestamps();
    }

    /**
     * Get the risk level with color.
     */
    public function getFormattedRiskLevelAttribute(): string
    {
        $colors = [
            'low' => 'green',
            'moderate' => 'orange',
            'high' => 'red',
        ];
        $riskLevel = strtolower($this->risk_level);
        $color = $colors[$riskLevel] ?? 'gray';
        return '<span style="color: ' . $color . '; font-weight: bold;">' 
             . ucfirst($this->risk_level) . '</span>';
    }

    /**
     * Scope a query to filter by risk level.
     */
    public function scopeWithRiskLevel($query, $level)
    {
        return $query->where('risk_level', strtolower($level));
    }

    /**
     * Get the E-Number with the 'E' prefix.
     */
    public function getFullENumberAttribute(): string
    {
        return 'E' . $this->e_number;
    }
}
