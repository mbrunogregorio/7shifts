<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Location;
use App\Model\User;
use App\Model\TimePunch;

class LocationUserTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetTimePunchesByUser() {
        $collection = Location::getLocations();
        $users = User::getUsers();
        $time_punches = TimePunch::getTimePunches();

        $pass = true;
        foreach ($collection as $location) {
            foreach ($users[$location->id] as $user) {
                $return = $location->getTimePunchesByUser($user->id, $time_punches);
                $pass = $pass && is_array($return);
            }
        }
        $this->assertTrue($pass);
    }

}
