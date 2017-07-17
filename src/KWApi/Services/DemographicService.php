<?php

namespace KWApi\Services;

class DemographicService extends AbstractService
{
    /**
     * get  demographics information for lookup data
     *
     * @param string $email  email address of person
     * @param array $data, search demographics data
     *      d_first         A first name
     *      d_last          A last name
     *      d_zip           A 5 digit zip code
     *      d_fulladdr      Entire house number + street + suite
     *      d_city          A city in the USA
     *      d_state         Two letter state abbreviation
     *      d_phone         Ten digits NPANXXNNNN
     *      d_email         Valid email address
     *      d_lat,d_long    latitude / longitude
     *      d_ip            IP Address
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function getDemographics(array $data)
    {
        return $this->get('demographics/get_demographics', $data);
    }
}
