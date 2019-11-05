<?php

use Laravel\Lumen\Testing\WithoutMiddleware;

class AuthTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_successful_login()
    {
        $response=$this->call('POST', '/auth/login', [
            'email'    => 'user@example.com',
            'password' => 'AGoodPassword'
        ]);
        $this->assertStringContainsString('token',$response->content());
    }
    public function test_invalid_email()
    {
        $response=$this->call('POST', '/auth/login', [
            'email'    => 'user@exmple.com',
            'password' => 'AGoodPassword'
        ]);
        $this->assertStringNotContainsString('token',$response->content());
        $this->assertStringContainsString("Email does not exist.",$response->content());
    }
    public function test_invalid_login()
    {
        $response=$this->call('POST', '/auth/login', [
            'email'    => 'user@example.com',
            'password' => 'AGoodPasword'
        ]);
        $this->assertStringNotContainsString('token',$response->content());
        $this->assertStringContainsString("Email or password is wrong.",$response->content());
    }

    public function test_invalid_no_token()
    {
        $response=$this->call('GET', '/contact/');
        $this->assertStringContainsString("Token not provided.",$response->getContent());
    }
}
