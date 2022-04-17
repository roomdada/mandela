<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Panier;
use Illuminate\Http\Request;
use App\Http\Resources\panier as JsonResource;


class PanierController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panier = Panier::all();
        return $this->sendResponse(JsonResource::collection($panier), 'Afficher.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Panier $panier)
    {
        $input = $request->all();
            $validator = Validator::make($input, [
            'client_id' => 'required',
            'commande_id' => 'required',
            'lieu_commande' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $panier = Panier::create($input);
            return $this->sendResponse(new JsonResource($panier), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $panier = Panier::find($id);
        if (is_null($panier)) {
        return $this->sendError('aucun Panier.');
        }
        return $this->sendResponse(new JsonResource($panier), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Panier $panier)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'client_id' => 'required',
            'commande_id' => 'required',
            'lieu_commande' => 'required',
            ]);
            if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            }
            $panier->client_id = $input['client_id'];
            $panier->commande_id = $input['commande_id'];
            $panier->lieu_commande = $input['lieu_commande'];
            $panier->save();
            return $this->sendResponse(new JsonResource($panier), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Panier $panier)
    {
        $panier->delete();
        return $this->sendResponse(new JsonResource($panier), 'Supprimer.');
    }
}
