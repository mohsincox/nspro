<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use App\Models\Crm;
use Illuminate\Support\Facades\Input;

class CcidController extends Controller
{
   	public function agentForm()
    {
    	$agentList = Crm::orderBy('agent', 'asc')->pluck('agent', 'agent');

    	return view('ccid.agent_form', compact('agentList'));
    }

    public function agentWiseShow(Request $request)
    {
    	$agent = $request->agent;
    	// $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('agent', $request->agent)->where('sales_force', 'Yes')->where('ccid', null)->orderBy('id', 'desc')->paginate(10);
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('agent', $request->agent)->where('sales_force', 'Yes')->where('ccid', null)->orderBy('id', 'desc')->get();

    	// return view('ccid.agent_wise_show',[
     //        'crms' => $crms->appends(Input::except('page'))
     //    ], compact('crms', 'agent'));

    	return view('ccid.agent_wise_show', compact('crms', 'agent'));
    }

    public function edit($id)
    {
        $crm = Crm::find($id);

        return view('ccid.edit', compact('crm'));
    }
    
    public function update(Request $request, $id)
    {
        $crm = Crm::find($id);
        
        $crm->ccid = $request->ccid;
        $crm->save();
        flash()->success($crm->ccid.' CCID updated successfully');
        return redirect('ccid-agent-wise-show?agent='.$crm->agent);
    }
}
