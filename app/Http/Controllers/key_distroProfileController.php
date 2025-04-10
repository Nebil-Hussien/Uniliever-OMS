<?php

namespace App\Http\Controllers;

use App\Models\key_distro;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\businessType;

use RealRashid\SweetAlert\Facades\Alert;

class key_distroProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessType=businessType::all(); 
        return view('KD.create',compact('businessType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // $users = user::where('id', auth()->user()->id)->get('users.firstName','users.lastName');
       // return $user;
        $distro_id_image_name = time().'-'.$request->firstName.'.'.$request->id_path->extension();
        $request->id_path->move(public_path('id images'),$distro_id_image_name);
    
        $licence_image_name = time().'-'.$request->firstName.'.'.$request->licenceFilePath->extension();
        $request->licenceFilePath->move(public_path('licence images'),$licence_image_name);
  

 

        $request = key_distro::create([
            
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
            'latitude'=> $request->lat,
            'longtude'=> $request->lng,
           
            
        ]);

     Alert::toast('Successfully Completed!', 'success');
        return redirect('/key_distroDashboard');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function show(key_distro $kdProfile)
    {
        $kdProfile=key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',auth()->user()->id)->get();
        
 return view('KD.showProfile',compact('kdProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function edit(key_distro $key_distro)
    {
        $kdProfile=key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',auth()->user()->id)->get();
        
 return view('KD.profileUpdate',compact('kdProfile'));;


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, key_distro $key_distro)
    {


               $kdProfile=key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',auth()->user()->id)->update([

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
            'latitude'=> $request->lat,
            'longtude'=> $request->lng,


        ]);
        Alert::toast('Successfully Updated!', 'success');
        return redirect('/key_distroDashboard');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function destroy(key_distro $key_distro)
    {
        //
    }
}
