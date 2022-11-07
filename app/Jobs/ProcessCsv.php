<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Upload;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\CsvService;
use App\Http\Controllers\ClientController;

class ProcessCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ClientController $client)
    {
        Log::info("PROCESS STARTED");

        $upload = Upload::where('status', 'Aguardando')
        ->orderByDesc('created_at')   
            ->take(1)
               ->first();

        if($upload->id){
            $csv = public_path('upload') . "/" . $upload->filename;
    
            if(!file_exists($csv)){ 
                Log::error("File ".$csv." not exists.");
            }
    
            $arrayCSV = CsvService::getArrayFromCSV($csv);
            Log::info($arrayCSV);
            foreach($arrayCSV as $data){
                $clientSaved = $client->create([
                    "name" => $data[0],
                    "email" => $data[1],
                    "document" => $data[2],
                    "city" => $data[3],
                    "state" => $data[4],
                    "start_date" => $data[5]
                ]);
            }
            /*
            foreach($arrayCSV as $data){
                $start_date = preg_replace('/[^0-9]/','', $arrdate[2])."-".preg_replace('/[^0-9]/','', $arrdate[1])."-".preg_replace('/[^0-9]/','', $arrdate[0]);
                $clientData = [
                    "name" => utf8_encode($data[0]),
                    "email" => $data[1],
                    "document" => preg_replace('/[^0-9]/','',$data[2]),
                    "city" => utf8_encode($data[3]),
                    "state" => $data[4],
                    "start_date" => $start_date
                ];
                Log::info($clientData);
                if(Client::where('document', $clientData['document'])->first()){
                    Log::info("Client Document already exists");
                } else {
                    $clientSaved = Client::create($clientData);
                    if(!$clientSaved){
                        Log::error("Error to save client.");
                    } else {
                        Log::info("Client saved success!");
                    }
                }
            }*/
            
            $upload->status = "Processado";
            $upload->save();
        }

        Log::error('PROCESS FINISHED');
    }
}
