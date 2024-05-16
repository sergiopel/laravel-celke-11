<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
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
        $courses = Course::orderBy('name', 'asc')->get();

        // Retorna todos os registros de forma paginada
        // $courses = Course::paginate(1);

        return view('courses.index', ['courses' => $courses]);
    }
    public function create()
    {
        //dd("Listar");
        return view('courses.create');
    }
    public function store(CourseRequest $request)
    {

        // Incluir essa linha para validação, utilizando a classe CourseRequest
        $request->validated();

        //dd($request);
        //Course::create($request->all());
        // o $request->'name' abaixo é o nome do campo
        $course = Course::create([
            'name' => $request->name,
            'price' => str_replace(',', '.', $request->price)
        ]);
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso criado com sucesso!');
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
        //dd($course);
        return view('courses.show', ['course' => $course]);
    }

    public function edit(Course $course)
    {
        //dd($course);
        return view('courses.edit', ['course' => $course]);
    }

    //Request $request = recupero dados do formulário
    // Course $course = recupero o registro do banco
    public function update(CourseRequest $request, Course $course)
    {
        //dd($request);
        //dd($course);

        // Incluir essa linha para validação, utilizando a classe CourseRequest
        $request->validated();

        $course->update([
            'name' => $request->name,
            'price' => str_replace(',', '.', $request->price)
        ]);

        return redirect()->route('courses.show', ['course' => $course->id])
            ->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Course $course)
    {
        //dd($course);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso excluído com sucesso!');

    }
}
