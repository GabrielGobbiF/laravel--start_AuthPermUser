<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Http\Request;

class PlanDetailController extends Controller
{
    protected $repository, $plan;

    public function __construct(PlanDetail $planDetail, Plan $plan)
    {
        $this->repository = $planDetail;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->route('plans.index');
        }

        $details = $plan->details()->paginate();

        return view('painel.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->route('plans.index');
        }

        return view('painel.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }

    public function store(Request $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->route('plans.index');
        }

        $plan->details()->create($request->all());

        return redirect()->route('plans.details.index', $plan->url);
    }

    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->route('plans.index');
        }

        return view('painel.pages.plans.details.show', [
            'detail' => $detail,
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
}
