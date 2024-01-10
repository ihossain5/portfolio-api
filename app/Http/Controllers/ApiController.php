<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Mail\MessageMail;
use App\Models\Info;
use App\Models\JobExperience;
use App\Models\Message;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function getInfo(){
        return Info::first();
    }

    public function getJobExperience(){
        return JobExperience::all();
    }

    public function getPortfolio(){
        return Portfolio::all();
    }

    public function sendMessage(MessageRequest $request){
        Message::create($request->validated());

        Mail::to('ismail.hossain1460@gmail.com')->send(new MessageMail($request->all()));

        return true;
    }
}
