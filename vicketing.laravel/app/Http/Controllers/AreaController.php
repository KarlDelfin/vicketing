<?php

namespace App\Http\Controllers;

use App\Http\Logics\PaginationLogic;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function get(Request $request)
    {
        $currentPage = $request->input('currentPage', 1);
        $elementsPerPage = $request->input('elementsPerPage', 10);
        $search = $request->input('search', '');

        $paginationRequest = [
            "currentPage" => $currentPage,
            "elementsPerPage" => $elementsPerPage,
        ];

        $areas = DB::table('areas')->orderBy('areaName', 'ASC');

        if($search != ''){
            $areas->where('areaName', 'LIKE', '%'.$search.'%');
        }

        $query = $areas->get();

        $pagination = (new PaginationLogic)->paginateData($query, $paginationRequest);

        return response()->json($pagination);
    }

    public function getById(Request $request)
    {
        $area = DB::table('areas')
                ->where('areaId', '=', $request->areaId)
                ->first();
        if(!$area){
            return response()->json('Area not found', 404);
        }
        return response()->json($area);
    }

    public function create(Request $request)
    {
        Area::create([
            "areaName" => $request->areaName
        ]);

        return response()->json('Area created successfully');
    }

    public function update(Request $request, string $id)
    {
        DB::table('areas')
                ->where('areaId', '=', $request->areaId)
                ->update([
                    "areaName" => $request->areaName
                ]);

        return response()->json('Area updated successfully');
    }

    public function delete(Request $request)
    {
        DB::table('areas')
                ->where('areaId', '=', $request->areaId)
                ->delete();

        return response()->json('Area deleted successfully');
    }
}
