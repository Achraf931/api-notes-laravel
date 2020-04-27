<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Note;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Exception;

class NoteController extends Controller
{
    public function index()
    {
        $result = Note::orderBy('created_at', 'desc')->get();
        if (sizeof($result) === 0) {
            return response()->json(['error' => 'Nothing to get', 'notes' => $result]);
        }

        try {
            return response()->json(['notes' => $result, 'error' => null]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Nothing to get', 'notes' => $result], 404);
        }
    }

    public function store(NoteRequest $request)
    {
        try {
            return response()->json(['note' => Note::create($request->all()), 'error' => null]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Error to insert', 'note' => null], 404);
        }
    }

    public function update(NoteRequest $request, $id)
    {
        try {
            Note::findOrFail($id)->update($request->all());
            return response()->json(['note' => Note::where('id', $id)->get()->first(), 'error' => null]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cet identifiant est inconnu', 'note' => null], 404);
        }
    }

    public function show($id)
    {
        try {
            return response()->json(['note' => Note::findOrFail($id), 'error' => null]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Cet identifiant est inconnu', 'note' => null], 404);
        }
    }

    public function destroy($id)
    {
        try {
            Note::findOrFail($id)->delete();
            return response()->json(['error' => null]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Cet identifiant est inconnu', 'note' => null], 404);
        }
    }
}
