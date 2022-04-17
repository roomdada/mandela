<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Resources\article as JsonResource;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::all();
        return $this->sendResponse(JsonResource::collection($articles), 'Afficher.');
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
            'categorie_id' => 'required',
            'nom_article' => 'required',
            'descrip_article' => 'required',
            'prix_article' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $articles = Articles::create($input);
            return $this->sendResponse(new JsonResource($articles), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Articles::find($id);
            if (is_null($articles)) {
            return $this->sendError('aucun article.');
            }
            return $this->sendResponse(new JsonResource($articles), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $articles)
    {
        $input = $request->all();
            $validator = Validator::make($input, [
                'categorie_id' => 'required',
                'nom_article' => 'required',
                'descrip_article' => 'required',
                'prix_article' => 'required',
            ]);
            if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            }
            $articles->categorie_id = $input['name'];
            $articles->nom_article = $input['detail'];
            $articles->descrip_article = $input['descrip_article'];
            $articles->prix_article = $input['prix_article'];
            $articles->save();
            return $this->sendResponse(new JsonResource($articles), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {
        $articles->delete();
        return $this->sendResponse(new JsonResource($articles), 'Supprimer.');
    }
}
