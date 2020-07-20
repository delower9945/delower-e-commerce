<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cupon;
use Carbon\Carbon;

class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Show all of Cupon List
    */
    public function index(){
      return view('admin.cupon.index',[
        'cupons' => Cupon::all(),
        'delete_cupons' => Cupon::onlyTrashed()->get(),
      ]);
    }

    /*
    * Add Cupon
    */
    public function addCupon(){
      return view('admin.cupon.add_cupon');
    }

    /*
    * Store the cupon in storege
    */
    public function store(Request $request){
      $request->validate([
        'cupon_name' => 'required|unique:cupons,cupon_name',
        'discount_amount' => 'required|numeric|min:1|max:99',
        'validity_till' => 'required',
      ]);

      Cupon::insert([
        'cupon_name' => strtoupper($request->cupon_name),
        'discount_amount' => $request->discount_amount,
        'validity_till' => $request->validity_till,
        'created_at' => Carbon::now(),
      ]);
      return redirect('cupon/list')->with('cupon_message','Cupon Added Successfully..');
    }

    /*
    * Show the specifique Cupon in edit form value
    */
    public function edit($id){
      return view('admin.cupon.edit_cupon',[
        'cupon' => Cupon::find($id)
      ]);
    }

    /*
    * Update the specifique Cupon Value
    */
    public function update(Request $request){
      $request->validate([
        'cupon_name' => 'required',
        'discount_amount' => 'required|numeric|min:1|max:99',
        'validity_till' => 'required',
      ]);

      Cupon::find($request->id)->update([
        'cupon_name' => $request->cupon_name,
        'discount_amount' => $request->discount_amount,
        'validity_till' => $request->validity_till,
        'updated_at' => Carbon::now(),
      ]);
      return redirect('cupon/list')->with('cupon_message',"Cupon Updated Successfully..");
    }

    /*
    * soft Delete the specifique Cupon Value
    */
    public function delete($id){
      Cupon::find($id)->delete();
      return back()->with('cupon_delete_message',"Cupon Trashed Successfully.");
    }

    /*
    * Restore the specifique Cupon Value
    */
    public function restore($id){
      Cupon::withTrashed()->find($id)->restore();
      return back()->with('cupon_message','Cupon Restore Successfully...');
    }

    /*
    * Heard Delete the specifique Cupon Value form the storege
    */
    public function heardDelete($id){
      Cupon::onlyTrashed()->find($id)->forceDelete();
      return back()->with('cupon_message','Cupon Trashed Deleted Successfully...');
    }
}
