<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use DB;

class AirlinesController extends Controller
{
    public function index()
    {
        $items = Airline::all();

        return response()->json([
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $item = new Airline();

            $item->name = $request->name;
            $item->code = $request->code;
            
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

    public function update(Request $request, Airline $airline)
    {
        try {
            DB::beginTransaction();
            
            $airline->name = $request->name;
            $airline->code = $request->code;

            if(!$airline->save()){
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

    public function destroy(Airline $airline)
    {
        try {
            DB::beginTransaction();
            
            if (! $airline->delete() ) {
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
