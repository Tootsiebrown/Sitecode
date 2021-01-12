<?php

namespace App\Http\Controllers\Dashboard;

use App\Ebay\EbayTokenRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;

class EbayOAuthController extends Controller
{
    /** @var EbayTokenRepository */
    private EbayTokenRepository $tokenRepo;

    public function __construct(EbayTokenRepository $tokenRepo)
    {
        $this->tokenRepo = $tokenRepo;
    }

    public function showStatus()
    {
        return view('dashboard.ebay-auth.index', [
            'linkStatus' => $this->tokenRepo->linkStatus(),
            'tokenStatus' => $this->tokenRepo->tokenStatus(),
            'refreshTokenStatus' => $this->tokenRepo->refreshTokenStatus(),
        ]);
    }

    public function initiateLink()
    {
        return Socialite::driver('ebay')->redirect();
    }

    public function link()
    {
        $response = Socialite::driver('ebay')->getAccessTokenResponse(
            Socialite::driver('ebay')->getTheCode()
        );

        $this->tokenRepo->save(
            $response['access_token'],
            Carbon::now()->addSeconds($response['expires_in']),
            $response['refresh_token'],
            Carbon::now()->addSeconds($response['refresh_token_expires_in'])
        );

        return redirect()->route('dashboard.ebayAuth.status');
    }
}
