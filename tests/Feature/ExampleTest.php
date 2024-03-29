<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('http://mygym.test/');

        if ($response->getStatusCode() === 302) {
            // If redirected, attempt login with admin credentials
            $response = $this->post('http://mygym.test/login', [
                'email' => 'boss@admin.com',
                'password' => 123,
            ]);

            // Assert that login was successful (replace 200 with actual success status code)
            $response->assertStatus(200);
        } else {
            // If not redirected, assert the status code is 200
            $response->assertStatus(200);
        }
    }
}
