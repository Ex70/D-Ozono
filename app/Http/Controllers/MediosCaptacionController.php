<?php

namespace App\Http\Controllers;

use App\Models\Medio;
use Illuminate\Http\Request;

class MediosCaptacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['medios']=Medio::where('status',1)->get();
        return view('pages.medioscaptacion.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $medioID = $request->id;
        $medio = Medio::updateOrCreate(
            ['id' => $medioID],
            ['descripcion' => $request->descripcion]);
        $medioID = $medio->id;
        $data=Medio::where('id',$medioID)->get();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $datos['medio']=Medio::findOrFail($id);
        return response()->json($datos);
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
        //
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

    public function status($id){
        Medio::where('id',$id)->update(['status'=>0]);
        $medios=Medio::where('id',$id)->get();
        if (!empty($medios)){
            $success = true;
            $message = "Registo eliminado exitosamente";
        }else{
            $success = true;
            $message = "Rgistro no eliminado";
        }
        return response () -> json([
            'success'=> $success,
            'message'=> $message,
        ]);
    }
}
