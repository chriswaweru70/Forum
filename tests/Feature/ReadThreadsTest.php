<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }
    /** @test */

    public function test_that_user_can_view_all_threads()
    {
        $this->get('/threads')
           ->assertSee($this->thread->title);
    }

    /** @test */

    public function test_that_user_can_view_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */

    public function test_that_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
                       ->assertSee($reply->body);
    }
}
