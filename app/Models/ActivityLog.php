<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'activity', 'target_type', 'target_id', 'details', 'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($activity, $target = null, $details = null)
    {
        return self::create([
            'user_id' => auth()->id(),
            'activity' => $activity,
            'target_type' => $target ? get_class($target) : null,
            'target_id' => $target ? $target->id : null,
            'details' => is_array($details) ? json_encode($details) : $details,
            'ip_address' => request()->ip()
        ]);
    }
}
