<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\client as JsonResource;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return $this->sendResponse(JsonResource::collection($client), 'Afficher.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
            $validator = Validator::make($input, [
            'nom_client' => 'required',
            'prenom_client' => 'required',
            'adresse' => 'required',
            'contact' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $client = Client::create($input);
            return $this->sendResponse(new JsonResource($client), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
        return $this->sendError('aucun client.');
        }
        return $this->sendResponse(new JsonResource($client), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nom_client' => 'required',
            'prenom_client' => 'required',
            'adresse' => 'required',
            'contact' => 'required'
            ]);
            if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            }
            $client->nom_client = $input['nom_client'];
            $client->prenom_client = $input['prenom_client'];
            $client->adresse = $input['adresse'];
            $client->contact = $input['contact'];
            $client->save();
            return $this->sendResponse(new JsonResource($client), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return $this->sendResponse(new JsonResource($client), 'Supprimer.');
    }
}
