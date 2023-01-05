<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function checkOrder()
    {
        $key = 'AkYyUXR3jcPL1awl4hBRdU5tzuHOgmst';
        $iv = 'CSO2q00aW6Gj6ywP';
        $mid = 'MS346253986';

        $data1 = http_build_query([
            'MerchantID' => $mid,
            'TimeStamp' => time(),
            'Version' => '2.0',
            'RespondType' => 'String',
            'MerchantOrderNo' => 'Vanespl_ec_' . time(),
            'Amt' => '120',
            'ReturnURL' => '',
            'NotifyURL' => 'https://event.udn.com/liam_fb/',
            'ItemDesc' => 'test',
        ]);

        $edata1 = bin2hex(openssl_encrypt($data1, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $hashs = 'HashKey=' . $key . '&' . $edata1 . '&HashIV=' . $iv;
        $hash = strtoupper(hash('sha256', $hashs));

        return view('test', compact('mid', 'edata1', 'hash'));
    }

    public function checkCode()
    {
        $key = 'AkYyUXR3jcPL1awl4hBRdU5tzuHOgmst';
        $iv = 'CSO2q00aW6Gj6ywP';
        $mid = 'MS346253986';

        $data1 = http_build_query([
            'MerchantID' => $mid,
            'TimeStamp' => time(),
            'Version' => '2.0',
            'RespondType' => 'String',
            'MerchantOrderNo' => 'Vanespl_ec_' . time(),
            'Amt' => '120',
            'ReturnURL' => 'https://event.udn.com/taipeibus2022/',
            'ItemDesc' => 'test',
        ]);

        $edata1 = bin2hex(openssl_encrypt($data1, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $hashs = 'HashKey=' . $key . '&' . $edata1 . '&HashIV=' . $iv;
        $hash = strtoupper(hash('sha256', $hashs));

        return view('test', compact('mid', 'edata1', 'hash'));
    }
}
