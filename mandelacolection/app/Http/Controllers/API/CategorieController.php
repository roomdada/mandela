<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\categories;
use App\Http\Resources\categories as JsonResource;

class CategorieController extends BaseController
{

    public function index()
    {
        $categories = categories::all();
        return $this->sendResponse(JsonResource::collection($categories), 'Afficher.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nomcategorie' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $categories = categories::create($input);
        return $this->sendResponse(new JsonResource($categories), 'Enregistre.');
    }


    public function show($id)
    {
        $categories = categories::find($id);
        if (is_null($categories)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new JsonResource($categories), 'Afficher par id.');
    }


    public function update(Request $request, categories $categories)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nomcategorie' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $categories->categorie = $input['nomcategorie'];
        $categories->description = $input['description'];
        $categories->save();

        return $this->sendResponse(new JsonResource($categories), 'Modifier.');
    }

    public function destroy($id)
    {
        $categories = categories::find($id);
        if (is_null($categories)) {
            return $this->sendError('Post does not exist.');
        }
        $categorie = $categories->nomcategorie;
        $descrip = $categories->description;

        if(is_null($categorie) or is_null($descrip)){
            return $this->sendError("attribu vide");
        }
        $categories->categorie = $categorie;
        $categories->description = $descrip;
        $categories->active = 0;
        $categories->save();

        return $this->sendResponse(new JsonResource($categories), 'Supprimer.');

    }
}
