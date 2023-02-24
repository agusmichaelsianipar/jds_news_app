<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event', 'user_id', 'url','method','ip_address','user_agent'
    ];

    public static function record($event, $user_id = null, $url,$method, $ip_address, $user_agent=null)
    {
        return static::create([
            'event' => $event,
            'user_id' => $user_id,
            'url' => $url,
            'method' => $method,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
        ]);
    }

}
