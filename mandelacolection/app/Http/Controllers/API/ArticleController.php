<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Article;
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
        $article = Article::all();
        return $this->sendResponse(JsonResource::collection($article), 'Afficher.');
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
            $article = Article::create($input);
            return $this->sendResponse(new JsonResource($article), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
            if (is_null($article)) {
            return $this->sendError('aucun article.');
            }
            return $this->sendResponse(new JsonResource($article), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
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
            $article->categorie_id = $input['name'];
            $article->nom_article = $input['detail'];
            $article->descrip_article = $input['descrip_article'];
            $article->prix_article = $input['prix_article'];
            $article->save();
            return $this->sendResponse(new JsonResource($article), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return $this->sendResponse(new JsonResource($article), 'Supprimer.');
    }
}
