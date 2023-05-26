<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return response()->json($services);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        return response()->json($service);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:services',
        ]);

        $service = new Service();
        $service->name = $request->input('name');
        $service->save();

        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:services,name,' . $id,
        ]);

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        $service->name = $request->input('name');
        $service->save();

        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully.']);
    }
}
