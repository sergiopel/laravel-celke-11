<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class LoginController extends Controller
{
    // Login
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$authenticated) {
            // Salvar log
            Log::warning('E-mail ou senha inválido!', ['email' => $request->email]);

            // Se o usuário não conseguiu se autenticar, redireciona o usuário para a página anterior(login), mantendo os
            // dados preenchidos (withInput) e exibindo uma mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválido!');
        }

        // Se conseguiu se autenticar, redireciona para a página dashboard
        return redirect()->route('dashboard.index');
    }

    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        //Carregar a view
        return view('login.create');
    }

    //Cadastrar no banco de dados o novo usuário
    public function store(LoginUserRequest $request)
    {
        //dd($request);
        $request->validated();

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);


            DB::commit();

            // Salvar log
            Log::info('Usuário cadastrado. ' . $user->name, ['user_id' => $user->id]);

            return redirect()->route('login.index')->with('success', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            // Salvar log
            Log::warning('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao criar o usuário!');
        }
    }

    // Deslogar o usuário
    public function destroy()
    {
        // Deslogar o usuário
        Auth::logout();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
