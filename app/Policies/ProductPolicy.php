<?php
namespace App\Policies;
use App\Models\Product;
use App\Models\User;
class ProductPolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function update(User $user, Product $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function delete(User $user, Product $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
}