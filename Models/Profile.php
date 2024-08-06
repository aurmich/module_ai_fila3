<?php

declare(strict_types=1);

namespace Modules\Gdpr\Models;

<<<<<<< HEAD
use Modules\User\Models\BaseProfile as UserBaseProfile;

/**
 * @property int                                                                                                           $id
 * @property string|null                                                                                                   $type
 * @property string|null                                                                                                   $first_name
 * @property string|null                                                                                                   $last_name
 * @property string|null                                                                                                   $full_name
 * @property string|null                                                                                                   $email
 * @property \Illuminate\Support\Carbon|null                                                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                                                               $updated_at
 * @property string|null                                                                                                   $user_id
 * @property string|null                                                                                                   $updated_by
 * @property string|null                                                                                                   $created_by
 * @property \Illuminate\Support\Carbon|null                                                                               $deleted_at
 * @property string|null                                                                                                   $deleted_by
 * @property bool                                                                                                          $is_active
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes                                                             $extra
 * @property string                                                                                                        $avatar
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $deviceUsers
 * @property int|null                                                                                                      $device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device>                                    $devices
 * @property int|null                                                                                                      $devices_count
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media>    $media
 * @property int|null                                                                                                      $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $mobileDeviceUsers
 * @property int|null                                                                                                      $mobile_device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device>                                    $mobileDevices
 * @property int|null                                                                                                      $mobile_devices_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null                                                                                                      $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission>                                $permissions
 * @property int|null                                                                                                      $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role>                                      $roles
 * @property int|null                                                                                                      $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Team>                                      $teams
 * @property int|null                                                                                                      $teams_count
 * @property \Modules\User\Models\User|null                                                                                $user
 * @property string|null                                                                                                   $user_name
 *
 * @method static \Modules\Gdpr\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   newQuery()
 * @method static Builder|BaseProfile                             permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   query()
 * @method static Builder|BaseProfile                             role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUserId($value)
 * @method static Builder|BaseProfile                             withExtraAttributes()
 * @method static Builder|BaseProfile                             withoutPermission($permissions)
 * @method static Builder|BaseProfile                             withoutRole($roles, $guard = null)
 *
 * @mixin \Eloquent
 */
class Profile extends UserBaseProfile
=======
// use Modules\User\Models\BaseProfile;

/**
 * @property int $id
 * @property string|null $type
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $full_name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $user_id
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @property int $is_active
 *
 * @method static \Modules\Gdpr\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel
>>>>>>> fb20669 (feat(Models): add new models Consent, Event, Profile, and Treatment to the GDPR module for managing consent, events, profiles, and treatments. Add necessary attributes, relationships, and encryption for sensitive data.)
{
    /** @var string */
    protected $connection = 'gdpr';
}
