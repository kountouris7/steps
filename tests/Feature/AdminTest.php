<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_default_user_is_not_an_admin()
    {
        $user = create('App\User');
        $this->assertFalse($user->isAdmin());

    }

    /** @test */
    function an_admin_user_is_an_admin()
    {
        $admin = factory(User::class)
            ->states('admin')
            ->create();

        $this->assertTrue($admin->isAdmin());
    }

    /** @test */
    function a_default_user_cannot_access_the_admin_section()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->get('/admin')
             ->assertRedirect('home');
    }

    /** @test */
    function an_admin_can_access_the_admin_section()
    {
        $admin = factory(User::class)
            ->states('admin')
            ->create();

        $this->actingAs($admin)
             ->get('/admin')
             ->assertStatus(200);
    }

    /** @test */
    function an_admin_can_create_a_lesson()
    {
        //$this->withExceptionHandling();
        //$this->signIn();
        $admin = factory(User::class)
            ->states('admin')
            ->create();

        $this->actingAs($admin);

        $lesson = make('App\Lesson');

        $response = $this->post('/lessoncreate', $lesson->toArray());

        $this->get($response->headers->get('Location'))
             ->assertSee($lesson->hasname);

    }
}
