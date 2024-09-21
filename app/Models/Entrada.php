<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entrada';

    public function tipoEntrada()
{
    return $this->belongsTo(EntradaTipo::class, 'id_entrada_tipo');
}

public function membro()
{
    return $this->belongsTo(Membro::class, 'id_membro');
}
}

