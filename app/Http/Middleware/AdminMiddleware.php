<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // SE O USUÁRIO NÃO ESTIVER LOGADO REDIRECIONA PARA O LOGIN
        if (!Auth::check()) {
            return redirect('login');
        }else{
            // SE O USUÁRIO QUE LOGOU FOR CANDIDATO REDIRECIONA PARA MINHA CONTA
            if($request->user()->permissao == 2){
                return $next($request);
            }else{
				return redirect('/minhaconta');
            }
        }
    }
}
