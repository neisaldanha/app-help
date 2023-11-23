<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public $table = 'tab_agenda';
    public $timestamps = FALSE;
    public $primaryKey = 'id_agenda';
    public $fillable = ['id_agenda','titulo','descricao','data_agenda','cor','user'];
    
    use HasFactory;
}
