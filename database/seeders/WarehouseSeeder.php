<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            [
                'name' => 'Головний склад',
                'code' => 'MAIN',
                'city' => 'Київ',
                'address' => 'вул. Хрещатик, 1',
                'phone' => '+380 12 345 67 89',
                'is_active' => true,
                'sort_order' => 0,
            ],
            [
                'name' => 'Склад Львів',
                'code' => 'LVIV',
                'city' => 'Львів',
                'address' => 'вул. Свободи, 10',
                'phone' => '+380 32 111 22 33',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Склад Одеса',
                'code' => 'ODESA',
                'city' => 'Одеса',
                'address' => 'Дерибасівська, 5',
                'phone' => '+380 48 222 33 44',
                'is_active' => true,
                'sort_order' => 20,
            ],
            [
                'name' => 'Склад Харків',
                'code' => 'KHARKIV',
                'city' => 'Харків',
                'address' => 'Сумська, 15',
                'phone' => '+380 57 333 44 55',
                'is_active' => true,
                'sort_order' => 30,
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::updateOrCreate(
                ['code' => $warehouse['code']],
                $warehouse
            );
        }
    }
}
