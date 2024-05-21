<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Lesson;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        //dd($course);
        // Recuperar as aulas do banco de dados
        $lessons = Lesson::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_lesson', 'asc')
            ->get();

        // Carregar a view e passar o array de aulas como parâmetro
        return view('lessons.index', ['course' => $course, 'lessons' => $lessons]);
    }

    // Carregar o formulário para criar uma nova aula
    public function create(Course $course)
    {
        // Carregar a view
        return view('lessons.create', ['course' => $course]);
    }

    // Armazenar uma nova aula
    public function store(LessonRequest $request)
    {

        // Validar o formulário
        $request->validated();
        // dd($request);

        DB::beginTransaction();

        // Recuperar a última ordem da aula no curso
        // Procura pelo course_id (chave estrangeira), e pega o maximo da coluna order_lesson

        // Se eu fizer uso do max, já retornará diretamente o valor do max, e não corro o risco
        // de retornar um erro mais abaixo

        try {
            $lastOrderLesson = Lesson::where('course_id', $request->course_id)
                ->max('order_lesson');

            // $lastOrderLesson = Lesson::where('course_id', $request->course_id)
            //     ->orderBy('order_lesson', 'desc')
            //     ->first();
            //dd($lastOrderLesson);

            // Cadastrar no banco de dados na tabela aulas
            Lesson::create([
                'name' => $request->name,
                'description' => $request->description,
                //'order_lesson' => $lastOrderLesson ? $lastOrderLesson->order_lesson + 1 : 1,
                'order_lesson' => $lastOrderLesson + 1,
                'course_id' => $request->course_id //id do curso que está oculto no formulário de cadastro
            ]);

            DB::commit();

            return redirect()->route('lessons.index', $request->course_id)->with('success', 'Aula criada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Erro ao criar aula.');
        }
    }


    public function show(Lesson $lesson)
    {
        // dd($lesson);
        return view('lessons.show', ['lesson' => $lesson]);
    }


    // Carregar o formulário para editar uma aula
    public function edit(Lesson $lesson)
    {
        // Carregar a view e passar o array de aulas como parâmetro
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    // Atualizar uma aula
    public function update(LessonRequest $request, Lesson $lesson)
    {

        // dd($request);
        //dd($lesson->course_id);

        // Validar o formulário
        $request->validated();

        DB::beginTransaction();
        try {
            // Atualizar no banco de dados na tabela aulas
            $lesson->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('lessons.index', ['course' => $lesson->course_id])->with('success', 'Aula atualizada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erro ao atualizar aula.');
        }
    }

    public function destroy(Lesson $lesson)
    {
        try {
            $lesson->delete();
            return redirect()->route('lessons.index', ['course' => $lesson->course_id])->with('success', 'Aula excluída com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('lessons.index', ['course' => $lesson->course_id])->with('error', 'Erro ao excluir aula.');
        }
    }
}
