<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//classe responsável por conversar com o banco de dados => insert, select, update, delete

class Cliente extends Model
{
    protected $table = "clientes"; //nome da tabela no banco de dados


    protected $fillable = ["razao_social", "cnpj", "setor", "status"];
}
