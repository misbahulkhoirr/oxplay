<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Hexadecimal;

class LoginController extends Controller
{
    function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    function login(Request $request)
    {
        //url
        $referlogin = 'https://oplbo.com/';
        $apilogin = 'https://oplbo.com/api/login';
        $apiusers = 'https://oplbo.com/api/users';
        $apiwithdraw = 'https://oplbo.com/api/payment/payout';
        $apideposit = 'https://oplbo.com/api/payment/payin';
        $cookie = '../public/cookie/' . session()->getId() . '.txt';

        $data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );


        //LOGIN
        $ch = curl_init();
        curl_setopt_array($ch, ([
            CURLOPT_URL => $apilogin,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_REFERER => $referlogin,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_COOKIEFILE =>  $cookie
        ]));
        $resLogin = curl_exec($ch);
        curl_close($ch);

        // $data = json_decode($resLogin);

        // dd(json_decode($resLogin));
        // echo "DATAAAAA" . $resLogin;

        $dataLogin = [];
        $loginData = [];
        $json = json_decode($resLogin);

        if ($json != null) {
            foreach ($json as $key => $val) {
                if (is_object($json)) {
                    $dataLogin[hex2bin($key)] = $val;
                    if (is_array($val) || is_object($val)) {
                        foreach ($val as $key1 => $val1) {
                            $loginData[hex2bin($key)][hex2bin($key1)] = $val1;
                        }
                    }
                }
            }
        }

        // dd($dataLogin);

        //decode json


        //Data Pengguna
        $ch = curl_init();
        curl_setopt_array($ch, ([
            CURLOPT_URL => $apiusers,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_COOKIEFILE =>  $cookie
        ]));
        $resUsers = curl_exec($ch);
        curl_close($ch);

        $dataUser = [];
        $userData = [];
        $json = json_decode($resUsers);

        if ($json != null) {
            foreach ($json as $key => $val) {
                if (is_object($json)) {
                    $dataUser[hex2bin($key)] = $val;
                }
            }
        }
        // if (is_object($dataUser['users'])){
        //     foreach ($dataUser['users'] as $key => $val) {
        //             $userData[hex2bin($key)] = $val;
        //         }
        //     }
        // }

        dd($dataUser);


        //DEPOSIT
        $ch = curl_init();
        curl_setopt_array($ch, ([
            CURLOPT_URL => $apideposit,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_COOKIEFILE =>  $cookie
        ]));
        $resDeposit = curl_exec($ch);
        curl_close($ch);
        // echo $resDeposit;

        //withdraw
        $ch = curl_init();
        curl_setopt_array($ch, ([
            CURLOPT_URL => $apiwithdraw,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_COOKIEFILE =>  $cookie
        ]));
        $resWithdraw = curl_exec($ch);
        curl_close($ch);
        // echo $resWithdraw;
        // return redirect()->route('admin-dashboard')->with([
        //     'resLogin' => $resLogin,
        //     'resUsers' => $resUsers,
        //     'resDeposit' => $resDeposit,
        //     'resWithdraw' => $resWithdraw,
        // ]);
    }
}
