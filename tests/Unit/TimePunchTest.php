<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\TimePunch;
use Carbon\Carbon;

class TimePunchTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTimePunch() {
        $this->assertTrue(true);
    }

    public function testgetTimePunchesRoute() {
        $response = $this->get('/time');
        $response->assertStatus(200);
    }
    
    public function testgetTimePunches() {
        $collection = TimePunch::getTimePunches();
        $this->assertTrue(!empty($collection));
    }
    
    public function testWorkedTimeCalculation(){
        $time_punch =  new TimePunch();
        $time_punch->clockedIn = '2018-02-01 00:00:00';
        $time_punch->clockedOut = '2018-02-02 00:00:00';
        
        $this->assertTrue($time_punch->worked_time==1440);// One day
    }

}
