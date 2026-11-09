<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'invoice_number',
        'verification_hash',
        'pic_name',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'npwp',
        'notes',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'pph23_rate',
        'pph23_amount',
        'grand_total',
        'payment_method',
        'po_number',
        'po_document_path',
        'status',
        'ip_address',
        'user_agent',
        'expires_at',
        'po_submitted_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'pph23_rate' => 'decimal:2',
        'pph23_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'expires_at' => 'datetime',
        'po_submitted_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->subtotal, 0, ',', '.');
    }

    public function getFormattedTaxAmountAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->tax_amount, 0, ',', '.');
    }

    public function getFormattedGrandTotalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->grand_total, 0, ',', '.');
    }
}

