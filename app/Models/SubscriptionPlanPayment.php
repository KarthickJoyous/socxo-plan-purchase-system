<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subscriptionPlan() {

        return $this->belongsTo(SubscriptionPlan::class)->withDefault();
    }

    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->attributes['unique_id'] = uniqid();
        });

        static::created(function($model) {

            $model->attributes['unique_id'] = "SPP-".str_pad($model->attributes['id'], 5, 0, STR_PAD_LEFT)."-".$model->attributes['unique_id'];

            $model->save();
        });
    }
}
