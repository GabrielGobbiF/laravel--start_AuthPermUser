<?php

namespace App\Modules\Painel\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Painel\Plans\Models\Plan;
use App\Modules\Painel\Plans\Models\PlanDetail;
use App\Modules\Painel\Plans\Requests\StoreUpdatePlanDetail;
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

    public function store(StoreUpdatePlanDetail $request, $urlPlan)
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
            return redirect()->back();
        }

        return view('painel.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlanDetail $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('plans.details.index', $plan->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url, $idDetail)
    {
        $detail = $this->repository->where('id', $idDetail)->first();

        if (!$detail) {
            redirect()->route('plans.details.index', $url);
        }

        $detail->delete();

        return redirect()
                        ->route('plans.details.index', $url)
                        ->with('message', 'Deletado com sucesso!');

    }
}
