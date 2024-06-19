<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(10);

        return view('users.index', ['users' => $users, 'menu' => 'users']);
    }

    public function create()
    {
        return view('users.create', ['menu' => 'users']);
    }

    public function store(UserRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $course = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);


            DB::commit();

            // Salvar log
            Log::info('Curso cadastrado. ' . $course->name, ['course_id' => $course->id]);

            return redirect()->route('users.show', ['user' => $course->id])->with('success', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            // Salvar log
            Log::warning('Curso não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao criar o usuário!');
        }
    }

    public function show(User $user)
    {

        return view('users.show', ['user' => $user, 'menu' => 'users']);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user, 'menu' => 'users']);
    }

    public function update(UserRequest $request, User $user)
    {
        $request->validated();

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            DB::commit();

            // Salvar log
            Log::info('Usuário editado. ' . $user->name, ['user_id' => $user->id]);

            return redirect()->route('users.show', ['user' => $user->id])
                ->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            // Salvar log
            Log::notice('Usuário não editado. ', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar o usuário!');
        }
    }

    public function editPassword(User $user)
    {
        return view('users.editPassword', ['user' => $user, 'menu' => 'users']);
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate(
            ['password' => 'required|min:8',],
            ['password.required' => 'O campo senha é obrigatório',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',]
        );

        DB::beginTransaction();

        try {

            $user->update([
                'password' => $request->password,
            ]);

            DB::commit();

            // Salvar log
            Log::info('Senha editada. ' . $user->password, ['user_id' => $user->id]);

            return redirect()->route('users.show', ['user' => $user->id])
                ->with('success', 'Senha atualizada com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            // Salvar log
            Log::notice('Senha não editada. ', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar a senha!');
        }



    }

    public function destroy(User $user)
    {

        //dd($user);
        try {
            $user->delete();

            // Salvar log
            Log::info('Usuário excluído. ' . $user->name, ['user_id' => $user->id]);

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::notice('Usuário não excluído. ', ['error' => $e->getMessage()]);

            return redirect()->route('users.index')->with('error', 'Erro ao excluir o usuário!');
        }
    }
}
