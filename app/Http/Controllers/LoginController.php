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

        $login = 'https://oplbo.com/auth/login';
        $cookie = '../public/cookie/' . session()->getId() . '.txt';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $login);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie);
        $response = curl_exec($ch);
        // dd($response);

        $dom = new DOMDocument($response);
        $libxml_previous_state = libxml_use_internal_errors(true);
        $dom->loadHTML($response);
        libxml_use_internal_errors($libxml_previous_state);
        $tags = $dom->getElementsByTagName(('meta'));

        for ($i = 0; $i < $tags->length; $i++) {
            $grab = $tags->item($i);
            if ($grab->getAttribute('name') === 'csrf-token') {
                $token = $grab->getAttribute('content');
            }
        }
        // // dd($token);

        // curl_close($ch);

        $data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            '_token' => $token
        );

        curl_setopt($ch, CURLOPT_URL, $login);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE,  $cookie);
        $res = curl_exec($ch);
        curl_close($ch);
        // echo $hasil;
        dd($res);
        // return view('admin/dashboard', compact('res'));




        // // login
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $origin);
        // curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_REFERER, $login);
        // $res = curl_exec($ch);
        // dd($res);
        // curl_close($ch);
    }
}
