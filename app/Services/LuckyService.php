<?php

namespace App\Services;

use App\Repositories\LuckyRepository;
use App\Repositories\LinkRepository;


class LuckyService
{
   /**
     * The lucky repository instance.
     *
     * @var LuckyRepository
     */
    private LuckyRepository $luckyRepository;

    /**
     * The link repository instance.
     *
     * @var LinkRepository
     */
    private linkRepository $linkRepository;


   /**
     * Create a new instance of the service.
     *
     * @param LuckyRepository $luckyRepository
     */
    public function __construct(LuckyRepository $luckyRepository, LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->luckyRepository = $luckyRepository;
    }

    /**
     * Run the lucky game and create a lucky result.
     *
     * @param string $token The token used for the game.
     * @return array
     */
    public function runLuckyGame(string $token): array
    {
        $link = $this->linkRepository->findByToken($token);
        $gameResult = $this->playGame();
        $this->luckyRepository->createLuckyResult($gameResult, $link);
        return $gameResult;
    }

    /**
     * Play the lucky game and determine the result.
     * @return array An associative array containing:
     *               - 'number': The generated random number.
     *               - 'result': The result of the game ('Win' or 'Lose').
     *               - 'winAmount': The amount won if the result is 'Win'.
     */
    private function playGame(): array
    {
        $number = mt_rand(1, 1000);
        $result = ($number % 2 === 0) ? 'Win' : 'Lose';
        $winAmount = $result === 'Win' ? match (true) {
            $number > 900 => $number * 0.7,
            $number > 600 => $number * 0.5,
            $number > 300 => $number * 0.3,
            default => $number * 0.1,
        } : 0;

        return [
            'number' => $number,
            'result' => $result,
            'winAmount' => $winAmount,

        ];
    }

    /**
     * Get the history of games for a given token.
     *
     * @param string $token The token used to identify the link.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesHistory(string $token)
    {
        $link = $this->linkRepository->findByToken($token);
        return $this->luckyRepository->getHistory($link);
    }
}
