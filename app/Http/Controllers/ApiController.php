<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;



class ApiController extends Controller
{
    public function index()
    {
        $data = DB::table('apis')->get();
        return response()->json([
            'data' => $data
         ],200);
    }
    public function show($id)
    {
        $data= DB::table('apis')->where('id', $id)->get();
        if(!$data){
        return response()->json([
        'message'=>'Data Not Found.'
        ],404);
        }

        return response()->json([
        'data' => $data
        ],200);
    }
    public function create(Request $request)
    {
        try
        {
            DB::table('apis')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
            ]);
            return response()->json([
            'message'=>'Data insert succesully.'
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }

    }
    public function destroy($id)
    {
        try
        {
            $deleted = DB::table('apis')->where('id',$id)->delete();
            return response()->json([
                'message'=>'Data deleted succesully.'
                ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }

    }
}
