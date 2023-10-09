<?php

namespace App\Jobs;

use App\Http\Controllers\ExamInfoController;
use App\Http\Controllers\SmsController;
use App\Models\Result;
use App\Models\Sms;
use App\Models\User;
use App\Notifications\AdminSmsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessSendSmsTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $result;
    private $phone;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $retryAfter = 10;

    /**
     * Create a new job instance.
     */
    public function __construct(Result $result, $phone)
    {
        $this->result = $result;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sms_controller = new SmsController();

        $content = $sms_controller->messageContent($this->result);
        $student = $content['student'];
        $exam_info = $content['exam_info'];
        $smsContent = $content['message'];
        $sms = $sms_controller->smsSend($this->phone, $smsContent);

        $exp = explode("|", $sms);
        $status = $exp[0];
        $response_text = $exp[1];

        if ($status != 1101) {
            $status_msg = $sms_controller->statusMsg($status);
            Log::channel('sms')->error($status_msg);

            $notification_data = [
                'status_msg' => $status_msg,
                'student' => $student,
                'phone' => $this->phone,
                'exam_info' => $exam_info,
            ];

            $users = User::where('id', $this->result->root_id)->orWhere('user_type_id', 1)->get();
            Notification::send($users, new AdminSmsNotification($notification_data));

        } else {
            (new ExamInfoController())->updateGotSmsStatus($this->result);

            Sms::create([
                'student_id' => $this->result->student_id,
                'opt' => null,
                'response_code' => $status,
                'phone' => $this->phone,
                'response_text' => $response_text,
            ]);
        }
    }
}
