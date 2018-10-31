<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \App\User;

class RouteTest extends TestCase
{
    use DatabaseMigrations;
    
    private $user;

    public function setup()
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->create([
            'name' => 'User blabla',
            'email' => 'blabla@bla.com',
            'password' => bcrypt('123456')
        ]);
    }
    public function testFirstPage()
    {
        $response = $this->get('/');
        $response->assertSTatus(302);
        $response->assertRedirect('/login');
        
        $response = $this->followRedirects($response);
        
        $response->assertStatus(200);
        $response->assertSee('Forgot Your Password');
    }

    public function testOkLogin()
    {


        $this->assertCount(1,User::all());
        
        $response = $this->post('/login',['email' => $this->user->email, 'password' => '123456']);
        $response = $this->followREdirects($response);
        $response->assertStatus(200);
        
        $response->assertSee('Logout');        
    }    
}
