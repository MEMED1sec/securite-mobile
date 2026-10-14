<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'barcode',
        'nutriscore_grade',
        'ingredients',
        'allergens',
        'image_url',
        'serving_size'
    ];

    protected $casts = [
        'ingredients' => 'array',
        'allergens' => 'array',
    ];

    /**
     * Get the reviews for the product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The additives that belong to the product.
     */
    public function additives(): BelongsToMany
    {
        return $this->belongsToMany(Additive::class, 'product_additive', 'product_id', 'additive_id')->withTimestamps();
    }

    /**
     * Get the formatted nutritional score with color.
     */
    public function getFormattedNutriscoreAttribute(): string
    {
        $score = strtoupper($this->nutriscore_grade);
        $colors = [
            'A' => 'green',
            'B' => 'lightgreen',
            'C' => 'yellow',
            'D' => 'orange',
            'E' => 'red',
        ];
        return '<span style="color: ' . ($colors[$score] ?? 'black') . '; font-weight: bold;">' . $score . '</span>';
    }

    /**
     * Scope a query to search products.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by nutritional score.
     */
    public function scopeWithNutriscore($query, $scores)
    {
        if (is_string($scores)) {
            $scores = explode(',', $scores);
        }
        return $query->whereIn('nutriscore_grade', $scores);
    }
}

