<?php

namespace App\Http\Controllers;

use App\Models\agent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class agentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.agentDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*
       $agent= $request->validate([
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'ID_type' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date',
            'ID_expiry_date' =>'required|date',
            'businessName' =>'required',
            'businessType' =>'required',
            'businessAddress' =>'required',
            'licenceFilePath'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'licenceNmber' =>'required',
            'issueDate' =>'required|date',
            'expiryDate' =>'required|date',
            'tinNumber' =>'required',
            'businessEstablishmentYear' =>'required'
        ]);
    */
        $distro_id_image_name = time().'-'.$request->firstName.'.'.$request->id_path->extension();
        $request->id_path->move(public_path('id images'),$distro_id_image_name);
    
        $licence_image_name = time().'-'.$request->firstName.'.'.$request->licenceFilePath->extension();
        $request->licenceFilePath->move(public_path('licence images'),$licence_image_name);

        $agent = agent::create([
            
            'user_id'=>auth()->user()->id,

            'address'=> $request->address,
            'mobile'=>$request->mobile,
           'id_file_path'=> $distro_id_image_name,
            'ID_type'=>$request->ID_type,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            
            'businessName'=>$request->businessName,
            'businessType'=> $request->businessType,
            'businessAddress'=>$request->businessAddress,
           'licenceFilePath'=> $licence_image_name,
            'licenceNumber'=>$request->licenceNumber,
            'issueDate'=> $request->issueDate,
            'expiryDate'=> $request->expiryDate,
            'tinNumber'=> $request->tinNumber,
            'businessEstablishmentYear'=> $request->businessEstablishmentYear,
           
           
            
        ]);

        Alert::toast('Successfully Added!', 'success');
        return redirect('/agentDashboard');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(agent $agentProfile)
    {
        $agentProfile=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->get();
        
 return view('agent.showProfile',compact('agentProfile'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(agent $agent)
    {
        $agentProfile=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->get();
        
 return view('agent.profileUpdate',compact('agentProfile'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, agent $agent)
    {
        $agentProfile=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([

            'firstName'=> $request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=>$request->userName,
            'email'=> $request->email,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
         
            'ID_type'=>$request->ID_type,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            
            'businessName'=>$request->businessName,
            'businessType'=> $request->businessType,
            'businessAddress'=>$request->businessAddress,
           
            'licenceNumber'=>$request->licenceNumber,
            'issueDate'=> $request->issueDate,
            'expiryDate'=> $request->expiryDate,
            'tinNumber'=> $request->tinNumber,
            'businessEstablishmentYear'=> $request->businessEstablishmentYear,
        ]);
        Alert::toast('Successfully Updated!', 'success');
        return redirect('/key_distroDashboard');
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(agent $agent)
    {
        //
    }
}
