<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Http\Logics\PaginationLogic;


class UserController extends Controller
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

        $users = DB::table('users')
                ->orderBy('dateTimeCreated', 'DESC')
                ->leftJoin('areas', 'users.areaId', '=', 'areas.areaId')
                ->leftJoin('fields', 'users.fieldId', '=', 'fields.fieldId')
                ->select( 'users.*',
                'areas.areaName',
                'fields.fieldName');

        if($search != ''){
            $users->where('firstName', 'LIKE', '%'.$search.'%')
                    ->orWhere('firstName', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
        }

        $query = $users
                ->get()
                ->map(function ($user) {
                    $user->image = $user->image ? asset('images/'.$user->image) : null;
                    $user->fieldName = $user->fieldName ? $user->fieldName : null;
                    $user->areaName = $user->areaName ? $user->areaName : null;
                    return $user;
                });

        $pagination = (new PaginationLogic)->paginateData($query, $paginationRequest);

        return response()->json($pagination);
    }

    public function getById(Request $request)
    {
        $user = DB::table('users')
                ->where('userId', '=', $request->userId)
                ->first();

        $user->image ? asset('images/'. $user->image) : null;

        return response()->json($user);
    }

    public function create(Request $request)
    {
        $image = $request->imageName;
        $imageExtension = $request->imageExtension;
        $birthDate = date('Y-m-d H:i:s', strtotime($request->birthDate));

        $base64 = base64_decode($image);
        $imageName = date('Ymdhmi').'.'.$imageExtension;
        $imagePath = public_path('images/'. $imageName);

        file_put_contents($imagePath, $base64);

        User::create([
            "roleId" => $request->roleId ,
            "fieldId" =>  $request->fieldId != '' ? $request->fieldId : null,
            "areaId" =>  $request->areaId != '' ? $request->areaId : null,
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "email" => $request->email,
            "password" => password_hash('123', PASSWORD_DEFAULT) ,
            "phone" => $request->phone,
            "birthDate" => $birthDate,
            "gender" => $request->gender,
            "image" => $imageName,
            "status" => 'Up'

        ]);

        return response()->json('User created successfully');
    }

    public function update(Request $request)
    {
        $image = $request->image;
        $imageExtension = $request->imageExtension;

        $base64 = base64_decode($image);
        $imageName = date('Ymdhmi').'.'.$imageExtension;
        $imagePath = public_path('images/'. $imageName);

        $user = DB::table('users')
                ->where('userId', '=', $request->userId)
                ->first();

        if($image != ''){
            File::delete(public_path('images/'. $user->image));
            file_put_contents($imagePath, $base64);
        }

        $user = DB::table('users')
                ->where('userId', '=', $request->userId)
                ->update([
                    "roleId" => $request->roleId,
                    "fieldId" => $request->fieldId,
                    "areaId" => $request->areaId,
                    "firstName" => $request->firstName,
                    "lastName" => $request->lastName,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "birthDate" => $request->birthDate,
                    "gender" => $request->gender,
                    "image" => $imageName,
                ]);
        return response()->json('User updated successfully');
    }


    public function delete(Request $request)
    {

        $user = DB::table('users')
                ->where('userId', '=', $request->userId)
                ->first();

        $imagePath = public_path('images/'. $user->image);

        if(file_exists($imagePath)){
            File::delete($imagePath);
        }

        $user = DB::table('users')
                ->where('userId', '=', $request->userId)
                ->delete();

        return response()->json('User deleted successfully');
    }
}
