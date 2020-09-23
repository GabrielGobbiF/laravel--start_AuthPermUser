<?php

namespace App\Modules\Painel\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Painel\Plans\Requests\StoreUpdatePlan;
use App\Modules\Painel\Plans\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->middleware('auth');

        $this->repository = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('painel.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->route('plans.index');
        }

        return view('painel.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlan $request, $url)
    {
        $colluns = $request->all();

        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->route('plans.index');
        }

        $plan->update($colluns);

        return view('painel.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $plan = $this->repository
            ->with('details')
            ->where('url', $url)
            ->first();

        if (!$plan) {
            return redirect()->route('plans.index');
        }

        if ($plan->details->count() > 0) {
            return redirect()
                            ->back()
                            ->with('error', 'Existem detalhes vinculados a esse plano');
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {

        if (!$request->filter) {
            return redirect()->route('plans.index');
        }

        $filters = $request->except('token');

        $plans = $this->repository->search($request->filter);

        return view('painel.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
