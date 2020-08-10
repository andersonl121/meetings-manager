<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\User;
use App\Mail\UserCreated;
use Auth;
use Session;
use Illuminate\Support\Facades\Mail;

class Login extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function authenticate(Request $request)
    {
		$name = $request -> user; 
		$password = $request -> password; 
        if (Auth::attempt(['login' => $name, 'password' => $password]))
        {
			session_start();
			Session::put('usuario',$name);
			return redirect()->intended('index');
        }else{
			
			return redirect('/')->with('errors','Usuário ou senha incorretos, favor verificar!');
		}
    }
	
	public function logout()
    {
		Session::flush();
		session_unset();
		Auth::logout();
		return redirect('/')->with('errors','Usuário deslogado com sucesso!');
	}
	
	public function cadastro(Request $request)
    {
		//if($request -> pwd == $request -> rpwd){
		$user = new User;
		$user->name = $request->fn ." ". $request->ln;
		$user->email = $request->email;
		$nudePass = $this->randString();
		$user->password = bcrypt($nudePass);
		$user->login = $request->login;
		if($request->isGestor==true){
			$user->isGestor = 1;
		}else{
			$user->isGestor = 0;
		}
		$user->type = $request->tipo;
	
		$user->save();
		Mail::to($user->email)->send(new UserCreated($user,$nudePass));
		return redirect('index')->with('errors','Usuário cadastrado com sucesso!');
		// }else{
		// return redirect('signup')->with('errors','As senhas digitadas não correspondem!');
		// }
	}
	
	public function trocarSenha(Request $request){

		$oldPwd = $request -> oldPwd; 
		$newPwd = $request -> pwd;
		$confPwd = $request -> rpwd;
		$usuarioLogado = Session::get('usuario');
		
		
		
		if(!(Auth::attempt(['login' => $usuarioLogado, 'password' => $oldPwd]))){
			return redirect('cpwd')->with('errors','Senha errada, tente novamente!');
		}else if(!($newPwd === $confPwd)){
			return redirect('cpwd')->with('errors','Senhas não correspondem, favor verificar!');
		}else{
			User::where('login',$usuarioLogado) -> update(['password'=>bcrypt($newPwd)]);
			return redirect('index')->with('errors','Senha alterada com sucesso!');
		}
        

	}

	public function randString(){
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789*@/!&';

        $return= "";

        for($count= 0; 10 > $count; $count++){
            //Gera um caracter aleatorio
            $return .= $basic[rand(0, strlen($basic) - 1)];
        }

        return $return;
    }
}