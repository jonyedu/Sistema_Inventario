<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Orden_Compra extends Model
{

    use SoftDeletes;

    public $table = 'ordenes_de_compra';

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
        'proveedor_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class)->withPivot('cantidad');

    }

    public function proveedor()
    {
        return $this->belongsTo(Proovedor::class, 'proveedor_id');

    }
}

