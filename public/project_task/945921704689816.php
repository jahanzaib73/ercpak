<?php

namespace App\Traits;

use App\Models\Area;
use App\Models\AssignedArea;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Log;

trait ProvinceCityTrait
{
    public function getBluchistanCities($request, $memberId)
    {
        return $this->getData('Baluchistan', $memberId, $request);
    }

    public function getPunjabCities($request, $memberId)
    {
        return $this->getData('Punjab', $memberId, $request);
    }

    public function getSindhCities($request, $memberId)
    {
        return $this->getData('Sindh', $memberId, $request);
    }

    public function getKPKCities($request, $memberId)
    {
        return $this->getData('Khyber Pk', $memberId, $request);
    }
    private function getData($provinceName, $memberId, $request)
    {
        $assignedAreaIds = AssignedArea::when($request->filter_team_id, function ($query) use ($request) {
            if ($request->filter_team_id > 0) {
                $query->where('team_id', $request->filter_team_id);
            }
        })->where('session_year', $request->session_year)->where('member_id', $memberId)->pluck('area_id');
        $province = Province::whereName($provinceName)->first();
        $cities = Area::whereIn('id', $assignedAreaIds)->where('province_id', $province->id)->pluck('area_name');
        // $cityIds = Area::whereIn('id', $assignedAreaIds)->where('province_id', $province->id)->pluck('city_id')->unique();
        // $cities = City::whereIn('id', $cityIds)->pluck('name');
        $formattedCities = '<ul>';
        foreach ($cities as $city) {
            $formattedCities .= '<li>' . $city . '</li>';
        }
        $formattedCities .= '</ul>';

        return $formattedCities;
    }
}
