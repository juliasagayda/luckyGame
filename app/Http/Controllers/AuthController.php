<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LinkService;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(LinkService $linkService)
    {
        parent::__construct($linkService);
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(Request $request)
    {
        if (session()->has('token')) {
            $message =  request()->has('message') ? request('message') : 'You already have this link';
            
            return view('register', [
                'message' => $message,
                'link' => url("/page/" . session('token')),
            ]);

        } else {
            return view('register', [
                'message' => 'Generate your unique link to the secret lucky page',
            ]);
        }
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        try {
            $token = $this->linkService->getCreatedLinkToken($request);

            session(['token' => $token]);

            return view('register', [
                'message' => 'Generate your unique link to the secret lucky page',
                'link' => url("/page/$token"),
            ]);

        } catch (\Exception $e) {
        return redirect()->route('register.form')
            ->with('error', 'Unexpected error: ' . $e->getMessage())
            ->withInput();
        }
    }
}
