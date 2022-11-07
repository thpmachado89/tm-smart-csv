<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Carbon\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        $errors = $this->validateClient($data);
        if(!$errors){
            $dataSanitized = $this->sanitizeClient($data);
            if(!Client::where('document', $dataSanitized["document"])->first()){
                Client::create(
                    $dataSanitized
                );
            } else {
                $errors[] = Array("field"=>"document","message"=>"The document already exists");
                return $errors;
            }
        }
    }

    public function sanitizeClient($data){
        $arrDate = explode("/", $data["start_date"]);
        $data["start_date"] = preg_replace('/[^0-9]/','', $arrDate[2])."-".preg_replace('/[^0-9]/','', $arrDate[1])."-".preg_replace('/[^0-9]/','', $arrDate[0]);
        $data["document"] = preg_replace('/[^0-9]/','', $data["document"]);
        $data["name"] = utf8_decode($data["name"]);
        $data["city"] = utf8_decode($data["city"]);
        return $data;
    }

    public function validateRequired($data){

        $required = Array(
            "name",
            "email",
            "document",
            "city",
            "state",
            "start_date"
        );

        $errors = [];
        
        foreach($required as $field){
            
            if(!$data[$field]){
                
                $errors[] = Array("field"=>$field,"message"=>"is empty");
            
            }

        }

        if($errors){
            
            return $errors;

        } else {

            return false;

        }

    }

    public function validateClient($data){

        $validateRequired = $this->validateRequired($data);
        $errors = [];
        if($validateRequired){
            $errors = array_merge($errors, $validateRequired); 
        }

        if($errors){
            return $errors;
        } else {
            return false;
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
