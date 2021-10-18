<?php

namespace App\Http\Controllers;

use App\Names;
use Illuminate\Http\Request;

class NamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos["names"] = names::paginate(5);
        return view('names.index', $datos);
    }

    public function search(Request $request){
        $search = $request->input('query');
        $datos["names"] = names::query()
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('lastname', 'LIKE', "%{$search}%")
        ->paginate(5);
        return view('names.index', $datos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('names.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucess = true;
        $datos = request()->except('_token');
        names::Insert($datos);
        return redirect("/names")->with('sucess',$sucess);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Names  $names
     * @return \Illuminate\Http\Response
     */
    public function show(Names $names)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Names  $names
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $name = names::findOrFail($id);
        return view('names.edit', compact("name"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Names  $names
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sucess = true;
        $datos = request()->except(['_token',"_method"]);
        names::where("id","=",$id)->update($datos);
        $name = names::findOrFail($id);
        return view('names.edit', compact("name", "sucess"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Names  $names
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucess = true;
        names::destroy($id);
        return redirect("names")->with('sucess',$sucess);
    }
}
