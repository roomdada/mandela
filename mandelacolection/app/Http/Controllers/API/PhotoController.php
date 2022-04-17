<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Resources\photo as JsonResource;

class PhotoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photo = Photo::all();
        return $this->sendResponse(JsonResource::collection($photo), 'Afficher.');
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
            'chemin' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $photo = Photo::create($input);
            return $this->sendResponse(new JsonResource($photo), 'Enregistre.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        if (is_null($photo)) {
        return $this->sendError('aucune photo.');
        }
        return $this->sendResponse(new JsonResource($photo), 'Afficher par id.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Photo $photo)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'article_id' => 'required',
            'chemin' => 'required',
            ]);
            if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            }
            $photo->article_id = $input['article_id'];
            $photo->chemin = $input['chemin'];
            $photo->save();
            return $this->sendResponse(new JsonResource($photo), 'Modifier.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return $this->sendResponse(new JsonResource($photo), 'Supprimer.');
    }
}
