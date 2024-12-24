<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoiceCommandController extends Controller
{
    public function handleCommand(Request $request)
    {
        $command = strtolower($request->command);
        $redirectUrl = '';

        // Match the command to the appropriate URL
        switch ($command) {
            case 'open':
                $redirectUrl = 'http://192.168.0.177/open';
                break;
            case 'close':
                $redirectUrl = 'http://192.168.0.177/close';
                break;
            case 'liste membres':
                $redirectUrl = url('/membre');
                break;
            case 'ajouter membre':
                $redirectUrl = url('/membre/create');
                break;
            case 'vider la liste':
                $redirectUrl = url('/clear');
                break;
            default:
                // Optionally return an error if the command is unrecognized
                $redirectUrl = url('/'); // or some error route
        }

        // Return the URL to redirect to
        return response()->json(['redirect_url' => $redirectUrl]);
    }
}
