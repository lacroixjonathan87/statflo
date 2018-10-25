<?php


namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
	use RefreshDatabase;

	public function testEmptyList()
	{
		$response = $this->json('GET', '/api/users');

		$response->assertStatus(200);

		$data = $response->json('data');
		$this->assertEquals(0, count($data));

		$currentPage = $response->json('meta.current_page');
		$this->assertEquals(1, $currentPage);

		$total = $response->json('meta.total');
		$this->assertEquals(0, $total);
	}

	public function testList()
	{
		factory(User::class, 3)->create();

		$response = $this->json('GET', '/api/users');

		$response->assertStatus(200);

		$data = $response->json('data');
		$this->assertEquals(3, count($data));

		$currentPage = $response->json('meta.current_page');
		$this->assertEquals(1, $currentPage);

		$total = $response->json('meta.total');
		$this->assertEquals(3, $total);
	}

	public function testNameFilter()
	{
		factory(User::class)->create(['name' => 'Patrick']);
		factory(User::class)->create(['name' => 'Bruce']);
		factory(User::class)->create(['name' => 'Paul']);

		$response = $this->json('GET', '/api/users', ['name' => 'Pa']);

		$response->assertStatus(200);

		$data = $response->json('data');
		$this->assertEquals(2, count($data));

		$currentPage = $response->json('meta.current_page');
		$this->assertEquals(1, $currentPage);

		$total = $response->json('meta.total');
		$this->assertEquals(2, $total);
		var_dump($response->json());
	}
}
