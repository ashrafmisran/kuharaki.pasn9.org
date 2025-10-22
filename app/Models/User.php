<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function perniagaan()
    {
        return $this->hasMany(Perniagaan::class, 'pemilik');
    }

    /**
     * Filament multi-tenancy: return tenants accessible by this user for the given panel.
     *
     * @return \Illuminate\Support\Collection<int, \App\Models\Perniagaan>
     */
    public function getTenants(Panel $panel): Collection
    {
        // Adjust if you have roles/permissions that change scope
        $tenants = $this->perniagaan()->get();
        if (config('app.debug')) {
            \Log::info('Filament getTenants', [
                'user_id' => $this->getKey(),
                'tenant_ids' => $tenants->pluck('id')->all(),
            ]);
        }
        return $tenants;
    }

    /**
     * Filament multi-tenancy: human-readable tenant name for the UI.
     */
    public function getTenantName(Model $tenant): string
    {
        return $tenant->nama ?? (string) $tenant->getKey();
    }

    /**
     * Filament multi-tenancy: authorization check for accessing a tenant.
     */
    public function canAccessTenant(Model $tenant): bool
    {
        $can = $this->perniagaan()->whereKey($tenant->getKey())->exists();
        if (config('app.debug')) {
            \Log::info('Filament canAccessTenant', [
                'user_id' => $this->getKey(),
                'tenant_id' => $tenant->getKey(),
                'can' => $can,
            ]);
        }
        return $can;
    }
}
