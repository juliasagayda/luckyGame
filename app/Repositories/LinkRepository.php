<?php

namespace App\Repositories;

use App\Models\Link;
use Carbon\Carbon;

class LinkRepository
{
    /**
     * Find a link by the given token.
     *
     * @param string $token
     * @return \App\Models\Link
     */
    public function findByToken(string $token): ?Link
    {
        return Link::where('token', $token)->active()->firstOrFail();
    }

   /**
     * Delete a link by the given token.
     *
     * @param string $token
     */
    public function deleteByToken(string $token): void
    {
        Link::where('token', $token)->delete();
    }

   /**
     * Create a new link for the given user.
     *
     * @param int $userId
     * @param string $token
     * @return \App\Models\Link
     */
    public function createLink(int $userId, string $token): Link
    {
        return Link::create([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => Carbon::now()->addDays(7),
        ]);
    }

   /**
     * Refresh the token.
     *
     * @param string $oldToken
     * @param string $newToken
     * @return void
     */
    public function refreshToken(string $oldToken, string $newToken): void
    {
        $link = Link::where('token', $oldToken)->firstOrFail();
        $link->update(['token' => $newToken, 'expires_at' => Carbon::now()->addDays(7)]);
    }   
}
