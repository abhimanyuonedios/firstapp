<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{
    public function index()
    {
        $data = Api::all();
        return response()->json([
            'data' => $data
         ],200);
    }
    public function show($id)
    {
        $data= Api::find($id);
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
                'status' => $request->status
            ]);
            // Api::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'status' => $request->status
            // ]);
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
            $deleted =  Api::find($id);
            $deleted->delete();
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

    public function update(Request $request,$id)
    {
        try
        {
            // Find Post
            $data = Api::find($id);
            if(!$data){
              return response()->json([
                'message'=>'Data Not Found.'
              ],404);
            }
            else{
                $data->name     =   $request->name;
                $data->email    =   $request->email;
                $data->phone    =   $request->phone;
                $data->address  =   $request->address;
                $data->status   =   $request->status;
                $data->save();
                return response()->json([
                    'message'=>'Data Successfully.'
                  ],404);
            }
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }
}
