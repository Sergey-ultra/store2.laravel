<?php

namespace App\Models;

use App\Mail\SendSubsciptionMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = ['email', 'sku_id'];

    public function scopeActiveBySkuId($query, $skuId)
    {
        return $query->where('status', 0)->where('sku_id', $skuId);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public static function sendEmailsBySubscription(Sku $sku)
    {
        $subscriptions = self::activeBySkutId($sku->id)->get();
        foreach($subscriptions as $subscription){
            Mail::to($subscription->email)->send(new SendSubsciptionMessage($sku));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
