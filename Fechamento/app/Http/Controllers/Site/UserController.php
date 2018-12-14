<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\User;

class UserController extends Controller
{

    public function index(){
        return view('auth.changePassword');
    }

    public function update(Request $request){

        $input = $request->all();
        
        if (! Hash::check($input['currentPassword'], \Auth::user()->password)){
            //dd($input);
            return redirect()->route('user.index')->withErrors(['password' => 'Senha atual está incorreta'])->withInput();
        }

        //redirect()->route('tarefa.index');

        $validator = Validator::make($request->all(), [
            //'email'      => 'required|email|unique:users,email,' . $input['id'],
            'newPassword'   => ["required"],
            'newPasswordAgain' => 'required|same:newPassword'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.index')
                ->withErrors($validator)
                ->withInput();
        }
        $user = \Auth::user();
        //$user = $this->users->find($id);

        $input['password'] = bcrypt($input['newPassword']);//criptografa password

        $user->update($input);
        $request->session()->flash('changePass', 'Usuário atualizado com sucesso. - '.$user->nome);//flash message teste
        return redirect()->route('user.index');

    }

}
