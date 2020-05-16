<?php 

namespace App\Services;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Mappers\ABQLocationToProductionLocationMapper;
use Illuminate\Support\Facades\Redis;

class ProductionsService
{
    protected $requestService;

    public function __construct(RequestService $requestService, ABQLocationToProductionLocationMapper $mapper)
    {
        $this->requestService = $requestService;
        $this->mapper = $mapper;
    }

    public function getLocations($filters=[]) : Collection
    {
        return $this->fetchProductionsApiLocations();
    }

    public function getProductionsByShootDate($startDate, $endDate, $timezone) : Array
    {
        $groupedCollection = $this->getLocationsByShootDate($startDate, $endDate)
        ->groupBy('titleHash')
        ->map(function($sites, $titleHash) use($timezone) {
            return (object) [
                'title' => $sites[0]->title,
                'type' => $sites[0]->type,
                'sites' => $sites->map(function($item) use($timezone) {
                    return (object)[
                        'name' => $item->site,
                        'shoot_date' => $item->shoot_date->setTimezone($timezone)->toFormattedDateString()
                    ];
                })
            ];
        })
        ->all();

        return array_values($groupedCollection);
    }

    public function getLocationsByShootDate($startDate, $endDate) : Collection
    {
        return $this->getLocations()->whereBetween('shoot_date', [$startDate, $endDate]);
    }

    private function fetchProductionsApiLocations() : Collection
    {
        $key = env('ABQ_CACHE_KEY', self::class . '.all-productions-locations');
        $locations = Redis::get($key);

        if (is_null($locations)) {
            $locations = $this->fetchProductionsApi();
            $mapper = $this->mapper;
            $locations = collect(array_map(function ($item) use($mapper) {
                return $mapper->map($item);
            }, $locations->features));
            Redis::set($key, serialize($locations), 'EX', env('ABQ_CACHE_EXPIRATION_TIME', 24*60*60));
        } else {
            $locations = unserialize($locations);
        }

        return $locations;
    }

    private function fetchProductionsApi() : object
    {
        $url = env('ABQ_API_URL');
        $result = json_decode($this->requestService->get($url));
        
        if (is_null($result)) {
            Log::error("Productions API returned an invalid JSON when called using: $url");
            $result = (object)[
                'features' => []
            ];
        }
        return $result;
    }
}