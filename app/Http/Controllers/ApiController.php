<?php

namespace App\Http\Controllers;

use App\Actions\SendMail;
use App\Actions\StoreMessage;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\InfoResource;
use App\Http\Resources\JobExperienceResource;
use App\Http\Resources\SkillResource;
use App\Services\ApiService;

class ApiController extends Controller {

    public $apiService;

    public function __construct(ApiService $apiService) {
        $this->apiService = $apiService;
    }

    public function getSkill() {

        $skills = $this->apiService->allSkills();

        return $this->apiSuccessResponse(SkillResource::collection($skills), 'Data retrieved successfully');
    }

    public function getInfo() {

        $info = $this->apiService->info();

        return $this->apiSuccessResponse(new InfoResource($info), 'Info retrieved successfully');
    }

    public function getJobExperience() {

        $jobExperiences = $this->apiService->allJobExperiences();

        return $this->apiSuccessResponse(JobExperienceResource::collection($jobExperiences), 'Data retrieved successfully');
    }

    public function sendMessage(MessageRequest $request, StoreMessage $storeMessageAction, SendMail $mailAction) {

        $validatedData = $request->validated();

        $storeMessageAction->handle($validatedData);

        $mailAction->handle($validatedData);

        return $this->apiSuccessResponse([], 'Message created successfully');
    }
}
