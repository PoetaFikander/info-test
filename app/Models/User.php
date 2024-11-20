<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'last_login_ip',
        'last_login_at',
        'is_active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(
            Department::class,
            'department_user',
        );
    }

    /**
     * @return BelongsToMany
     */
    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(
            Store::class,
            'store_user',
        );
    }

    /**
     * dane użytkownika
     * @param int $user_id
     * @return array
     */
    static function getUserData(int $user_id = 0): array
    {
        $user_id = $user_id !== 0 ? $user_id : Auth::user()->id;
        $user = User::find($user_id);
        //$tmp = $user->departments;
        //$tmp = $user->stores;
        //$tmp = $user->roles;

        $permissions = array();
        foreach ($user->roles as $role) {
            $rolePermission = Permission::join("role_has_permissions", "permission_id", "=", "id")
                ->where("role_id", $role->id)
                ->get();

            foreach ($rolePermission as $permision) {
                //$permissions[$permision->id] = $permision->name;
                $permissions[] = $permision->name;
            }
        }

        return [
            'default' => $user,
            'stores' => $user->stores,
            'departments' => $user->departments,
            'roles' => $user->roles->pluck('name')->all(),
            'permissions' => $permissions,
        ];
    }

}
