<?php

namespace App\Services;

use App\Models\Info;
use App\Models\JobExperience;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Collection;

class ApiService {

    public function allSkills(): Collection {
        return Skill::query()->select('title', 'value')->get();
    }

    public function info(): Info {
        return Info::query()
            ->select('name', 'photo', 'designation', 'about', 'email', 'phone', 'phone_2', 'address')
            ->first();
    }

    public function allJobExperiences(): Collection {
        return JobExperience::
            query()
            ->select('company_name', 'designation', 'responsibilities', 'start_date', 'end_date')
            ->get();
    }

}