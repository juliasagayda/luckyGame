<?php

namespace App\Repositories;

use App\Models\LuckyResult;
use App\Models\Link;


class LuckyRepository
{
    /**
     *  Create a new lucky result.
     *
     * @param array $preparedData
     * @param \App\Models\Link $link
     * @return void
     */
    public function createLuckyResult(array $preparedData, Link $link): void
    {
        LuckyResult::create([
            'link_id' => $link->id ?? null,
            'number' => $preparedData['number'] ?? 0,
            'result' => $preparedData['result'] ?? '',
            'win_amount' => $preparedData['winAmount'] ?? 0,
        ]);
    }

    /**
     *  Get the history of lucky results for a given link.
     *
     * @param \App\Models\Link $link
     * @param int $recordLimit
     * @param string $orderBy
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHistory($link, int $recordLimit = 3, string $orderBy = 'desc') 
    {
        return LuckyResult::where('link_id', $link->id)->orderBy('created_at', $orderBy)->limit($recordLimit)->get();
    }
}
