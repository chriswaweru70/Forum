<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**@test */
    public function test_that_a_guest_cannot_create_a_new_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }

    /**@test */
    public function test_that_an_authenticated_user_can_create_new_forum_thread()
    {
        //Given that we have an athenticated user.
        $this->actingAs(create('App\User'));
        //When we hit the endpoint to create a new thread.
        $thread = make('App\Thread');
        
        $this->post('/threads', $thread->toArray());
        //Then, when we visit the thread page
        $this->get($thread->path())
            ->assertSee($thread->title)
             ->assertSee($thread->body);
    }
}
