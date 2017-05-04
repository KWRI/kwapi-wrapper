<?php

namespace KWApi\Services;

class PointOfInterestService extends AbstractService
{
    /**
     * Return places
     * @param $address
     * @param $keyword
     * @param $type
     * @return \KWApi\Models\Response
     */
    public function getPlaces($address, $keyword, $type)
    {
        return $this->get("places/get_places", ['address' => $address, 'keyword' => $keyword, 'type' => $type]);
    }

    /**
     * Validate Address
     * @param $address
     * @return \KWApi\Models\Response
     */
    public function validateAddress($address)
    {
        return $this->get("places/validate", ['address' => $address]);
    }

    /**
     * Validate Address
     * @param $address
     * @return \KWApi\Models\Response
     */
    public function autocomplete($address)
    {
        return $this->get("places/autocomplete", ['address' => $address]);
    }
}
