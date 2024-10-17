<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->role === 'admin'; // Example condition
    }
    public function view(User $user, Item $item)
    {
        return $user->id === $item->user_id || $user->role === 'admin'; // Users can view their own items or if they're admins
    }
    public function create(User $user)
    {
        return $user->role === 'admin'; // Only admins can create items
    }
    public function update(User $user, Item $item)
    {
        return $user->id === $item->user_id || $user->role === 'admin'; // Users can update their own items or if they're admins
    }
    public function delete(User $user, Item $item)
    {
        return $user->id === $item->user_id || $user->role === 'admin'; // Users can delete their own items or if they're admins
    }
}
