<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshtaService
{
    private string $apiUrl = 'https://api.novaposhta.ua/v2.0/json/';
    private ?string $apiKey;
    private bool $isSandbox;
    private int $cacheTtl;

    public function __construct()
    {
        $this->apiKey = config('services.novaposhta.api_key');
        $this->isSandbox = config('services.novaposhta.mode') === 'sandbox';
        $this->cacheTtl = (int) config('services.novaposhta.cache_ttl', 86400);
    }

    /**
     * Поиск городов по запросу
     */
    public function searchCities(string $query): array
    {
        if ($this->isSandbox) {
            return $this->getMockCities($query);
        }

        $cacheKey = "np_cities_" . md5($query);

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($query) {
            try {
                $response = Http::post($this->apiUrl, [
                    'apiKey' => $this->apiKey,
                    'modelName' => 'Address',
                    'calledMethod' => 'searchSettlements',
                    'methodProperties' => [
                        'CityName' => $query,
                        'Limit' => 20,
                    ],
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['data'][0]['Addresses'])) {
                        return collect($data['data'][0]['Addresses'])->map(function ($city) {
                            return [
                                'ref' => $city['DeliveryCity'] ?? '',
                                'name' => $city['Present'] ?? '',
                                'area' => $city['Area'] ?? '',
                            ];
                        })->toArray();
                    }
                }

                Log::warning('NovaPoshta API error', ['response' => $response->body()]);
                return [];

            } catch (\Exception $e) {
                Log::error('NovaPoshta searchCities error', ['error' => $e->getMessage()]);
                return [];
            }
        });
    }

    /**
     * Получить отделения по городу
     */
    public function getWarehouses(string $cityRef): array
    {
        if ($this->isSandbox) {
            return $this->getMockWarehouses($cityRef);
        }

        $cacheKey = "np_warehouses_" . md5($cityRef);

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($cityRef) {
            try {
                $response = Http::post($this->apiUrl, [
                    'apiKey' => $this->apiKey,
                    'modelName' => 'Address',
                    'calledMethod' => 'getWarehouses',
                    'methodProperties' => [
                        'CityRef' => $cityRef,
                        'Limit' => 500,
                    ],
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['data']) && is_array($data['data'])) {
                        return collect($data['data'])->map(function ($warehouse) {
                            return [
                                'ref' => $warehouse['Ref'] ?? '',
                                'number' => $warehouse['Number'] ?? '',
                                'description' => $warehouse['Description'] ?? '',
                                'address' => $warehouse['ShortAddress'] ?? '',
                            ];
                        })->toArray();
                    }
                }

                Log::warning('NovaPoshta API error', ['response' => $response->body()]);
                return [];

            } catch (\Exception $e) {
                Log::error('NovaPoshta getWarehouses error', ['error' => $e->getMessage()]);
                return [];
            }
        });
    }

    /**
     * Mock данные для sandbox режима - города
     */
    private function getMockCities(string $query): array
    {
        $cities = [
            ['ref' => 'city_kyiv', 'name' => 'Київ', 'area' => 'Київська область'],
            ['ref' => 'city_kharkiv', 'name' => 'Харків', 'area' => 'Харківська область'],
            ['ref' => 'city_odesa', 'name' => 'Одеса', 'area' => 'Одеська область'],
            ['ref' => 'city_dnipro', 'name' => 'Дніпро', 'area' => 'Дніпропетровська область'],
            ['ref' => 'city_lviv', 'name' => 'Львів', 'area' => 'Львівська область'],
        ];

        return array_filter($cities, function ($city) use ($query) {
            return stripos($city['name'], $query) !== false;
        });
    }

    /**
     * Mock данные для sandbox режима - отделения
     */
    private function getMockWarehouses(string $cityRef): array
    {
        return [
            ['ref' => 'wh_1', 'number' => '1', 'description' => 'Відділення №1', 'address' => 'вул. Центральна, 10'],
            ['ref' => 'wh_2', 'number' => '2', 'description' => 'Відділення №2', 'address' => 'вул. Шевченка, 25'],
            ['ref' => 'wh_3', 'number' => '3', 'description' => 'Відділення №3', 'address' => 'пр. Миру, 45'],
            ['ref' => 'wh_5', 'number' => '5', 'description' => 'Відділення №5', 'address' => 'вул. Лесі Українки, 12'],
            ['ref' => 'wh_7', 'number' => '7', 'description' => 'Відділення №7', 'address' => 'вул. Хрещатик, 88'],
        ];
    }
}
