<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Task;
use \App\User;

class TaskTest extends TestCase
{
    use DatabaseMigrations;
    //use WithoutMiddleware;
    
    private $user;
    
    public function setup()
    {
        parent::setup();

        $this->user = factory(\App\User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCompleteDeleteTask()
    {        
        
        $tasks_before = Task::all();
        
        $this->assertTrue(0 == count($tasks_before));                  

        $response = $this->actingAs($this->user)->post('tasks',[
            'title' => 'hello',
            'description' => 'this is my description',
            'user_id' => $this->user->id,
            'category' => 'work',
            'priority' => 'low',
            'state' => 'pending'            
        ]);

        
        
        $response->assertStatus(200);        
        
        $this->assertTrue(count($tasks_before) + 1 == count(Task::all()));

        
        $response = $this->actingAs($this->user)
                            ->post(route('tasks.complete',['task'=> Task::first()]))
                            ->assertStatus(200);
                                    
        $this->assertTrue(Task::first()->state == 'done');
            
        $response = $this->actingAs($this->user)
                            ->delete(route('tasks.destroy',['task' => Task::first()]))
                            ->assertStatus(200);

        $this->assertTrue(count($tasks_before) == count(Task::all()));
    }
}

