<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthProvider extends Model
{
    protected $guarded = ['id'];
    protected $hidden = [
        'token', 'refresh_token'
    ];

   public function user()
   {
        $this->belongsTo(OAuthProvider::class);
   }
}
