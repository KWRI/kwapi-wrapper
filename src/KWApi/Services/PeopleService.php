<?php

namespace KWApi\Services;

class PeopleService extends AbstractService
{
    /**
     * lookup information about specific person by email
     *
     * @param string $email  email address of person
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function lookupEmail($email)
    {
        return $this->get('people/social/lookupEmail', compact('email'));
    }

    /**
     * lookup information about specific person by phone
     *
     * @param string $phone  phone number of person
     * @param string $countryCode  country code number
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function lookupPhone($phone, $countryCode='')
    {
        return $this->get('people/social/lookupPhone', compact('phone','countryCode'));
    }
}