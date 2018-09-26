<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Feature\PassportTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookApiUnitTest extends PassportTestCase
{
    use DatabaseTransactions;
    public function testCreateBookRecord()
    {
        $faker = \Faker\Factory::create();
        $prefix = 'BLK';
        $data = [
            'title' => $faker->name,
            'ISBN' => $prefix. 1939949979,
            'publisher' => $faker->name,
            'publication_year' => $faker->date($format = 'Y-m-d', $max = 'now'),
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $this->header['Authorization']
        ])->json('POST', '/api/v1/books', $data);

        $response->assertStatus(200)
                ->assertOk()
                ->assertJson([
                'message' => 'book created',
                'status' => 'success',
            ]);
    }
}
