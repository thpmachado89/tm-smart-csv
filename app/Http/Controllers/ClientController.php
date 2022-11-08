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
        $line = $data["line"];
        unset($data["line"]);
        $errors = $this->validateClient($data, $line);
        $errors[] = $this->validateDate($data, $line);
        $dataSanitized = $this->sanitizeClient($data);
        $errors[] = $this->validateDocument($data, $line);
        if(is_array($errors)){
            if(count($errors) > 0){
                if(!is_array(current($errors))){
                    $errors = array_unique(@$errors);
                    if(!$errors[0]){
                        $errors = [];
                    }
                }
            }
        }
        if(!$errors){
            if(!Client::where('document', $dataSanitized["document"])->first()){
                Client::create(
                    $dataSanitized
                );
            } else {
                $errors[] = Array("field"=>"document","message"=>"The document already exists","line"=>$line);
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    public function validateDate($data, $line){
        if(!$this->validaData($data["start_date"])){
            return Array("field"=>"start_date","message"=>"Start Date is invalid","line"=>$line);
        }
    }
    
    public function validaData($start_date){

        $start_date_arr = explode("/", $start_date);
        
        if(count($start_date_arr) == 3){
            if(checkdate($start_date_arr[1], $start_date_arr[0], $start_date_arr[2])){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function validateDocument($data, $line){
        if(!$this->validaCPF($data["document"])){
            return Array("field"=>"document","message"=>"Document is invalid","line"=>$line);
        }
    }

    function validaCPF($cpf) {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }

    public function sanitizeClient($data){
        $arrDate = explode("/", $data["start_date"]);
        if($data["start_date"]){
            if(count($arrDate) == 3){
                if($arrDate[0] && $arrDate[1] && $arrDate[2]){
                    $data["start_date"] = preg_replace('/[^0-9]/','', $arrDate[2])."-".preg_replace('/[^0-9]/','', $arrDate[1])."-".preg_replace('/[^0-9]/','', $arrDate[0]);
                }
            }
        }
        $data["document"] = preg_replace('/[^0-9]/','', $data["document"]);
        $data["name"] = utf8_encode($data["name"]);
        $data["city"] = utf8_encode($data["city"]);
        return $data;
    }

    public function validateRequired($data, $line){

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
                
                $errors[] = Array("field"=>$field,"message"=>"is empty","line"=>$line);
            
            }

        }

        if($errors){
            
            return $errors;

        } else {

            return false;

        }

    }

    public function validateClient($data, $line){

        $validateRequired = $this->validateRequired($data, $line);
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
