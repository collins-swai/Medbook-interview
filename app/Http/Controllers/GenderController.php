<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::all();

        return response()->json($genders);
    }

    public function show($id)
    {
        $gender = Gender::find($id);

        if (!$gender) {
            return response()->json(['error' => 'Gender not found.'], 404);
        }

        return response()->json($gender);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:genders',
        ]);

        $gender = new Gender();
        $gender->name = $request->input('name');
        $gender->save();

        return response()->json($gender, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:genders,name,' . $id,
        ]);

        $gender = Gender::find($id);

        if (!$gender) {
            return response()->json(['error' => 'Gender not found.'], 404);
        }

        $gender->name = $request->input('name');
        $gender->save();

        return response()->json($gender);
    }

    public function destroy($id)
    {
        $gender = Gender::find($id);

        if (!$gender) {
            return response()->json(['error' => 'Gender not found.'], 404);
        }

        $gender->delete();

        return response()->json(['message' => 'Gender deleted successfully.']);
    }
}
