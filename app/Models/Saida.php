<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;

    protected $table = 'saida';

    public function tipoSaida() {
        return $this->belongsTo(EntradaTipo::class, 'id_saida_tipo');
    }

    public function membro() {
        return $this->belongsTo(Membro::class, 'id_membro');
    }

    public function prestadorServico() {
        return $this->belongsTo(Membro::class, 'id_prestador_servico');
    }
}

