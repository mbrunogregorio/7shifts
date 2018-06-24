<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Location;
use App\Model\User;
use App\Model\TimePunch;
use GuzzleHttp\Client;

class OvertimeController extends Controller {

    public function index() {
        $locations = Location::getLocations();
        $users_list = User::getUsers();
        $time_punches = TimePunch::getTimePunches();

        foreach ($locations as $location) {
            $location->getUsers($users_list);
        }
        
        $users = [];
        foreach ($location->users as $key => $user) {
            $user->timePunches = $location->getTimePunchesByUser($user->id, $time_punches);
            #$user->printTimePunches();
            $user->calculateWorking($location);
            $users[] = $user;
        }
        return view('overtime', compact('users'));
    }

    public function locations() {
        $locations = Location::getLocations();
        #dump($users);
        return $locations;
    }
    
    public function users() {
        $users = User::getUsers();
        #dump($users);
        return $users;
    }

    public function timePunches() {
        $time_punches = TimePunch::getTimePunches();
        #dump($time_punches);
        return $time_punches;
    }

}
