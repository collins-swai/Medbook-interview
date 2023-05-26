<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();

        return response()->json($patients);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found.'], 404);
        }

        return response()->json($patient);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->gender_id = $request->input('gender_id');
        $patient->service_id = $request->input('service_id');
        $patient->save();

        return response()->json($patient, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found.'], 404);
        }

        $patient->name = $request->input('name');
        $patient->gender_id = $request->input('gender_id');
        $patient->service_id = $request->input('service_id');
        $patient->save();

        return response()->json($patient);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found.'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully.']);
    }
}
