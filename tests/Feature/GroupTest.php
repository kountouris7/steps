<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    function only_auth_users_can_view_groups()
    {
        $this->withExceptionHandling();

        $this->get('/show')
            ->assertRedirect('/login');
    }

    /** @test */
        function an_authenticated_user_may_book_any_group()
    {
        $this->signIn();
        $group = create('App\Group');
        $this->post('booking/' . $group->id);
        $this->assertCount(1, $group->bookings);
        // bookings what is it ?is it the method bookings() in booked trait?? ///
    }

    /** @test */
        function an_authenticated_user_may_only_book_a_group_once()
    {
        $this->signIn();
        $group = create('App\Group');
        try {
            $this->post('booking/' . $group->id);
            $this->post('booking/' . $group->id);
        } catch (\Exception $e) {
            $this->fail('Did not expect to book the group record twice');
        }
        $this->assertCount(1, $group->bookings);
    }

    /** @test */
    function unauthorized_users_may_not_delete_groups()
    {
        $this->withExceptionHandling();
        $groupuser = create('App\GroupUser');
        $this->delete(route('groupuser.destroy', [$groupuser->group_id]))->assertRedirect('/login');

        $this->signIn();
        $this->delete(route('groupuser.destroy', [$groupuser->group_id]))->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_delete_bookings()
    {
        $this->signIn();

        $groupuser = create('App\GroupUser', ['user_id' => auth()->id()]);

        $response = $this->json('DELETE', $groupuser->path());

        $response->assertStatus(200);

        $this->assertDatabaseMissing('group_users', ['user_id' => $groupuser->user_id]);

    }

}
