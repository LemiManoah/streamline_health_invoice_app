<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ClientVerificationController extends Controller
{
    /**
     * Verify the client's email using a custom token.
     */
    public function verify($token): RedirectResponse
    {
        $client = Client::where('verification_token', $token)->first();

        if (!$client) {
            return redirect()->route('clients.index')->with('error', 'Invalid verification link.');
        }

        if ($client->hasVerifiedEmail()) {
            return redirect()->route('clients.index')->with('message', 'Email already verified.');
        }

        // Mark the email as verified
        $client->update([
            'email_verified_at' => now(),
            'verification_status' => 'verified',
            'verification_token' => null, // Clear the token
        ]);

        return redirect()->route('clients.index')->with('message', 'Email verified successfully!');
    }
}
