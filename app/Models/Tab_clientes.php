<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_clientes extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_CLIENTE';
    public $fillable = ['ID_CLIENTE','NOME','CNPJ','STATUS' ,'DATA_CAD','DATA_UPDATE'];
    use HasFactory;
}
