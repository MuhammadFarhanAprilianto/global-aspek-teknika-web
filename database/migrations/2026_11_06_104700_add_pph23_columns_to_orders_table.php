<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('pph23_rate', 5, 2)->default(2.00)->after('tax_amount');
            $table->decimal('pph23_amount', 15, 2)->default(0)->after('pph23_rate');
        });

        // Sinkronkan juga order yang sudah ada agar otomatis menghitung PPh 23 (2.0%)
        $existingOrders = DB::table('orders')->get();
        foreach ($existingOrders as $order) {
            $subtotal = (float) $order->subtotal;
            $taxAmount = (float) $order->tax_amount;
            $pph23Rate = 2.00;
            $pph23Amount = round($subtotal * ($pph23Rate / 100), 2);
            $grandTotal = round($subtotal + $taxAmount - $pph23Amount, 2);
            $newHash = hash_hmac(
                'sha256',
                $order->uuid . '|' . $order->invoice_number . '|' . number_format($grandTotal, 2, '.', ''),
                (string) config('app.key')
            );

            DB::table('orders')
                ->where('id', $order->id)
                ->update([
                    'pph23_rate' => $pph23Rate,
                    'pph23_amount' => $pph23Amount,
                    'grand_total' => $grandTotal,
                    'verification_hash' => $newHash,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['pph23_rate', 'pph23_amount']);
        });
    }
};

