<?php

namespace KWApi\Services;

class GoalService extends AbstractService
{
    /**
     * get the goal based on the given id
     *
     * @param int $id KW UID that will be sent 
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function getGoal($id)
    {
        return $this->get("goal/{$id}");
    }
}
