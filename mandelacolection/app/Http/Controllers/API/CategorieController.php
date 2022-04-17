<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Categorie;
use App\Http\Resources\categorie as JsonResource;

class CategorieController extends BaseController
{

    public function index()
    {
        $categorie = Categorie::all();
        return $this->sendResponse(JsonResource::collection($categorie), 'Afficher.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nom_categorie' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $categorie = Categorie::create($input);
        return $this->sendResponse(new JsonResource($categorie), 'Enregistre.');
    }


    public function show($id)
    {
        $categorie = Categorie::find($id);
        if (is_null($categorie)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new JsonResource($categorie), 'Afficher par id.');
    }


    public function update(Request $request, Categorie $categorie)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'non_categorie' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors(), "erreur");
        }
        $categorie->nom_categorie_ = $input['nom_categorie'];
        $categorie->description = $input['description'];
        $categorie->save();

        return $this->sendResponse(new JsonResource($categorie), 'Modifier.');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return $this->sendResponse(new JsonResource($categorie), 'Supprimer.');

    }
}
