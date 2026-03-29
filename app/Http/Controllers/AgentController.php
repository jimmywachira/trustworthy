<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Contracts\View\View;

class AgentController extends Controller
{
    /**
     * Show an agent public profile.
     */
    public function show(Agent $agent): View
    {
        return view('pages.agents.show', [
            'agent' => $agent,
            'properties' => $agent->properties()
                ->where('status', 'available')
                ->latest()
                ->paginate(9),
        ]);
    }
}
