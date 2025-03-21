<?php

namespace App\Services;

use App\Repositories\LinkRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\RegisterRequest;

/**
 * Service class for managing links.
 */
class LinkService
{
   /**
     * The link repository instance.
     *
     * @var LinkRepository
     */
    private linkRepository $linkRepository;

    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    private userRepository $userRepository;

   /**
     * Create a new instance of the service.
     *
     * @param LinkRepository $linkRepository
     * @param UserRepository $userRepository
     */
    public function __construct(LinkRepository $linkRepository, UserRepository $userRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->userRepository = $userRepository;
    }

    public function generateNewToken(string $oldToken): string
    {
        $newToken = $this->generateToken();
        $this->linkRepository->refreshToken($oldToken, $newToken);
        return $newToken;
    }

   /**
     * Find a link by the given token.
     *
     * @param string $token
     * @return \App\Models\Link
     */
    public function findLinkByToken(string $token)
    {
        return $this->linkRepository->findByToken($token);
    }

   /**
     * Delete a link by the given token.
     *
     * @param string $token
     * @return void
     */
    public function deleteLinkByToken(string $token): void
    {
        $this->linkRepository->deleteByToken($token);
    }

    /**
     * Creates a link for the user based on the registration request.
     *
     * @param RegisterRequest $request The registration request containing user details.
     * @return string
     */
    public function getCreatedLinkToken(RegisterRequest $request): string
    {
        $user = $this->userRepository->create($request->username, $request->phonenumber);

        if (!$user) {
            throw new \Exception('User creation failed.');
        }

        $token = $this->generateToken();
        $this->linkRepository->createLink($user->id, $token);
        return $token;
    }

    /**
     * Generates a new token.
     *
     * @return string
     */
    private function generateToken(): string
    {
        return bin2hex(random_bytes(8));
    }
}
