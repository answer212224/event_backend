<?php
if (!function_exists('getIp')) {
    function getIp()
    {
        if (!empty($_SERVER['True-Money-IP'])) {
            $IP = $_SERVER['True-Money-IP'];
        } else if (!empty($_SERVER['HTTP_VERCIP'])) {
            $IP = $_SERVER['HTTP_VERCIP'];
        } else if (!empty($_SERVER['HTTP_AKACIP'])) {
            $IP = $_SERVER['HTTP_AKACIP'];
        } else if (!empty($_SERVER['HTTP_L7CIP'])) {
            $IP = $_SERVER['HTTP_L7CIP'];
        } else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $IP = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $IP = $_SERVER['REMOTE_ADDR'];
        } else {
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $IP;
    }
}

if (!function_exists('getUdnMember')) {
    function getUdnMember($udnmember, $um2)
    {
        $response = Http::get('https://umapi.udn.com/member/wbs/MemberUm2Check', [
            'account' => $udnmember,
            'um2' => $um2,
            'json' => 'Y',
        ]);

        return $response->json();
    }
}
