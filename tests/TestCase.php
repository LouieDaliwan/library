<?php

namespace Tests;

use App\Models\Library;
use App\Models\User;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesPermissionsSeeder::class);
    }

    protected function superAdmin(): void
    {
        $user = $this->signIn();

        $user->assignRole('Superadmin');
    }

    protected function signMember(): void
    {
        $user = $this->signIn();

        $user->assignRole('Member');
    }

    public function signIn($user = null)
    {
        $user = $user ?: User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    protected function createLibrary($name = 'Test Library', $type = 'Test Type'): Library
    {
        return Library::factory()->create([
            'name' => $name,
            'type' => $type,
        ]);
    }
}
