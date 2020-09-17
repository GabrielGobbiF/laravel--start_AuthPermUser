<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $colluns = $request->all();
        $colluns['url'] = Str::kebab($request->name);

        $this->repository->create($colluns);

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
            return redirect()->back();
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
    public function update(Request $request, $url)
    {
        $colluns = $request->all();

        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
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
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            echo 'oi';
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
