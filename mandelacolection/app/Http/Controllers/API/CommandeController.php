<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Resources\commande as JsonResource;

class CommandeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commande = Commande::all();
        return $this->sendResponse(JsonResource::collection($commande), 'Afficher.');
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
            'article_id' => 'required',
            'quantite' => 'required',
            'prix_total' => 'required',
            'date_commande' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $commande = Commande::create($input);
            return $this->sendResponse(new JsonResource($commande), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::find($id);
        if (is_null($commande)) {
        return $this->sendError('aucune commande.');
        }
        return $this->sendResponse(new JsonResource($commande), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, commande $commande)
    {
        $input = $request->all();
            $validator = Validator::make($input, [
            'article_id' => 'required',
            'quantite' => 'required',
            'prix_total' => 'required',
            'date_commande' => 'required',
            ]);
            if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            }
            $commande->article_id = $input['article_id'];
            $commande->quantite = $input['quantite'];
            $commande->prix_total = $input['prix_total'];
            $commande->date_commande = $input['date_commande'];
            $commande->save();
            return $this->sendResponse(new JsonResource($commande), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , commande $commande)
    {
        $commande->delete();
        return $this->sendResponse(new JsonResource($commande), 'Supprimer.');
    }
}
