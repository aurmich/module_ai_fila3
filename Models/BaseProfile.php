<?php

declare(strict_types=1);

namespace Modules\User\Models;

// use Illuminate\Database\Eloquent\Relations\HasOne;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\User\Models\Traits\IsProfileTrait;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

/**
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes $extra
 * @property string $avatar
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser> $deviceUsers
 * @property int|null $device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $devices
 * @property int|null $devices_count
 * @property string|null $first_name
 * @property string|null $full_name
 * @property string|null $last_name
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser> $mobileDeviceUsers
 * @property int|null $mobile_device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $mobileDevices
 * @property int|null $mobile_devices_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission> $permissions
 * @property int|null $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role> $roles
 * @property int|null $roles_count
 * @property User|null $user
 * @property string|null $user_name
 *
 * @method static \Modules\Camping\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile role($roles, $guard = null, $without = false)
 * @method static Builder|BaseProfile withExtraAttributes()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withoutRole($roles, $guard = null)
 *
 * @mixin \Eloquent
 */
abstract class BaseProfile extends BaseModel implements ProfileContract, HasMedia
{
    use HasChildren;
    use HasRoles;
    use InteractsWithMedia;
    use IsProfileTrait;
    use Notifiable;
    use SchemalessAttributesTrait;

    /**
     * Undocumented variable.
     * Property Modules\Xot\Models\Profile::$guard_name is never read, only written.
     */
    // private string $guard_name = 'web';

    /** @var array<int, string> */
    protected $fillable = [
        'id',
        'user_id',
        'type',
        'first_name',
        'last_name',
        'phone',
        'email',
        'bio',
        'is_active',
    ];

    protected $appends = [
        'full_name',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',

            'is_active' => 'boolean',
            'extra' => SchemalessAttributes::class,
        ];
    }

    /** @var array */
    protected $schemalessAttributes = [
        'extra',
    ];

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra->modelScope();
    }
}
