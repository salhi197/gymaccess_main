<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Presence;
use App\Models\Entre;

class CheckSpeedFaceSubscription extends Command
{
    protected $signature = 'check:speedface-subscription';
    protected $description = 'Check scanned face IDs in SpeedFace database and validate subscriptions';

    public function handle()
    {
        try {
            // Fetch the latest scanned faces from the SpeedFace SQLite database
            $faceData = DB::connection('speedface')
                ->table('scanned_faces') // Adjust table name
                ->latest('timestamp')   // Adjust timestamp column
                ->get();

            foreach ($faceData as $entry) {
                $faceId = $entry->face_id; // Adjust column name to match database
                $rfid = $entry->rfid; // Assuming there's an RFID or unique identifier

                // Check if the face ID has a valid subscription in the app's database
                $inscription = DB::table('inscriptions')
                    ->where('face_id', $faceId)
                    ->where('valid_until', '>=', now())
                    ->first();

                if ($inscription) {
                    // Call logic for valid subscription
                    $this->handleValidSubscription($inscription, $faceId, $rfid);
                } else {
                    Log::info("No valid subscription found for Face ID: {$faceId}");
                }
            }
        } catch (\Throwable $th) {
            Log::error("Error processing SpeedFace data: " . $th->getMessage());
        }
    }

    private function handleValidSubscription($inscription, $faceId, $rfid)
    {
        try {
            // Open the door via HTTP request
            $response = Http::get("http://192.168.0.177/open");
            if (!$response->successful()) {
                Log::error("Failed to open the door for Face ID {$faceId}: " . $response->body());
                return;
            }

            // Create a new presence record
            $presence = new Presence();
            $presence->inscription = $inscription->id;
            $presence->membre = $inscription->membre_id; // Adjust member ID field
            $presence->save();

            // Decrement remaining entries
            DB::table('inscriptions')
                ->where('id', $inscription->id)
                ->update(['reste' => DB::raw('reste - 1')]);

            // Log entry if not a permanent subscription
            if ($inscription->abonnement != 1) {
                $entry = new Entre();
                $entry->matricule = $rfid;
                $entry->save();

                // Append to log file
                Storage::append('logs2.txt', $rfid);
            }

            Log::info("Successfully processed Face ID {$faceId}.");
        } catch (\Throwable $th) {
            Log::error("Error handling valid subscription for Face ID {$faceId}: " . $th->getMessage());
        }
    }
}
