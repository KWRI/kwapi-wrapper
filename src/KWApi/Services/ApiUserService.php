<?php

namespace KWApi\Services;

class ApiUserService extends AbstractService
{
    
    /**
     * Show list of ApiUsers on system. Using pagination with size of 10 items every page.
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function browse($page = null)
    {
        $query = [];
        
        if ($page != null) {
            $query['page'] = $page;
        }

        return $this->get('api_users', $query);
    }

    /**
     * For creating new ApiUser, every new created ApiUser has isActive value 1 by default. ApiKey inputed must be unique.
     *
     * @param string $apiKey
     * @param string $email
     * @param string $company
     * @param string $application
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function create($apiKey, $email, $company, $application)
    {
        return $this->post('api_users', compact('apiKey', 'email', 'company', 'application'));
    }


    /**
     * Show detail of ApiUser data
     *
     * @param int $id
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function read($id)
    {
        return $this->get('api_users/' . $id);
    }


    /**
     * Updating ApiUser data
     *
     * @param int $id
     * @param string $apiKey
     * @param string $company
     * @param string $application
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function update($id, $apiKey, $email, $company, $application)
    {
        $params = compact('apiKey', 'email', 'company', 'application');

        return $this->send('PUT', 'api_users/' . $id, ['json' => $params]);
    }

    /**
     * Set active status of ApiUser inverse from it current value.
     * If isActive 0 then it will be set to 1, vice versa.
     *
     * @param int $id
     *
     * @return \KWApi\Models\Response  Return response object
     */
    public function toggle($id)
    {
        return $this->get('api_users/' . $id . '/toggle');
    }


    /**
     * Deleting ApiUser from database.
     *
     * @param int $id
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function delete($id)
    {
        return $this->send('DELETE', 'api_users/' . $id);
    }
}