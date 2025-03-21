<?php

namespace App\Http\Controllers;

use App\Services\LinkService;

abstract class Controller
{
    /**
     * The link service instance.
     *
     * @var LinkService
     */
    protected LinkService $linkService;

    /**
     * Create a new controller instance.
     *
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }
}
