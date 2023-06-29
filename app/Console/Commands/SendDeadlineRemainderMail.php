<?php

namespace App\Console\Commands;

use App\Enums\UserType;

use App\Mail\ProjectTrackingRemainderToAdminMail;
use App\Mail\ProjectTrackingRemainderToUserMail;
use App\Models\TrackingProject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDeadlineRemainderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadline:trackingpost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayDate = Carbon::now()->toDateString();
        $remainderUsers = TrackingProject::where('teacking_project_status', 0)->orWhere('teacking_project_status', 1)->get();
        $admin = User::where('user_type', UserType::ADMIN)->first();

        foreach ($remainderUsers as $user) :
            $remainderDate = Carbon::parse($user->user_deadline_accomplish_date)->subDays(7)->toDateString();
            if ($todayDate == $remainderDate) :
                Mail::to($user->user->email)->send(new ProjectTrackingRemainderToUserMail($user));
                Mail::to($admin->email)->send(new ProjectTrackingRemainderToAdminMail($user));
            endif;
        endforeach;
    }
}
