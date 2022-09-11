<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribtionMessage;

class Subscribtion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'sku_id',
    ];

    public static function sendEmailBySubscribtion(Sku $sku)
    {
        $subscribtions = self::where('status', '=', 0)->where('sku_id', '=', $sku->id)->get();
        foreach ($subscribtions as $subscribtion) {
            Mail::to($subscribtion->email)->send(new SubscribtionMessage($sku));
            $subscribtion->status = 1;
            $subscribtion->save();
        }
    }
}
