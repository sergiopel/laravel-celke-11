<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Lesson extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // Se tabela estiver fora do padrão, informar o nome da tabela (no plural).
    // O padrão é criar a Model com o nome no singular e será criado no plural no banco
    //    protected $table = 'lessons';

    // Definir as colunas da tabela que podem ser cadastradas.
    // Sempre que a tabela receber uma nova coluna, informar o nome dela aqui, se quiser que seja cadastrado
    protected $fillable = [
        'name',
        'description',
        'order_lesson',
        'course_id',
    ];

    // Criar relacionamento entre a Model Lesson e a Model Course
    public function course()
    {
        // belongs significa que o Lesson pertence a Course
        return $this->belongsTo(Course::class);
    }
}
