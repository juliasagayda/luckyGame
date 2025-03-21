<?php

namespace App\Http\Controllers;

use App\Services\LinkService;
use App\Services\LuckyService;

/**
 * Controller class for managing pages.
 */
class PageController extends Controller
{
    /**
     * The link service instance.
     *
     * @var LuckyService
     */
    private LuckyService $luckyService;

    /**
     * Create a new instance of the controller.
     *
     * @param LinkService $linkService
     * @param LuckyService $luckyService
     */
    public function __construct(LinkService $linkService, LuckyService $luckyService)
    {
        $this->luckyService = $luckyService;
        parent::__construct($linkService);
    }

    /**
     * Display the specified page.
     *
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function showPage(string $token)
    {
        $link = $this->linkService->findLinkByToken(session('token'));
        return view('page.show', compact('link'));
    }

    /**
     * Generate a new link.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateLink(string $token)
    {
        try {
            $newToken = $this->linkService->generateNewToken($token);

            session(['token' => $newToken]);

            return redirect()->route('register.form')->with('message',
            'Your link was regenerated successfully. Please copy it and save it somewhere safe.');
        } catch (\Exception $e) {
            return redirect()->route('register.form')
                ->with('error', 'Unexpected error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Deactivate the link.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateLink(string $token)
    {
        $this->linkService->deleteLinkByToken($token);

        if (session()->has('token')) {
            session()->forget('token');
        }

        return redirect()->route('register.form')->with('message', 'Link deactivated successfully. You can generate a new one.');
    }

    /**
     * Generate a lucky result.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function feelingLucky(string $token)
    {
        $gameResult = $this->luckyService->runLuckyGame($token);

        return back()->with([
            'message' => "Lucky result generated!",
            'result' => $gameResult['result'],
            'number' => $gameResult['number'],
            'win_amount' => $gameResult['winAmount']
        ]);
    }

   /**
     * Display the history of the lucky results.
     *
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function history(string $token)
    {
        try {
            $history = $this->luckyService->getGamesHistory($token);
            return view('page.history', compact('history'));
        } catch (\Exception $e) {
            return redirect()->route('register.form')
                ->with('error', 'Unexpected error: ' . $e->getMessage())
                ->withInput();
        }
    }
}
