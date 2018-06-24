<?php

namespace App\Model;

use App\Model\BaseModel;

class Location extends BaseModel {

    protected $fillable = [
        "id",
        "address",
        "city",
        "country",
        "created",
        "labourSettings",
        "lat",
        "lng",
        "modified",
        "state",
        "timezone",
        "users",
        "time_punches_by_user"
    ];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public static function getLocations() {

        $locations = Location::getJson('/locations.json');

        foreach ($locations as $location) {
            $location_obj = new Location((array) $location);
            $ini_locations[] = $location_obj;
        }
        return $ini_locations;
    }

    public function getUsers($users = []) {
        $this->users = $users[$this->id];
    }

    public function getTimePunchesByUser($user_id, $time_punches = []) {

        foreach ($time_punches as $time_punch) {
            if ($time_punch->locationId == $this->id) {
                $tp_by_user[$time_punch->userId][] = $time_punch;
            }else{
                dump('Invalid location');
            }
        }
        return $tp_by_user[$user_id];
    }

}
