<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Location;


class LocationTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLocation() {
        $this->assertTrue(true);
    }

    public function testGetLocationsRoute() {
        $response = $this->get('/locations');
        $response->assertStatus(200);
    }

    public function testGetLocations() {
        $collection = Location::getLocations();

        $this->assertTrue(!empty($collection));
    }

    

}
