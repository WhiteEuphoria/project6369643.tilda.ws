<?php
namespace App\Models;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'verification_status', 'main_balance',
    ];
    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }
    /**
     * Determine if the user can access the given panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->is_admin;
        }
        if ($panel->getId() === 'client') {
            return !$this->is_admin;
        }
        return false;
    }
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
    public function transitAccounts(): HasMany
    {
        return $this->hasMany(Account::class)->where('type', 'Транзитный');
    }
    public function fraudClaims(): HasMany
    {
        return $this->hasMany(FraudClaim::class);
    }
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
