<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamInfo;
use App\Models\Result;
use App\Models\SmsFormat;
use App\Models\StudentInfo;
use App\Traits\SmsTrait;

class SmsController extends Controller
{
    use SmsTrait;

    public function smsSend($number, $content)
    {
        // $number = '01825712671, 01689325961'; you can use multiple number.
        return $this->setNumber($number)->setContent($content)->send();
    }

    public function statusMsg($code)
    {
        return $this->statusMessage($code);
    }

    public function balanceCheck()
    {
        return $this->balance();
    }

    public function availableSmsCheck()
    {
        return $this->availableSms();
    }

    public function student(Result $result): array
    {
        $student_info = StudentInfo::where('id', $result->student_id)->first();

        return [
            'student' => $student_info->name,
            'class' => $student_info->class_id,
            'phone' => $student_info->phone,
            'father' => $student_info->father_name,
            'mother' => $student_info->mother_name,
            'father_phone' => $student_info->father_phone,
            'mother_phone' => $student_info->mother_phone,
        ];
    }

    public function examInfo(Result $result): array
    {
        $exam_info = ExamInfo::with('subject')->where('id', $result->exam_info_id)->first();

        return [
            'subject' => $exam_info->subject->name,
            'exam_name' => $exam_info->name,
            'total_marks' => $exam_info->total_marks,
        ];
    }

    public function messageContent(Result $result): array
    {
        $student = $this->student($result);
        $exam_info = $this->examInfo($result);
        $sms = SmsFormat::where('exam_info_id', $result->exam_info_id)->first();
        $sms_format = $sms->text;
        $phone = $this->setSmsPhoneNumber($sms->number, $student);

        $msg = str_replace(
            [
                '$student',
                '$father',
                '$mother',
                '$phone',
                '$father_phone',
                '$mother_phone',
                '$subject',
                '$total_marks',
                '$get_marks',
            ],
            [
                $student['student'],
                $student['father'],
                $student['mother'],
                $student['phone'],
                $student['father_phone'],
                $student['mother_phone'],
                $exam_info['subject'],
                $exam_info['total_marks'],
                $result->get_marks,
            ],
            $sms_format
        );

        return [
            'message' => $msg,
            'student' => $student,
            'exam_info' => $exam_info,
            'phone' => $phone,
        ];
    }

    public function setSmsPhoneNumber(string $whom, array $student): string
    {
        if ($whom == 'father_phone') {
            $phone = $student['father_phone'];
        } elseif ($whom == 'mother_phone') {
            $phone = $student['mother_phone'];
        } else {
            $phone = $student['phone'];
        }

        return $phone;
    }
}
