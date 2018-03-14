<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Polo;
use App\Models\Curso;
use Yajra\Datatables\Facades\Datatables;

class PolosController extends Controller{

    public function index(){
        return view('admin.polos.home');
    }

    public function adicionar(){
        $cursos = Curso::all();
        return view('admin.polos.adicionar', compact('cursos'));
    }

    public function adicionarPolo(Request $request){
        Polo::create([
            'nome' => $request['polo'],
            'curso_id' => $request['curso_id']
        ]);
        return redirect()->route('admin.polos.home');
    }

    public function ver($id){
        $polo = Polo::find($id);
        $cursos = Curso::all();
        $ver = 1;
        $titulo = 'Ver Polo';
        return view('admin.polos.ver_editar', compact('polo', 'cursos', 'ver', 'titulo'));
    }

    public function editar($id){
        $polo = Polo::find($id);
        $cursos = Curso::all();
        $ver = 0;
        $titulo = 'Editar Polo';
        return view('admin.polos.ver_editar', compact('polo', 'cursos', 'ver', 'titulo'));
    }

    public function salvar(Request $request, $id){
        $polo = Polo::find($id);
        $polo->nome = $request['polo'];
        $polo->curso_id = $request['curso_id'];
        $polo->save();
        return redirect()->route('admin.polos.home');
    }

    public function getPolos(){
        $polos = Polo::all();
        return Datatables::of($polos)
          ->addColumn('action', function ($polo) {
              $ver = '<form class="presenca hidden-print" method="get" action="'.route("admin.polos.ver", $polo->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>';
              $editar = '<form class="presenca hidden-print" method="get" action="'.route("admin.polos.editar", $polo->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>';
              return '<div class="btn-group btn-group-xs btn-group-solid">'.$ver.$editar.'</div> ';
            })
            ->editColumn('curso_id', function ($polo) {
              $cursos = Curso::all();
              foreach($cursos as $curso){
                if ($polo->curso_id == $curso->id) {
                  return $curso->nome;
                }
              }
            })
            ->make(true);
    }
}
