<?php

namespace App\Http\Controllers;

use App\Models\rsp;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class rspProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rspDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('RSP.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distro_id_image_name = time().'-'.$request->firstName.'.'.$request->id_path->extension();
        $request->id_path->move(public_path('id images'),$distro_id_image_name);
    
        $licence_image_name = time().'-'.$request->firstName.'.'.$request->licenceFilePath->extension();
        $request->licenceFilePath->move(public_path('company id images'),$licence_image_name);
  
 

        $request = rsp::create([
            
            'user_id'=>auth()->user()->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
           'id_filepath'=> $distro_id_image_name,
            'ID_type'=>$request->ID_type,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,

            'company_id_filepath'=> $licence_image_name,
            'company_id_number'=>$request->licenceNumber,
            'company_id_issue_date'=> $request->issueDate,
            'company_id_expiry_date'=> $request->expiryDate,
        ]);

        Alert::toast('Successfully Completed!', 'success');
        return redirect('/rspDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function show(rsp $rspProfile)
    {
        $rspProfile=rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->get();
        
 return view('RSP.showProfile',compact('rspProfile'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function edit(rsp $rsp)
    {
        $rspProfile=rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->get();
        
 return view('RSP.ProfileUpdate',compact('rspProfile'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rsp $rsp)
    {
        $distro_id_image_name = time().'-'.$request->firstName.'.'.$request->id_path->extension();
        $request->id_path->move(public_path('id images'),$distro_id_image_name);
    
 

        $rspProfile=rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->update([

            'firstName'=> $request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=>$request->userName,
            'email'=> $request->email,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
           'id_filepath'=> $distro_id_image_name,
            'ID_type'=>$request->ID_type,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,

            'company_id_filepath'=> $licence_image_name,
            'company_id_number'=>$request->licenceNumber,
            'company_id_issue_date'=> $request->issueDate,
            'company_id_expiry_date'=> $request->expiryDate,
        ]);
          Alert::toast('Successfully updated!', 'success');
         return redirect('/rspDashboard');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function destroy(rsp $rsp)
    {
        //
    }
}
