<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'slug',
        'badge_primary',
        'badge_secondary',
        'short_description',
        'description',
        'price',
        'stock',
        'min_order_quantity',
        'is_rfq_only',
        'is_featured',
        'status',
        'image',
        'specifications',
        'datasheet_url',
    ];

    /**
     * Sembunyikan nominal harga internal dari serialisasi JSON/publik secara default
     * untuk mencegah price scraping & manipulasi harga di sisi klien.
     */
    protected $hidden = [
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'min_order_quantity' => 'integer',
        'is_rfq_only' => 'boolean',
        'is_featured' => 'boolean',
        'specifications' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Label harga publik (aman untuk mode Full Privasi B2B / RFQ)
     */
    public function getFormattedPriceAttribute(): string
    {
        if ($this->is_rfq_only || is_null($this->price)) {
            return 'Harga Kontrak B2B';
        }

        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    /**
     * Format nominal harga internal khusus dashboard Admin / Sales
     */
    public function getInternalPriceFormattedAttribute(): string
    {
        if (is_null($this->price)) {
            return 'Belum ditentukan';
        }

        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    /**
     * URL gambar lengkap
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . str_replace(' ', '%20', $this->image));
        }

        return asset('storage/Logo_Perusahaan(1).png');
    }
}

