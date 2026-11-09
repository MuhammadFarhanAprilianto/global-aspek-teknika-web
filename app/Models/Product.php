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
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }

            $cleanedImage = ltrim($this->image, '/');

            // Cek di seluruh kemungkinan path penyimpanan:
            // 1. base_path('storage/app/public/...') (Path direktori asli di serverless Vercel & repo)
            // 2. public_path('storage/...') (Path symlink lokal Laravel)
            // 3. storage_path('app/public/...') (Path storage dinamis Laravel)
            if (
                file_exists(base_path('storage/app/public/' . $cleanedImage)) ||
                file_exists(public_path('storage/' . $cleanedImage)) ||
                file_exists(storage_path('app/public/' . $cleanedImage))
            ) {
                return asset('storage/' . str_replace(' ', '%20', $cleanedImage));
            }
        }

        return asset('storage/Logo_Perusahaan(1).png');
    }
}

