<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use DB;

class AirportsController extends Controller
{
    public function index()
    {
        $items = Airport::all();

        return response()->json([
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $item = new Airport();

            $item->name = $request->name;
            $item->code = $request->code;
            $item->city = $request->city;
            
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

    public function update(Request $request, Airport $airport)
    {
        try {
            DB::beginTransaction();
            
            $airport->name = $request->name;
            $airport->code = $request->code;
            $airport->city = $request->city;

            if(!$airport->save()){
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

    public function destroy(Airport $airport)
    {
        try {
            DB::beginTransaction();
            
            if (! $airport->delete() ) {
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
