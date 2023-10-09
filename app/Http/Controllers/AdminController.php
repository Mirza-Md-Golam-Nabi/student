<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $brand = 'Coaching Center';

        $sms = new SmsController();
        $sms_balance = $sms->balanceCheck();
        $sms_available = $sms->availableSmsCheck();

        return view('admin.dashboard', compact('title', 'brand', 'sms_balance', 'sms_available'));
    }
}
