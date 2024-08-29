<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Emails\VerifyClientEmail;


class ClientVerificationController extends Controller
{
public function verifyEmail($id, $hash): RedirectResponse
    {
        // Fetch the client using the provided ID
        $client = Client::findOrFail($id);
        
        // Verify the hash
        if (sha1($client->email_for_invoices) === $hash) {
            $client->email_verified_status = true;
            $client->email_verified_at = now();
            $client->save();

            return redirect()->route('clients.index')->with('success', 'Your email has been verified successfully.');
        }

        return redirect()->route('clients.index')->withErrors(['Verification Error']);
    }

}