<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository
{
    protected static int $defaultLimit = 10;

    protected static function getLimit(array $input): int
    {
        return filter_var($input['limit'] ?? self::$defaultLimit, FILTER_VALIDATE_INT) ?: self::$defaultLimit;
    }

    public static function createUser(array $input): string
    {
        User::create([
            'role_id' => $input['role'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        return 'OK';
    }

    public static function getListUsers(array $input): LengthAwarePaginator
    {
        $limit = self::getLimit($input);

        $users = User::query();
        $users->with('role');

        if (isset($input['search'])) {
            $search = sprintf('%%%s%%', $input['search']);
            $users->where(function ($q) use ($search) {
                $q->where('name', 'ilike', $search)
                    ->orWhere('email', 'ilike', $search);
            });
        }

        $users = $users->paginate($limit);

        return $users;
    }

    public static function getDetailUser(int $id): User
    {
        return User::with('role')->findOrFail($id);
    }

    public static function deleteUser(int $id): array
    {
        $user = self::getDetailUser($id);
        if ($user->id === auth('api')->id()) {
            return ["You cannot delete your own account.", false, 403];
        }
        $user->delete();
        return ["User has been successfully deleted.", true, 200];
    }
}
