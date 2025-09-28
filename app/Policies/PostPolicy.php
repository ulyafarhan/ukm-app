<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_post');
    }

    public function view(User $user, Post $post): bool
    {
        return $user->can('view_post');
    }

    public function create(User $user): bool
    {
        return $user->can('create_post');
    }

    public function update(User $user, Post $post): bool
    {
        return $user->can('update_post');
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->can('delete_post');
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->can('restore_post');
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->can('force_delete_post');
    }
}