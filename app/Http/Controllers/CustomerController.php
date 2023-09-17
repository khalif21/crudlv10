<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Customer::where('room','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $data = Customer::paginate(5);
        }
        return view('datacustomer','compact'('data'));
    }

    public function tambahcustomer(){

        return view('tambahdata');
    }

    public function insertdata(Request $request){
        //dd($request->all());
        Customer::create($request->all());

        return redirect()->route('customer')->with('success','Data Berhasil Di Tambahkan!');

    }

    public function tampilkandata($id){

        $data = Customer::find($id);
        //dd($data);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request,$id){

        $data = Customer::find($id);
        $data->update($request->all());
        //dd($data);
        return redirect()->route('customer')->with('success','Data Berhasil Di Update!');
    }

    public function delete($id){

        $data = Customer::find($id);
        $data->delete();
        //dd($data);
        return redirect()->route('customer')->with('success','Data Berhasil Di Delete!');

    }


    public function exportpdf(){
        $data = Customer::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datacustomer-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel(){
        return Excel::download(new CustomerExport, 'datacustomer.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('RoomData', $namafile);

        Excel::import(new CustomerImport, \public_path('/RoomData/'.$namafile));
        return \redirect()->back();


    }
}
