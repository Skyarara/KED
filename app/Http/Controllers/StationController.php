<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Stations;

class StationController extends Controller
{
    public function index(Request $request)
    {

    $station = Stations::filter($request)->paginate(10);

    return view('station.index', compact('station'));   
    }

    public function tambah_page()
    {
        return view('station.tambah');   
    }

    public function tambah(Request $request)
    {
        $rules = array(
            'nama' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {

        $station = new Stations();
        $station->name = $request->nama;
        $station->save();

        return redirect('/station');

        }
    }

    public function ubah_page($id)
    {

    $old_station = Stations::find($id);

    return view('station.ubah', compact('old_station'));   
    }

    public function ubah(request $request, $id)
    {
        $rules = array(
            'nama' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {
            
            $station = Stations::find($request->id);
            $station->name = $request->nama;
            $station->save();

            return redirect('/station');
        }
    }

    public function hapus(request $request)
    {
        $station = Stations::find($request->id)->delete();
        return 1;
    }

}
