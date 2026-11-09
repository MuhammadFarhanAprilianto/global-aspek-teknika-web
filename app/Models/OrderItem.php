<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'sku',
        'product_name',
        'selected_specifications',
        'unit_price',
        'quantity',
        'line_total',
    ];

    protected $casts = [
        'selected_specifications' => 'array',
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
        'line_total' => 'decimal:2',
    ];

    /**
     * Ambil daftar spesifikasi final yang dipilih pembeli (fallback ke spesifikasi default produk untuk order lama).
     *
     * @return array<string, string>
     */
    public function resolvedSpecifications(): array
    {
        if (! empty($this->selected_specifications) && is_array($this->selected_specifications)) {
            $clean = [];
            foreach ($this->selected_specifications as $key => $val) {
                $clean[(string) $key] = is_array($val) ? implode(', ', $val) : (string) $val;
            }

            return $clean;
        }

        $fallback = $this->product?->specifications;
        if (! empty($fallback) && is_array($fallback)) {
            $clean = [];
            foreach ($fallback as $key => $val) {
                $clean[(string) $key] = is_array($val) ? (string) ($val[0] ?? '') : (string) $val;
            }

            return $clean;
        }

        return [];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedUnitPriceAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->unit_price, 0, ',', '.');
    }

    public function getFormattedLineTotalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->line_total, 0, ',', '.');
    }
}

