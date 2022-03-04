<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;

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
        $json = json_decode($resLogin);
        // dd($json);

        foreach ($json as $key => $val) {
            if (is_object($json)) {
                if (hex2bin($key) == 'status' && $val == true) {
                    $dataLogin[hex2bin($key)] = $val;
                } else {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            $dataLogin[hex2bin($key)][hex2bin($key2)] = $val2;
                        }
                    } else {
                        $dataLogin[hex2bin($key)] = $val;
                    }
                }
            }
        }



        dd($dataLogin);

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
        $json = json_decode($resUsers);
        // dd($json);

        foreach ($json as $key => $val) {
            if (is_object($json)) {
                if (hex2bin($key) !== 'groups') {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if ($key === '7573657273') {
                            }
                            if (is_object($val2)) {
                                foreach ($val2 as $key3 => $val3) {
                                    if (is_object($val3)) {
                                        foreach ($val3 as $key4 => $val4) {
                                             if (is_object($val4)) {
                        foreach ($val4 as $key5 => $val5) {
                          // $dataUser[hex2bin($key)][hex2bin($key2)][($key3)][hex2bin($key4)][hex2bin($key5)] = $val5;
                          if (is_object($val5)) {
                            foreach ($val5 as $key6 => $val6) {
                              // $dataUser[hex2bin($key)][hex2bin($key2)][($key3)][hex2bin($key4)][hex2bin($key5)][hex2bin($key6)] = $val6;
                              if (is_object($val6)) {
                                foreach ($val6 as $key7 => $val7) {
                                  $dataUser[hex2bin($key)][hex2bin($key2)][hex2bin($key4)][hex2bin($key5)][hex2bin($key6)][hex2bin($key7)] = $val7;
                                }
                              } else {
                                $dataUser[hex2bin($key)][hex2bin($key2)][hex2bin($key4)][hex2bin($key5)][hex2bin($key6)] = $val6;
                              }
                            }
                          } else {
                            $dataUser[hex2bin($key)][hex2bin($key2)][hex2bin($key4)][hex2bin($key5)] = $val5;
                          }
                        }
                      } else {
                        $dataUser[hex2bin($key)][hex2bin($key2)][hex2bin($key4)] = $val4;
                      }
                                        }
                                    }
                                }
                            } else {
                                $dataUser[hex2bin($key)][hex2bin($key2)] = $val2;
                            }
                        }
                    } else {
                        $dataUser[hex2bin($key)] = $val;
                    }
                } else {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if (is_object($val2)) {
                                foreach ($val2 as $key3 => $val3) {
                                    $dataUser[hex2bin($key)][($key2)][hex2bin($key3)] = $val3;
                                }
                            }
                        }
                    }
                }
            }
        }

        // dd($dataUser);


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
        $json = json_decode($resDeposit);

        $dataDeposit = [];
        foreach ($json as $key => $val) {
            if (is_object($json)) {
                if (hex2bin($key) !== 'user_group' && hex2bin($key) !== 'banks_name' && hex2bin($key) !== 'admins') {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if ($key === '7472616e73616374696f6e73') {
                                $dataDeposit[hex2bin($key)][hex2bin($key2)] = $val2;
                                // $transactions[hex2bin($key2)] = $val2;
                            } elseif ($key === '7365727669636573') {
                                if (is_object($val2)) {
                                    foreach ($val2 as $key3 => $val3) {
                                        $dataDeposit[hex2bin($key)][hex2bin($key2)][hex2bin($key3)] = $val3;
                                    }
                                }
                            }
                        }
                    } else {
                        $dataDeposit[hex2bin($key)] = $val;
                    }
                } else {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if (is_object($val2)) {
                                foreach ($val2 as $key3 => $val3) {
                                    $dataDeposit[hex2bin($key)][($key2)][hex2bin($key3)] = $val3;
                                }
                            }
                        }
                    }
                }
            }
        }
        // dd($dataDeposit);

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

        $json = json_decode($resWithdraw);
        // dd($json);

        $dataWithdraw = [];
        foreach ($json as $key => $val) {
            if (is_object($json)) {
                if (hex2bin($key) !== 'user_group' && hex2bin($key) !== 'admins') {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if ($key === '7472616e73616374696f6e73') {
                                $dataWithdraw[hex2bin($key)][hex2bin($key2)] = $val2;
                            } elseif ($key === '7365727669636573') {
                                if (is_object($val2)) {
                                    foreach ($val2 as $key3 => $val3) {
                                        $dataWithdraw[hex2bin($key)][hex2bin($key2)][hex2bin($key3)] = $val3;
                                    }
                                }
                            }
                        }
                    } else {
                        $dataWithdraw[hex2bin($key)] = $val;
                    }
                } else {
                    if (is_object($val)) {
                        foreach ($val as $key2 => $val2) {
                            if (is_object($val2)) {
                                foreach ($val2 as $key3 => $val3) {
                                    $dataWithdraw[hex2bin($key)][($key2)][hex2bin($key3)] = $val3;
                                }
                            }
                        }
                    }
                }
            }
        }

        // dd($dataWithdraw);
    }
}
