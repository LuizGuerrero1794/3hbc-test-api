<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Exception;
use Illuminate\Http\Request;
use DB;

class FlightsController extends Controller
{
    public function index()
    {
        $items = Flight::all();
        
        $items->load('airline');

        return response()->json([
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $item = new Flight();

            $item->code = $request->code;
            $item->type = $request->type;
            $item->arrival_time = $request->arrival_time;
            $item->departure_time = $request->departure_time;
            $item->airline_id = $request->airline_id;
            
            if(!$item->save()){
                throw new Exception('ERROR AL INTENTAR GUARDAR');
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'msg' => 'SE AGREGO CORRECTAMENTE'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, Flight $flight)
    {
        try {
            DB::beginTransaction();
            
            $flight->code = $request->code;
            $flight->type = $request->type;
            $flight->arrival_time = $request->arrival_time;
            $flight->departure_time = $request->departure_time;
            $flight->airline_id = $request->airline_id;

            if(!$flight->save()){
                throw new Exception('ERROR AL INTENTAR ACTUALIZAR');
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'msg' => 'SE ACTUALIZO CORRECTAMENTE'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Flight $flight)
    {
        try {
            DB::beginTransaction();
            
            if (! $flight->delete() ) {
                return response()->json([
                    'success' => false, 
                    'message' => 'ERROR AL ELIMINAR EL REGISTRO!'
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'SE ELIMINÓ CORRECTAMENTE EL REGISTRO'
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'msg' => $e->getMessage()
            ], 201);
        }
    }
}
