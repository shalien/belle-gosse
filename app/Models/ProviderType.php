<?php

namespace App\Models;

use App\Models\_OLD\IgnoredHost;
use App\Models\_OLD\ProviderLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function provider_links()
    {
        return $this->hasMany(ProviderLink::class);
    }

    public function providers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function ignored_hosts()
    {
        return $this->belongsToMany(IgnoredHost::class);
    }
}
