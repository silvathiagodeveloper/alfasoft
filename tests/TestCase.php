<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function auth() {
        $user = User::factory(1)->create(
            [
                'email' => 'admin@alfasoft.com'
            ]);
        return $user[0];
    }
}
