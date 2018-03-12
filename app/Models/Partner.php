<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $guarded = [];

    /*danh sách đơn hàng của đối tác */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart','PartnerBy','id');
    }
    /*Danh sách thông báo của đối tác */
    public function notification()
    {
        return $this->belongsToMany('App\Models\Notification','notifi_partner','PartnerId','NotifiId');
    }
}
