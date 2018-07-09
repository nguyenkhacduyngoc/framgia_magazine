<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendDailyMailJob;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function sendDailyMail()
    {
        // $user = User::findOrFail($id);
        SendDailyMailJob::dispatch();
        return redirect()->route('homepage');
    }
}
