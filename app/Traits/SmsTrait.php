<?php

namespace App\Traits;

trait SmsTrait
{
    private $root;
    private $number;
    private $content;

    public function __construct()
    {
        $this->root = env('ROOT');
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    private function getNumber()
    {
        return $this->number;
    }

    public function setContent($sms_text)
    {
        $this->content = $sms_text;
        return $this;
    }

    private function getContent()
    {
        return $this->content;
    }

    private function credential(): array
    {
        return [
            'username' => env('USER_NAME'),
            'password' => env('PASSWORD'),
        ];
    }

    private function balanceData(): array
    {
        return $this->credential() + [
            'type' => 'taka',
        ];
    }

    public function balance()
    {
        $url = $this->root . "/balancechk.php";

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->balanceData()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

    private function availableSmsData(): array
    {
        return $this->credential() + [
            'type' => 'sms',
        ];
    }

    public function availableSms()
    {
        $url = $this->root . "/balancechk.php";

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->availableSmsData()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

    private function smsData(): array
    {
        return $this->credential() + [
            'number' => $this->getNumber(),
            'message' => $this->getContent(),
        ];
    }

    public function send()
    {
        $url = $this->root . "/api.php";

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->smsData()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

    public function statusMessage($code): string
    {
        $initial = 'Status Code - ' . $code;
        switch ($code) {
            case 1000:
                $msg = $initial . ': Invalid user or Password';
                break;

            case 1002:
                $msg = $initial . ': Empty Number';
                break;

            case 1003:
                $msg = $initial . ': Invalid message or empty message';
                break;

            case 1004:
                $msg = $initial . ': Invalid number';
                break;

            case 1005:
                $msg = $initial . ': All Number is Invalid';
                break;

            case 1006:
                $msg = $initial . ': insufficient Balance';
                break;

            case 1009:
                $msg = $initial . ': Inactive Account';
                break;

            case 1010:
                $msg = $initial . ': Max number limit exceeded';
                break;

            case 1101:
                $msg = $initial . ': Success';
                break;

            default:
                $msg = $initial . ': Do not match any status code';
                break;
        }
        return $msg;
    }
}
