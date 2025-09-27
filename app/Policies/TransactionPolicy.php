<?php
namespace App\Policies;
use App\Models\Transaction;
use App\Models\User;
class TransactionPolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function update(User $user, Transaction $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
    public function delete(User $user, Transaction $model): bool { return $user->hasRole(['Super Admin', 'Bendahara']); }
}