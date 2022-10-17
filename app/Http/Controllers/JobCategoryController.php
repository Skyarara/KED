<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\JobCategories;

class JobCategoryController extends Controller
{
    public function index(Request $request)
    {

    $job_category = JobCategories::filter($request)->paginate(10);

    return view('job_category.index', compact('job_category'));   
    }

    public function tambah_page()
    {
        return view('job_category.tambah');   
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

        $job_category = new JobCategories();
        $job_category->name = $request->nama;
        $job_category->short_name = $request->namas;
        $job_category->save();

        return redirect('/job_category');

        }
    }

    public function ubah_page($id)
    {

    $old_category = JobCategories::find($id);

    return view('job_category.ubah', compact('old_category'));   
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
            
            $job_category = JobCategories::find($request->id);
            $job_category->name = $request->nama;
            $job_category->short_name = $request->namas;   
            $job_category->save();

            return redirect('/job_category');
        }
    }

    public function hapus(request $request)
    {
        $job_category = JobCategories::find($request->id)->delete();
        return redirect('/job_category');
    }
}
