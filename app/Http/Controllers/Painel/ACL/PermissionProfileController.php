<?php

namespace App\Http\Controllers\Painel\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Permission $permission, Profile $profile)
    {
        $this->middleware('auth');

        $this->permission = $permission;
        $this->profile = $profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions($profile_id)
    {
        $profile = $this->profile->find($profile_id);

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $permissions = $profile->permissions()->paginate();

        return view('painel.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }

    /**
     * add new Permission to Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function availablePermissionProfile($profile_id)
    {
        $profile = $this->profile->find($profile_id);

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $permissions = $profile->availablePermissionProfile();

        return view('painel.pages.profiles.permissions.available', compact('permissions', 'profile'));
    }

    /**
     * attach Permissions to Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function attachPermissionsProfile(Request $request, $profile_id)
    {
        $profile = $this->profile->find($profile_id);

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()
                ->back()
                ->with('message', 'Selecione ao menos uma(1) permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profile.permissions', $profile_id);
    }

    /**
     * detach Permissions to Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function detachPermissionsProfile($profile_id, $permission_id)
    {
        $profile = $this->profile->find($profile_id);
        $permission = $this->permission->find($permission_id);

        if (!$profile || !$permission) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $profile->permissions()->detach($permission);

        return redirect()->back();
    }

    public function profiles($permission_id)
    {
        $permission = $this->permission->find($permission_id);

        if (!$permission) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $profiles = $permission->profiles()->paginate();

        return view('painel.pages.permissions.profiles.index', compact('permission', 'profiles'));
    }
}
