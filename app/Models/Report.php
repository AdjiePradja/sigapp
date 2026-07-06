<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'type',
        'category',
        'location',
        'description',
        'status',
        'user_id',
        'gps_lat',
        'gps_lng',
        'gps_acc',
        'gps_manual',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'gps_lat' => 'decimal:6',
            'gps_lng' => 'decimal:6',
            'gps_manual' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function nextNo(string $type): string
    {
        $prefix = $type === 'emg' ? 'DR' : 'HZ';
        $year = now()->year;
        $count = static::where('type', $type)
            ->whereYear('created_at', $year)
            ->count() + 1;

        return sprintf('%s-%d-%04d', $prefix, $year, $count);
    }
}
