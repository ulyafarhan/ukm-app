<?php
namespace App\Policies;
use App\Models\Event;
use App\Models\User;
class EventPolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function update(User $user, Event $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function delete(User $user, Event $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
}