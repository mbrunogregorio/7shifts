<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\User;

class UserTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser() {
        $this->assertTrue(true);
    }

    public function testgetUsersRoute() {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
    
    public function testgetUsers() {
        $collection = User::getUsers();
        $this->assertTrue(!empty($collection));
    }

}
