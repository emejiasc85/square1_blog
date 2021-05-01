<?php

namespace Tests\Unit;

use App\Console\Commands\SyncPostCommand;
use Tests\TestCase;

class SyncPostTest extends TestCase
{
    
    public function test_has_sync_posts_command()
    {
        $this->assertTrue(class_exists(SyncPostCommand::class));
    }

    
    public function test_can_sync_posts_command()
    {
        $this->artisan('posts:sync')
            ->assertExitCode(0);
    }
}
