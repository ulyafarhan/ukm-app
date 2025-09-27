<?php
namespace App\Policies;
use App\Models\Document;
use App\Models\User;
class DocumentPolicy
{
    public function viewAny(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function create(User $user): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function update(User $user, Document $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
    public function delete(User $user, Document $model): bool { return $user->hasRole(['Super Admin', 'Sekretaris']); }
}