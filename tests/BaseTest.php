<?php

use Laravel\Lumen\Testing\WithoutMiddleware;

class BaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->get('/');
        $this->assertEquals(env('APP_NAME'),$this->response->getContent());
    }
}
