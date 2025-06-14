<?php

namespace App\Http\Controllers;

use App\Http\Logics\PaginationLogic;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
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

        $fields = DB::table('fields')->orderBy('fieldName', 'ASC');

        if($search != ''){
            $fields->where('fieldName', 'LIKE', '%'.$search.'%');
        }

        $query = $fields->get();

        $pagination = (new PaginationLogic)->paginateData($query, $paginationRequest);

        return response()->json($pagination);
    }

    public function getById(Request $request)
    {
        $field = DB::table('fields')
                ->where('fieldId', '=', $request->fieldId)
                ->first();
        if(!$field){
            return response()->json('Field not found', 404);
        }
        return response()->json($field);
    }

    public function create(Request $request)
    {
        Field::create([
            "fieldName" => $request->fieldName
        ]);

        return response()->json('field created successfully');
    }

    public function update(Request $request, string $id)
    {
        DB::table('fields')
                ->where('fieldId', '=', $request->fieldId)
                ->update([
                    "fieldName" => $request->fieldName
                ]);

        return response()->json('field updated successfully');
    }

    public function delete(Request $request)
    {
        DB::table('fields')
                ->where('fieldId', '=', $request->fieldId)
                ->delete();

        return response()->json('field deleted successfully');
    }
}
