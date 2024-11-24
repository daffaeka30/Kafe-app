<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $table = 'customer_orders';

    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'status', // pending, confirmed, completed, cancelled
        'total_price',
        'notes',
        'payment_status', // unpaid, paid
        'payment_method', // cash, transfer, ewallet
        'payment_amount',
        'order_number',
        'order_type', // dine_in, takeaway
        'subtotal',
        'tax_amount',
        'discount_amount',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'payment_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->order_number = static::generateOrderNumber();
        });
    }

    public static function generateOrderNumber()
    {
        $prefix = date('Ymd');
        $lastOrder = static::whereDate('created_at', today())
            ->latest()
            ->first();

        $lastNumber = $lastOrder ? intval(substr($lastOrder->order_number, -4)) : 0;
        $newNumber = $lastNumber + 1;

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Status badge untuk tampilan
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'completed' => 'success',
            'confirmed' => 'info',
            'cancelled' => 'danger',
            default => 'warning'
        };
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return $this->payment_status === 'paid' ? 'success' : 'warning';
    }

    // Helper methods untuk cek status
    public function canBeConfirmed()
    {
        return $this->status === 'pending';
    }

    public function canBeProcessed()
    {
        return $this->status === 'confirmed' && $this->payment_status === 'unpaid';
    }

    public function canBeCompleted()
    {
        return $this->status === 'confirmed' && $this->payment_status === 'paid';
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) && $this->payment_status === 'unpaid';
    }
}
