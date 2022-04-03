<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserInfo|null $userInfo
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserInfo
 *
 * @mixin IdeHelperUserInfo
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string|null $mobile_number
 * @property string|null $sex
 * @property \Illuminate\Support\Carbon|null $birthday
 * @property string|null $home_address
 * @property string|null $barangay
 * @property string|null $city
 * @property string|null $region
 * @property string|null $profile_picture_url
 * @property mixed|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereBarangay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereHomeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereProfilePictureUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereUserId($value)
 */
	class UserInfo extends \Eloquent {}
}

