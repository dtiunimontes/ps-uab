<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use Yajra\Datatables\Facades\Datatables;

class CursosController extends Controller{

    public function index(){
        return view('admin.cursos.home');
    }

    public function adicionar(){
        return view('admin.cursos.adicionar');
    }

    public function adicionarCurso(Request $request){
        Curso::create([
            'nome' => $request['nome'],
        ]);
        return redirect()->route('admin.cursos.home');
    }

    public function ver($id){
        $curso = Curso::find($id);
        $ver = 1;
        $titulo = 'Ver Curso';
        return view('admin.cursos.ver_editar', compact('curso', 'ver', 'titulo'));
    }

    public function editar($id){
        $curso = Curso::find($id);
        $ver = 0;
        $titulo = 'Editar Curso';
        return view('admin.cursos.ver_editar', compact('curso', 'ver', 'titulo'));
    }

    public function salvar(Request $request, $id){
        $curso = Curso::find($id);
        $curso->nome = $request['nome'];
        $curso->save();
        return redirect()->route('admin.cursos.home');
    }

    public function getCursos(){
        $cursos = Curso::all();
        return Datatables::of($cursos)->addColumn('action', function ($curso) {
            $ver = '<form class="presenca hidden-print" method="get" action="'.route("admin.cursos.ver", $curso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>';
            $editar = '<form class="presenca hidden-print" method="get" action="'.route("admin.cursos.editar", $curso->id).'" style="float:left;">'.csrf_field().'<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>';
            return '<div class="btn-group btn-group-xs btn-group-solid">'.$ver.$editar.'</div> ';
            })->make(true);
    }

}
