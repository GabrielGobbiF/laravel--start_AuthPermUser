<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get Permissions
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Permissions not Linked witch this profile
     *
     * @return \Illuminate\Http\Response
     */
    public function availablePermissionProfile()
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })->paginate();

        return $permissions;
    }

    /**
     * Get Plans
     *
     * @return \Illuminate\Http\Response
     */
    public function plans()
    {
        $this->belongsToMany(Plan::class);
    }
}
