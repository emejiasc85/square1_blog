<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($data = [])
    {
        $user = User::factory()->create($data);

        $this->actingAs($user, 'api');

        return $user;
    }
}
