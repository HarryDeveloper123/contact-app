<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;
use App\Models\Address;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = User::with('get_type', 'get_address')->get();

        return response()->json([
            'success' => true,
            'message' => 'List data contact',
            'data' => $contacts
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $phoneDetails = Phone::create([
            'user_id' => $user->id,
            'phone_type' => 'MOBILE',
            'phone_number'=> $request->phone_number
        ]);

        $address = Address::create([
            'user_id' => $user->id,
            'address_line' => $request->address_line,
            'pincode' => $request->pincode
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact created',
            'data' => $user, $phoneDetails, $address
        ], 201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($id); die;
        if (!empty($id)) {
            $contacts = User::with('get_type', 'get_address')->where('id', $id)->first();
            return response()->json($contacts);
        }
        return false;   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $phoneDetails = Phone::where('user_id', '=', $id);
            foreach ($request->get_type as $key => $value) {
                $phoneDetails->update([
                    'user_id' => $user->id,
                    'phone_type' => $value['phone_type'],
                    'phone_number'=> $value['phone_number']
                ]);
            }
            
            $address = Address::where('user_id', '=', $id);
            foreach ($request->get_address as $key => $val) {
                $address->update([
                    'user_id' => $user->id,
                    'address_line' => $val['address_line'],
                    'pincode' => $val['pincode']
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contact updated',
                'data' => $user, $phoneDetails, $address
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Contact not found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user = User::find($id);
     
        if ($user) {
  
            $user = User::find($id);
            $user->delete();

            $phone = Phone::where('user_id', '=', $id);
            $phone->delete();

            $address = Address::where('user_id', '=', $id);
            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact deleted'
            ], 200);

        }
        
        return response()->json([
            'success' => false,
            'message' => 'Contact not found'
        ], 404);

    }
}
