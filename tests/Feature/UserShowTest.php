<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserShowTest extends TestCase
{
	use RefreshDatabase;

	public function testNoneExistingUser()
	{
		$response = $this->json('GET', '/api/users/100');

		$response->assertStatus(404);

		$message = $response->json('message');
		$this->assertEquals('Record not found', $message);
	}

	public function testExistingUser()
	{
		$user = factory(User::class)->create();
		$id = $user->id;

		$response = $this->json('GET', '/api/users/'.$id);

		$response->assertStatus(200);
		$response->assertJson([
			'data' => [
				'id' => $user->id,
				'name' => $user->name,
				'role' => $user->role,
			]
		]);
	}

}