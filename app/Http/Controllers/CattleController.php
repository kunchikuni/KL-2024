<?php

namespace App\Http\Controllers;

use App\Models\Cattle;
use Illuminate\Http\Request;
use App\Http\Requests\CattleRequest;

class CattleController extends Controller
{
    public function index()
    {
        //URL /cattle/view
        return Inertia::render('Cattle/Index', [
            'page' => 'Cattle Index',
            'cattle' => Cattle::all()
        ]);
    }

    public function showOneView($id)
    {
        //URL /cattle/view/{id}
        $cattle = Cattle::find($id);


        //RETURN THE CATTLE PAGE IF FOUDN
        if ($cattle) {
            return Inertia::render('Cattle/[Id]', [
                'page' => "Cattle ID:$id",
                'cattle' => $cattle
            ]);
        } //RETURN THE ERROR PAGE WITH A MESSAGE IF NOT FOUND
        else {
            return Inertia::render('Error', [
                'page' => "404 Not Found",
                'message' => "The requested id: $id was not found",
            ]);
        }

    }
        public function search(Cattle $request)
    {

        $cattleId = $request->input();
        $cattle = Cattle::find($cattle);
      //$cattle = Cattle::where('breed', 'like', '%'.$breed.'%', 'tagId', $tagId, 'coatColor', 'like', '%'.$coatColor.'%')->get();

        if (input(preg_match('tagId', 'type', 'breed', 'coatColor', 'sex'))) {
            return Inertia::render('Cattle/[Id]', [
                'page' => "Cattle :$cattle",
                'cattle' => $cattle
            ]);
        }
        Inertia::render('Error', [
            'page' => "404 Not Found",
            'message' => "The requested cattle: $cattleId was not found",
        ]);
        dd($cattle);

    }

    public function createView()
    {
        //URL /cattle/view
        return Inertia::render('Cattle/CreateNew', [
            'page' => 'Create New Livestock',
        ]);
    }

    public function createWrite(CattleRequest $request)
    {
        $cattle = Cattle::create($request->validated());

        return response([
            'status' => 'success',
            'message' => "Livestock with tag Id:$cattle->tagId saved to database.",
            'payload' => $cattle
        ], 201);
    }

    public function updateView($id)
    {
        //URL /cattle/view/{id}
        $cattle = Cattle::find($id);


        //RETURN THE CATTLE PAGE IF FOUND
        if ($cattle) {
            return Inertia::render('Cattle/Edit', [
                'page' => 'Edit Livestock',
                'cattle' => $cattle
            ]);
        } //RETURN THE ERROR PAGE WITH A MESSAGE IF NOT FOUND
        else {
            return Inertia::render('Error', [
                'page' => "404 Not Found",
                'message' => "The requested id: $id was not found",
            ]);
        }
    }

    public function updateWrite(CattleRequest $request, $id)
    {
        $updatedCattle = $request->validated();

        //URL /cattle/view/{id}
        $cattle = Cattle::find($id);

        //RETURN THE CATTLE PAGE IF FOUND
        if ($cattle) {

            unset($updatedCattle['id']);
            $cattle->update($updatedCattle);
            return response([
                'status' => 'success',
                'message' => "Livestock with tag Id:$cattle->tagId updated",
                'payload' => $cattle
            ], 201);

        }

        return response([
            'status' => 'fail',
            'message' => "Livestock is no longer active in database",
        ], 404);
    }

    public function delete($id)
    {
        //URL /cattle/view/{id}
        $cattle = Cattle::find($id);

        //RETURN THE CATTLE PAGE IF FOUND
        if ($cattle) {
            $cattle->delete();
            return response([
                'status' => 'success',
                'message' => "Livestock with tag Id:$cattle->tagId has been deleted",
            ], 200);

        }

        return response([
            'status' => 'fail',
            'message' => "Livestock not found in database",
        ], 404);
    }

}
