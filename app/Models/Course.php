<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Se tabela estiver fora do padrão, informar o nome da tabela.
    // O padrão é informar a tabela no singular em Models e será criado no plural no banco
    //    protected $table = 'courses';

    // Definir as colunas da tabela que podem ser cadastradas.
    // Sempre que a tabela receber uma nova coluna, informar o nome dela aqui, se quiser que seja cadastrado
    protected $fillable = [
        'name',
        'price',
    ];
}
