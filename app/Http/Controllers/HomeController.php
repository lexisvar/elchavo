<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habitante;
use Illuminate\Support\Facades\Storage;
use Faker\Provider\File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    function save(Request $request){
        if ($request->isMethod('post')) {

            $id = $request->input('id');

            $file_data = $request->input('foto');
            $file_name = '';
            if($file_data!=''){
                $file_name = 'image_'.time().'.png'; //generating unique file name;
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if($file_data!=""){ // storing image in storage/app/public Folder
                    Storage::disk('public')->put($file_name,base64_decode($file_data));
                }
            }

            $this->validate($request, [
                'name' => 'required',
                'nick' => 'required',
            ],[
                'name.required'=>'El campo nit no puede estar vacío',
                'nick.required'=>'El campo nombre no puede estar vacío',
            ]);

            $habitante = new Habitante();

            if($request->input('id')!=0){
                $habitante = Habitante::find($id);
            }

            $habitante->title = $request->input('title');
            $habitante->name = $request->input('name');
            $habitante->nick = $request->input('nick');
            if($file_name!==""){
                $habitante->foto = $file_name;
            }

            if($habitante->save()){
                return json_encode(array('success'=>true,'message'=>'Registro Éxitoso'));
            }else{
                return json_encode(array('success'=>false,'message'=>'Registro No Éxitoso'));
            }
        }
    }

    function getAllHabitantes(){
        $habitantes = Habitante::get_all()->toArray();
        return json_encode($habitantes);
    }
    function deleteHabitante($habitante_id){
        $habitante = Habitante::find($habitante_id)->delete();
        return 'El habitante fue eliminado éxitosamente';
    }
    function getHabitante($habitante_id){
        $habitante = Habitante::find($habitante_id);
        return json_encode($habitante);
    }
}
