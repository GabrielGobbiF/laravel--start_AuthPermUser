<?php

namespace App\Modules\Painel\Profiles\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Painel\Profiles\Requests\StoreUpdateProfile;
use App\Modules\Painel\Profiles\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->middleware('auth');

        $this->repository = $profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->repository->paginate();

        return view('painel.pages.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \StoreUpdateProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request)
    {
        $this->repository->create($request->all());

        return redirect()
            ->route('profiles.index')
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
        $profile = $this->repository->where('id', $id)->first();

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        return view('painel.pages.profiles.show', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StoreUpdateProfile  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfile $request, $id)
    {
        $columns = $request->all();

        $profile = $this->repository->where('id', $id)->first();

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $profile->update($columns);

        return view('painel.pages.profiles.show', [
            'profile' => $profile
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
        $profile = $this->repository
            ->where('id', $id)
            ->first();

        if (!$profile) {
            return redirect()
                ->route('profiles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('message', 'Deletado com sucesso!');
    }
}
