<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\TenantPivot;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'nome',
        'data'
    ];

    protected $table = "tenants";

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tenant', 'tenant_id', 'global_user_id', 'id', 'global_id')
            ->using(TenantPivot::class)->withPivot('gerente');
    }


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'nome',
        ];
    }
}
