<?php

namespace App\Http\Controllers;

use App\Models\rom;
use App\Models\user;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class romProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.romDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ROM.create');
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

        $request = rom::create([
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
        return redirect('/romDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function show(rom $romProfile)
    {
        $romProfile=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->get();

 return view('ROM.showProfile',compact('romProfile'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function edit(rom $rom)
    {
        $romProfile=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->get();

 return view('ROM.ProfileUpdate',compact('romProfile'));;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rom $rom)
    {
        $distro_id_image_name = time().'-'.$request->firstName.'.'.$request->id_path->extension();
        $request->id_path->move(public_path('id images'),$distro_id_image_name);

        $licence_image_name = time().'-'.$request->firstName.'.'.$request->licenceFilePath->extension();
        $request->licenceFilePath->move(public_path('company id images'),$licence_image_name);




        $kdProfile=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([

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
         return redirect('/romDashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function destroy(rom $rom)
    {
        //
    }
}
