<?php
namespace App\Policies;
use App\Models\Member;
use App\Models\User;
class MemberPolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function update(User $user, Member $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function delete(User $user, Member $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
}