<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arq_alunos_historico_ordem_fechados extends Model
{
    protected $table = 'arq_alunos_historico_ordem_fechado';
    public $timestamps = FALSE;
    public $primaryKey = 'id';
    public $fillable = [
        'id_cadastro', 'ano_corrente', 'semestre_corrente', 'id_vinculo', 'ano', 'semestre', 'periodo',
        'periodo_numero', 'id_unidade', 'unidade', 'nota', 'choraria', 'situacao', 'docente', 'titulacao',
        'titulacao', 'optativa', 'print', 'timex', 'data_time', 'ip', 'user', 'user_alteracao', 'ip_alteracao',
    ];

    use HasFactory;
}
