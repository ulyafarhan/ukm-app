<?php
namespace App\Policies;
use App\Models\Sale;
use App\Models\User;
class SalePolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function update(User $user, Sale $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function delete(User $user, Sale $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
}