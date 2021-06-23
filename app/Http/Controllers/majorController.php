<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class majorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewall = Major::select('major.*')->where('disable', '=', '0')->get();
        return view('major.index',[
            'listAll'=>$viewall,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Major();
        $course->name = $request->name;
        $course->shortName = $request->short;
        $course->fee = $request->fee;
        $course->disable = '0';
        $course->save();
        return redirect(route('major.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $passed = Major::select('major.*')->where('disable','=','1')->get();
        return view('major.disabled',[
            'disabled' => $passed,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $view = Major::select('major.*')
        ->where('disable','=','0')
        ->find($id);
        return view('major.edit',[
            'major' => $view
        ]);
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
        Major::where('id', $id)->update([
            "name" => $request->get('name'),
            "shortName" => $request->get('short'),
            "fee"=> $request->get('fee')
        ]);
        return redirect(route('major.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function hide($id)
    {
        Major::where('id', $id)->update([
            "disable" => 1,
        ]);
        return redirect(route('major.index'));
    }
    public function disabled()
    {
        $passed = Major::select('major.*')->where('disable','=','1')->get();
        return view('major.disabled',[
            'disabled' => $passed,
        ]);
    }
    public function showMajor($id)
    {
        Major::where('id', $id)->update([
            "disable" => 0,
        ]);
        return redirect(route('major.index'));
    }
}
