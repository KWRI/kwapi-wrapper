<?php

namespace KWApi\Services;

class GoalService extends AbstractService
{
    /**
     * get the goal based on the given goal id
     *
     * @param int $goal_id KW UID that will be sent
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function getGoal($goal_id)
    {
        return $this->get("goals/{$goal_id}");
    }
}
