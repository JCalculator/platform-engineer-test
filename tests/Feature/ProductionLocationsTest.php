<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductionLocationsTest extends TestCase
{
    protected $startDate;
    protected $endDate;

    protected function setUp(): void
    {
        parent::setup();
        $this->startDate = \Carbon\Carbon::create(2015, 05, 01, 0, 0, 0)->getPreciseTimestamp(3);
        $this->endDate = \Carbon\Carbon::create(2015, 05, 29, 0, 0, 0)->getPreciseTimestamp(3);
    }

    public function testItRetrievesAPreciseAmountOfLocations()
    {
        $response = $this->postJson('/api/productions/locations', ['shoot_date_from' => $this->startDate, 'shoot_date_to' => $this->endDate, 'timezone' => 'America/Caracas']);

        $response
            ->assertJson([
                'count' => 1,
                'productions' => [
                    [
                        'title' => 'Preacher',
                        'type' => 'TV Series',
                        'sites' => [
                            [
                                'name' => 'Gertrude Zachary',
                                'shoot_date' => 'May 13, 2015'
                            ],
                            [
                                'name' => 'Bea\'s Mexican Restaurant 2',
                                'shoot_date' => 'May 25, 2015'
                            ]
                        ]
                    ]
                ]
            ])
            ->assertStatus(200);
    }

    public function testItFailsIfTheShootDatesAreMissing()
    {
        $response = $this->postJson('/api/productions/locations');
        $response->assertStatus(422);
    }

    public function testItFailsIfTheShootDateFromDateIsMissing()
    {
        $response = $this->postJson('/api/productions/locations', ['shoot_date_from' => $this->startDate]);

        $response->assertStatus(422);
    }

    public function testItFailsIfTheShootDateToDateIsMissing()
    {
        $response = $this->postJson('/api/productions/locations', ['shoot_date_to' => $this->endDate]);

        $response->assertStatus(422);
    }
}
