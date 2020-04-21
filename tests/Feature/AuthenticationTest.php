<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testAdministrationRequiresLogin(): void
    {
        $response = $this->get(route('administration.index'));

        // The response should be a redirect to login page
        $response->assertStatus(302);
        $response->assertRedirect(route('authentication.gate'));
    }

    public function testUserCanViewLoginPage(): void
    {
        $response = $this->get(route('authentication.gate'));

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testUserCanLoginWithValidCredentials(): void
    {
        $user = factory(User::class)->create();
        $user->save();

        $this->assertDatabaseHas('users', ['username' => $user->username, 'password' => $user->password]);

        $data = [
            'username' => $user->username,
            'password' => 'password', // Defined in the User factory
            '_token' => csrf_token()
        ];

        $response = $this->post(route('authentication.login', $data));

        $response->assertStatus(302);
        $response->assertRedirect(route('administration.index'));
        $response->assertSessionDoesntHaveErrors();
    }

    public function testUserCannotLoginWithoutValidCredentials(): void
    {
        // Delete all users from the database
        $this->refreshDatabase();

        $user = [
            'username' => 'test',
            'password' => 'test',
        ];

        $this->assertDatabaseMissing('users', ['username' => $user['username'], 'password' => bcrypt($user['password'])]);

        $data = Arr::add($user, '_token', csrf_token());

        $response = $this->from(route('authentication.gate'))->post(route('authentication.login'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('authentication.gate'));
        $response->assertSessionHasErrors();
    }

    public function testAuthenticatedUserCanAccessAdministrationIndex()
    {
        $user = factory(User::class)->create();
        $user->save();

        $this->assertDatabaseHas('users', ['username' => $user->username, 'password' => $user->password]);

        $response = $this->actingAs($user)->get(route('administration.index'));

        $response->assertStatus(200);
    }
}
