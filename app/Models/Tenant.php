<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'name',
        'data'
    ];

    protected $table = "tenants";

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_tenant');
    }
}
