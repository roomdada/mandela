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
        $categories = Categorie::all();
        return $this->sendResponse(JsonResource::collection($categories), 'Afficher.');
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
        $categories = Categorie::create($input);
        return $this->sendResponse(new JsonResource($categories), 'Enregistre.');
    }


    public function show($id)
    {
        $categories = Categorie::find($id);
        if (is_null($categories)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new JsonResource($categories), 'Afficher par id.');
    }


    public function update(Request $request, Categorie $categories)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'non_categorie' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors(), "erreur");
        }
        $categories->nom_categorie_ = $input['nom_categorie'];
        $categories->description = $input['description'];
        $categories->save();

        return $this->sendResponse(new JsonResource($categories), 'Modifier.');
    }

    public function destroy(Categorie $categories)
    {
        $categories->delete();
        return $this->sendResponse(new JsonResource($categories), 'Supprimer.');

    }
}
