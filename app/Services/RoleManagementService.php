<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleManagementService
{
    public function changeRole(
        User $actor,
        User $target,
        string $newRole
    ): void {
        if ($actor->is($target) || $target->role === 'admin') {
            throw ValidationException::withMessages([
                'role' => 'Role akun sendiri atau akun admin tidak dapat diubah.',
            ]);
        }

        // Jika role sama, tidak perlu menyimpan perubahan.
        if ($target->role === $newRole) {
            return;
        }
        $target->role = $newRole;
        $target->save();
    }
}
