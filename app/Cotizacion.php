<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Cotizacion extends Model
{

    use SoftDeletes;

    public $table = 'asset_proovedor';

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
        'proovedor_id',
        'asset_id',
        'precio',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function proveedor()
    {
        return $this->belongsTo(Proovedor::class, 'proovedor_id');

    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');

    }
}

