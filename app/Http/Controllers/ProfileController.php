<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    // Detalhes do perfil
    public function show()
    {
        //Recuperar do banco de dados as informações do usuário logado
        $user = User::where('id', Auth::id())->first();

        // Carregar a View
        return view('profile.show', ['user' => $user]);
    }

    // Carregar o formulário editar perfil
    public function edit()
    {
        //Recuperar do banco de dados as informações do usuário logado
        $user = User::where('id', Auth::id())->first();

        // Carregar a view
        return view('profile.edit', ['user' => $user]);
    }

    public function update(ProfileRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {

            //Recuperar do banco de dados as informações do usuário logado
            $user = User::where('id', Auth::id())->first();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            DB::commit();

            // Salvar log
            Log::info('Perfil editado. ' . $user->name, ['user_id' => $user->id]);

            return redirect()->route('profile.show')
                ->with('success', 'Perfil atualizado com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            // Salvar log
            Log::notice('Perfil não editado. ', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar o perfil!');
        }
    }

    // Carregar o formulário editar senha do perfil
    public function editPassword()
    {
        //Recuperar do banco de dados as informações do usuário logado
        $user = User::where('id', Auth::id())->first();

        // Carregar a view
        return view('profile.editPassword', ['user' => $user]);
    }

    // Editar no banco de dados a senha do perfil
    public function updatePassword(Request $request)
    {
        $request->validate(
            ['password' => 'required|min:8',],
            [
                'password.required' => 'O campo senha é obrigatório',
                'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            ]
        );

        DB::beginTransaction();

        try {
            //Recuperar do banco de dados as informações do usuário logado
            $user = User::where('id', Auth::id())->first();

            $user->update([
                'password' => $request->password,
            ]);

            DB::commit();

            // Salvar log
            Log::info('Senha do perfil editada. ' , ['user_id' => $user->id]);

            return redirect()->route('profile.show')
                ->with('success', 'Senha do perfil atualizada com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            // Salvar log
            Log::notice('Senha do perfil não editada. ', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar a senha do perfil!');
        }
    }
}
