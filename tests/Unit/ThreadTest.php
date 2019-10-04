<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();
  
        $this->thread = create('App\Thread');
    }
    /** @test */
    public function test_that_a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function test_that_a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function test_that_a_thread_can_have_a_reply()
    {
        $this->thread->addReply([
          'body' => 'Foobar',
          'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
