<?php

namespace App\Model;

use App\Model\BaseModel;

class User extends BaseModel {

    protected $fillable = [
        "active",
        "created",
        "email",
        "firstName",
        "hourlyWage",
        "id",
        "lastName",
        "locationId",
        "modified",
        "photo",
        "userType",
        "timePunches",
        "regularTime",
        "overTime",
        "dailyOverTime",
        "weeklyOverTime",
        "location",
    ];
    public $regularTime = array();
    public $dailyOverTime = 0;
    public $weeklyOverTime = 0;

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    /*
     * Return an array of users by location
     */

    public static function getUsers() {

        $collection = User::getJson('/users.json');

        foreach ($collection as $location_id => $location) {
            foreach ($location as $user_id => $user) {
                $user_obj = new User((array) $user);
                $user_obj->setLocation($location);
                $ini_users[$location_id][$user_id] = $user_obj;
            }
        }
        return $ini_users;
    }

    public function printTimePunches() {
        foreach ($this->timePunches as $tp) {
            return ($tp->clockedIn . '-' . $tp->clockedOut);

        }
    }

    public function calcDailyOvertime($location) {
        foreach ($this->timePunches as $time_punch) {
            if ($time_punch->worked_time > $location->labourSettings->dailyOvertimeThreshold) { //worked more then 8 hours
                $this->dailyOverTime += $time_punch->worked_time - $location->labourSettings->dailyOvertimeThreshold;
            }
        }
    }

    public function calcWeeklyWorkedTime($location) {

        $aux_week = -1;
        $aux_year = -1;
        foreach ($this->timePunches as $time_punch) {
            $week = $time_punch->clockedIn->weekOfYear;
            $year = $time_punch->clockedIn->year;

            if (($week != $aux_week) || ($year != $aux_year)) {
                $aux_week = $week;
                $aux_year = $year;
                $this->regularTime = array_merge($this->regularTime, [$week . $year]);
                $this->regularTime[$week . $year] = 0;
            }

            if ($time_punch->worked_time > $location->labourSettings->dailyOvertimeThreshold) { //worked more then 8 hours
                $this->regularTime[$week . $year] = $this->regularTime[$week . $year] + $location->labourSettings->dailyOvertimeThreshold;
            } else {
                $this->regularTime[$week . $year] = $this->regularTime[$week . $year] + $time_punch->worked_time;
            }
        }
        #dump($location->labourSettings->weeklyOvertimeThreshold);
        #dump($this->regularTime[$week . $year]);
        if ($this->regularTime[$week . $year] > $location->labourSettings->weeklyOvertimeThreshold) {
            dump($this->regularTime[$week . $year]);
            $this->weeklyOverTime += $this->regularTime[$week . $year] - $location->labourSettings->weeklyOvertimeThreshold;
        }
    }

    public function calculateWorking($location) {
        $this->calcDailyOvertime($location);
        $this->calcWeeklyWorkedTime($location);
    }
    
    public function getDailyOvertimeHour(){
        return round($this->dailyOverTime/60);
    }
    
    public function getWeeklyOvertimeHour(){
        return round($this->weeklyOverTime/60, 1);
    }

}
