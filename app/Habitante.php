<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Habitante extends Model
{
    protected $fillable = [
        'title',
        'name',
        'nick',
        'foto'
    ];

    public static function get_all(){
        $habitantes = DB::table('habitantes')
            ->get();

        return  $habitantes;
    }

    public static function getOne($id){
        $habitante = DB::table('habitantes')
            ->find($id);

        return  $habitante;
    }
}
