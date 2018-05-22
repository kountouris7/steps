<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_has_a_profile()
    {
        $user = create('App\User');
        $this->get("/profiles/{$user->name}")
             ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_groups_booked_by_the_associated_user()
    {
        $user = create('App\User');
        $groupUser = create('App\GroupUser', ['user_id' => $user->id]);
        $this->get("/profiles/{$user->name}")
             ->assertSee($groupUser->user_id);

    }
}