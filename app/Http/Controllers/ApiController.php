<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\InfoResource;
use App\Http\Resources\JobExperienceResource;
use App\Http\Resources\SkillResource;
use App\Mail\MessageMail;
use App\Models\Info;
use App\Models\JobExperience;
use App\Models\Message;
use App\Models\Skill;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller {
    public function getSkill() {
        $skills = Skill::query()
            ->select('title', 'value')
            ->get();

        return $this->apiSuccessResponse(SkillResource::collection($skills), 'Data retrieved successfully');
    }

    public function getInfo() {
        $info = Info::query()
            ->select('name', 'photo', 'designation', 'about', 'email', 'phone', 'phone_2', 'address')
            ->first();

        return $this->apiSuccessResponse(new InfoResource($info), 'Info retrieved successfully');
    }

    public function getJobExperience() {
        $jobs = JobExperience::
            query()
            ->select('company_name', 'designation', 'responsibilities', 'start_date', 'end_date')
            ->get();

        return $this->apiSuccessResponse(JobExperienceResource::collection($jobs), 'Data retrieved successfully');
    }

    public function sendMessage(MessageRequest $request) {
        Message::create($request->validated());

        Mail::to(env('DEFAULT_MAIL'))->send(new MessageMail($request->all()));

        return $this->apiSuccessResponse([], 'Message created successfully');
    }
}
