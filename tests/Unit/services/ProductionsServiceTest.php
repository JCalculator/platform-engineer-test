<?php

namespace Tests\Unit\services;

use App\Services\RequestService;
use App\Services\ProductionsService;
// use PHPUnit\Framework\TestCase;
 use Tests\TestCase;

class ProductionsServiceTest extends TestCase
{
    protected $sut;

    protected function setUp(): void
    {
        parent::setup();
        $this->prepareRequestService();
        $this->sut = $this->app->make(\App\Services\ProductionsService::class);
    }

    public function testItRetrievesAllLocations()
    {
        $expected = count(json_decode($this->locations)->features);
        $this->assertEquals($expected, $this->sut->getLocations()->count());
    }

    public function testItRetrievesLocationsAsCollection()
    {
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $this->sut->getLocations());
    }

    public function testItFiltersLocationsByShootDate()
    {
        $startDate = \Carbon\Carbon::create(2015, 05, 01, 0, 0, 0);
        $endDate = \Carbon\Carbon::create(2015, 05, 29, 0, 0, 0);
        
        $this->assertCount(2, $this->sut->getLocationsByShootDate($startDate, $endDate)->all());
    }

    private function prepareRequestService()
    {
        $this->locations = '
        {
            "features": [
                {
                "attributes": {
                    "OBJECTID": 6027,
                    "Title": "IDR: Where we are when ",
                    "Type": "Movie",
                    "IMDbLink": "NA",
                    "Address": "300 San Pedro Dr Ne",
                    "Site": "Tingley Coliseum ",
                    "ShootDate": 1433894400000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.57744081521513,
                    "y": 35.080780747447086
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6028,
                    "Title": "IDR: Where we are when ",
                    "Type": "Movie",
                    "IMDbLink": "NA",
                    "Address": "300 San Pedro Dr Ne",
                    "Site": "Tingley Coliseum ",
                    "ShootDate": 1433980800000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.57744081521513,
                    "y": 35.080780747447086
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6029,
                    "Title": "IDR: Where we are when ",
                    "Type": "Movie",
                    "IMDbLink": "NA",
                    "Address": "300 San Pedro Dr Ne",
                    "Site": "Tingley Coliseum ",
                    "ShootDate": 1434067200000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.57744081521513,
                    "y": 35.080780747447086
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6030,
                    "Title": "IDR: Where we are when ",
                    "Type": "Movie",
                    "IMDbLink": "NA",
                    "Address": "300 San Pedro Dr Ne",
                    "Site": "Tingley Coliseum ",
                    "ShootDate": 1435708800000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.57744081521513,
                    "y": 35.080780747447086
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6031,
                    "Title": "IDR: Where we are when ",
                    "Type": "Movie",
                    "IMDbLink": "NA",
                    "Address": "300 San Pedro Dr Ne",
                    "Site": "Tingley Coliseum ",
                    "ShootDate": 1436140800000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.57744081521513,
                    "y": 35.080780747447086
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6032,
                    "Title": "Katie Says Goodbye ",
                    "Type": "Movie",
                    "IMDbLink": "http://www.imdb.com/title/tt4547938/?ref_=fn_al_tt_1",
                    "Address": "  2700 4th St NW",
                    "Site": "Court John Motel",
                    "ShootDate": 1428624000000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.64637372754987,
                    "y": 35.111896525981045
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6033,
                    "Title": "Preacher ",
                    "Type": "TV Series",
                    "IMDbLink": "NA",
                    "Address": "400 2nd St SW ",
                    "Site": "Gertrude Zachary ",
                    "ShootDate": 1431561600000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.64978213336717,
                    "y": 35.081261509040552
                }
                },
                {
                "attributes": {
                    "OBJECTID": 6034,
                    "Title": "Preacher ",
                    "Type": "TV Series",
                    "IMDbLink": "NA",
                    "Address": "8603 Zuni Rd SE ",
                    "Site": "Bea\'s Mexican Restaurant 2",
                    "ShootDate": 1432598400000,
                    "OriginalDetails": null
                },
                "geometry": {
                    "x": -106.55152682315999,
                    "y": 35.072742876513381
                }
                }
            ]
        }';
        return $this->mock(RequestService::class, function ($mock) {
            $mock->shouldReceive('get')->andReturn($this->locations);
        });
    }
}
