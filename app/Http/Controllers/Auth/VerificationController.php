<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 所有的控制器操作都必须登录后才能访问
        $this->middleware('auth');
        // signed: url 签名认证方式
        $this->middleware('signed')->only('verify');
        // throttle 中间件：访问频率限制功能，接收两个参数，决定了在给定的分钟数内可以进行的最大请求数
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
