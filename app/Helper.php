<?php

namespace App;

use App\Models\OtherData;
use Illuminate\Console\Scheduling\Schedule;

class Helper
{
    public static function addHistory(string $route, string $name): void
    {
        $history = session('history');

        if (sizeof($history) == 0) {
            Helper::deleteArray($history, $route, $name);
        } else {
            if ($history[sizeof($history) - 1]['name'] !== $name) {
                Helper::deleteArray($history, $route, $name);
            }
        }
    }

    public static function deleteArray($history, $route, $name)
    {
        if (sizeof($history) >= 5) {
            for ($i = 0; $i < sizeof($history); $i++) {
                if ($i == sizeof($history) - 1) {
                    unset($history[$i]);
                } else {
                    $history[$i] = $history[$i + 1];
                }
            }
        }

        $history[sizeof($history)] = [
            'route' => $route,
            'name' => $name
        ];

        session()->put('history', $history);
    }

    public static function getHariMasukForScheduling(): array
    {
        $days = OtherData::where('name', 'Hari Masuk')->first();
        $days = explode(", ", $days->value);
        $result = [];
        foreach ($days as $day) {
            if ($day == 'Senin') {
                $result[] = Schedule::MONDAY;
            } else if ($day == 'Selasa') {
                $result[] = Schedule::TUESDAY;
            } else if ($day == 'Rabu') {
                $result[] = Schedule::WEDNESDAY;
            } else if ($day == 'Kamis') {
                $result[] = Schedule::THURSDAY;
            } else if ($day == 'Jumat') {
                $result[] = Schedule::FRIDAY;
            } else if ($day == 'Sabtu') {
                $result[] = Schedule::SATURDAY;
            } else if ($day == 'Minggu') {
                $result[] = Schedule::SUNDAY;
            }
        }

        return $result;
    }
}