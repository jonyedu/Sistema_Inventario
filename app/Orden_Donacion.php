<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Orden_Donacion extends Model
{
    use SoftDeletes;

    public $table = 'ordenes_de_donacion';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'descripcion',
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
        'donador_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class)->withPivot('cantidad');

    }

    public function donador()
    {
        return $this->belongsTo(Donador::class, 'donador_id');

    }

}
