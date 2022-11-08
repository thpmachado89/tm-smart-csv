<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessCsv;
use App\Models\Upload;
use App\Http\Controllers\ClientController;
   
class FileController extends Controller
{

    protected $clientController;

    function __construct(ClientController $clientController){
        
        $this->clientController = $clientController;

    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Request $request)
    {

        if ($request->file('file')!=null){

            $fileName = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload'), $fileName);

            Upload::create([
                "filename"=>$fileName,
                "status"=>"Aguardando",
                "userId"=>$request->user()->id
            ]);

            $upload = Upload::orderByDesc('id')->first();

            ProcessCsv::dispatch();
                  
            return response()->json(['success'=>true,'message'=>'Arquivo enviado com sucesso!', 'uploadId'=>$upload->id]);

        }
    }
}