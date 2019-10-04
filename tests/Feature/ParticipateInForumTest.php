<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForum extends TestCase
{
    use DatabaseMigrations;
    /**@test */
    public function test_that_unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Database\QueryException');
        $thread = create('App\Thread');
       
        $this->post('/threads/1/replies', []);
    }


    /**@test */
    public function test_that_an_authenticated_user_participates_in_forum_threads()
    {
        //Given we have an authenticated user
        $this->signIn();
        
        //And an existing thread
        $thread = create('App\Thread');
       
        //When the user adds a reply to the thread
        $reply = make('App\Reply');

        $this->post($thread->path(). '/replies', $reply->toArray());

        //Then their reply should be visible on the page
        $this->get($thread->path())
           ->assertSee($reply->body);
    }
}
