<?php

namespace App\Model;

use App\Model\BaseModel;
use Carbon\Carbon;

class TimePunch extends BaseModel {

    protected $fillable = [
        "id",
        "userId",
        "locationId",
        "clockedIn",
        "clockedOut",
        "created",
        "hourlyWage",
        "modified",
        "worked_time",
    ];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    
    public function setClockedInAttribute($value){
        $this->attributes['clockedIn'] = new Carbon($value);
    }
    
    public function setClockedOutAttribute($value){
        $this->attributes['clockedOut'] = new Carbon($value);
    }
    

    public static function getTimePunches() {

        $collection = TimePunch::getJson('/timePunches.json');
        foreach ($collection as $time_punch) {
            $time_punch_obj = new TimePunch((array) $time_punch);
            $ini_time_punches[] = $time_punch_obj;
        }
        return $ini_time_punches;
    }

    public function getWorkedTimeAttribute() {
        return ($this->clockedIn->diffInMinutes($this->clockedOut));
    }
    

}
