<?php

namespace App\Modules\Painel\Permissions\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Painel\Permissions\Requests\StoreUpdatePermission;
use App\Modules\Painel\Permissions\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->middleware('auth');

        $this->repository = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('painel.pages.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \StoreUpdatePermission  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if (!$permission) {
            return redirect()
                ->route('permissions.index')
                ->with('message', 'Registro não encontrado!');
        }

        return view('painel.pages.permissions.show', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StoreUpdatePermission  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermission $request, $id)
    {
        $columns = $request->all();

        $permission = $this->repository->where('id', $id)->first();

        if (!$permission) {
            return redirect()
                ->route('permissions.index')
                ->with('message', 'Registro não encontrado!');
        }

        $permission->update($columns);

        return view('painel.pages.permissions.show', [
            'permission' => $permission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository
            ->where('id', $id)
            ->first();

        if (!$permission) {
            return redirect()
                ->route('permissions.index')
                ->with('message', 'Registro não encontrado!');
        }

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Deletado com sucesso!');
    }
}
