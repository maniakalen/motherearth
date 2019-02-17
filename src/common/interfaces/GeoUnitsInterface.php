<?php

namespace common\interfaces;

/**
 * This is the model class for table "geo_unit_types".
 *
 * @property int $id
 * @property string $name
 */
interface GeoUnitsInterface
{
    const TYPE_STREET = 'street';
    const TYPE_COUNTY = 'county';
    const TYPE_CITY = 'city';
    const TYPE_DISTRICT = 'district';
    const TYPE_HOUSE_NUMBER = 'houseNumber';
}
