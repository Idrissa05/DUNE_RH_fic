<?php

namespace App\Observers;

use App\Models\Agent;

class AgentObserver
{
    /**
     * Handle the agent "created" event.
     *
     * @param Agent $agent
     * @return void
     */
    public function created(Agent $agent)
    {
        //
    }

    /**
     * Handle the agent "updated" event.
     *
     * @param Agent $agent
     * @return void
     */
    public function updated(Agent $agent)
    {
        //
    }

    /**
     * Handle the agent "deleted" event.
     *
     * @param Agent $agent
     * @return void
     */
    public function deleted(Agent $agent)
    {
        $agent->conges()->delete();
        $agent->conjoints()->delete();
        $agent->enfants()->delete();
        $agent->affectations()->delete();
        $agent->experiences()->delete();
        $agent->formations()->delete();
        $agent->notations()->delete();
        $agent->grades()->delete();
    }

    /**
     * Handle the agent "restored" event.
     *
     * @param Agent $agent
     * @return void
     */
    public function restored(Agent $agent)
    {
        //
    }

    /**
     * Handle the agent "force deleted" event.
     *
     * @param Agent $agent
     * @return void
     */
    public function forceDeleted(Agent $agent)
    {
        //
    }
}
