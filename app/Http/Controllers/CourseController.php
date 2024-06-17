<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    // Listar os cursos
    public function index()
    {
        //dd("Listar");

        // Retorna o registro com o id 1000
        //$courses = Course::where('id', 1000)->get();

        // Retorna todos os registros
        //$courses = Course::get();

        // Retorna os registros na ordem inversa de id
        //$courses = Course::orderBy('id', 'desc')->get();

        // Retorna os registro na ordem crescente de name
        $courses = Course::orderBy('name', 'asc')
            // ->where('id', 1000)
            //->get();
            ->paginate(9);

        // Salvar log
        Log::info('Listar os cursos');

        // Retorna todos os registros de forma paginada
        // $courses = Course::paginate(1);

        return view('courses.index', ['courses' => $courses, 'menu' => 'courses']);
    }
    public function create()
    {
        //dd("Listar");
        return view('courses.create', ['menu' => 'courses']);
    }
    public function store(CourseRequest $request)
    {

        // Incluir essa linha para validação, utilizando a classe CourseRequest
        $request->validated();

        //dd($request);
        //Course::create($request->all());
        // o $request->'name' abaixo é o nome do campo

        DB::beginTransaction();

        //dd($request->price);

        try {
            $course = Course::create([
                'name' => $request->name,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
            ]);


            DB::commit();

            // Salvar log
            Log::info('Curso cadastrado. ' . $course->name, ['course_id' => $course->id]);

            return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso criado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            // Salvar log
            Log::warning('Curso não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao criar o curso!');
        }
    }
    // public function show(Request $request)
    // {
    //     //dd($request->course);
    //     $course = Course::where('id', $request->course)->first();
    //     //dd($course);
    //     return view('courses.show', ['course' => $course]);
    // }

    // Eu poderia substituir o método show acima recebendo a model Course como argumento e não precisaria
    // da linha da pesquisa do id
    public function show(Course $course)
    {
        //dd($request->course);
        //$course = Course::where('id', $request->course)->first();
        // dd($course);

        // Salvar log
        Log::info('Visualizar o curso: ' . $course->name, ['course_id' => $course->id]);

        return view('courses.show', ['course' => $course, 'menu' => 'courses']);
    }

    public function edit(Course $course)
    {
        //dd($course);
        return view('courses.edit', ['course' => $course, 'menu' => 'courses']);
    }

    //Request $request = recupero dados do formulário
    // Course $course = recupero o registro do banco
    public function update(CourseRequest $request, Course $course)
    {
        //dd($request);
        //dd($course);

        // Incluir essa linha para validação, utilizando a classe CourseRequest
        $request->validated();

        DB::beginTransaction();

        try {

            $course->update([
                'name' => $request->name,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
            ]);

            DB::commit();

            // Salvar log
            Log::info('Curso editado. ' . $course->name, ['course_id' => $course->id]);

            return redirect()->route('courses.show', ['course' => $course->id])
                ->with('success', 'Curso atualizado com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            // Salvar log
            Log::notice('Curso não editado. ', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar o curso!');
        }
    }


    public function destroy(Course $course)
    {
        //dd($course);
        try {


            $course->delete();

            // Salvar log
            Log::info('Curso excluído. ' . $course->name, ['course_id' => $course->id]);

            return redirect()->route('courses.index')->with('success', 'Curso excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::notice('Curso não excluído. ', ['error' => $e->getMessage()]);

            return redirect()->route('courses.index')->with('error', 'Erro ao excluir o curso!');
        }
    }
}
