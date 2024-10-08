<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{

    public function index(){
        $data = Employee::all();
      
        return view ('datapegawai' ,compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(request $request){
       // dd($request->all());
        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();  
        }
        return redirect()->route('pegawai') ->with('success','data Berhasil Di Tambahkan');
    }
    

    public function tampilkandata($id){
        $data = Employee::find($id);
        //dd($data);
        return view ('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data -> update($request->all());
        return redirect()->route('pegawai')->with('success','data Berhasil Di Update');
    }

    public function delete($id){
        $data = Employee::find($id);
        $data ->delete();
        //dd($data);
        return redirect ()->route('pegawai')->with('success','Data berhasil di hapus');
    }
}
