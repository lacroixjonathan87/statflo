<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserStoreTest extends TestCase
{
	use RefreshDatabase;

	public function testStore()
	{
		$data = [
			'name' => 'Paul',
			'role' => 'CTO',
		];
		$response = $this->json('POST', '/api/users', $data);

		$response->assertStatus(201);

		$response->assertJson([
			'data' => $data,
		]);

		$this->assertDatabaseHas('users', $data);
	}

	public function testRequired()
	{
		$data = [];
		$response = $this->json('POST', '/api/users', $data);

		$response->assertStatus(400);

		$message = $response->json('message');
		$this->assertEquals('Not able to save the user', $message);

		$errors = $response->json('errors');
		$this->assertEquals(2, count($errors));
	}

}