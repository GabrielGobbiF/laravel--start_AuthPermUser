<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
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
            return redirect()
                ->route('plans.index')
                ->with('message', 'Registro não encontrado!');
        }

        return view('painel.pages.plans.show', [
            'plan' => $plan
        ]);
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
        $columns = $request->all();

        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()
                ->route('plans.index')
                ->with('message', 'Registro não encontrado!');
        }

        $plan->update($columns);

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
            return redirect()
                ->route('plans.index')
                ->with('message', 'Registro não encontrado!');
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
