<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Proovedor extends Model
{
    use SoftDeletes;

    public $table = 'proovedores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'email',
        'telefono',
        'descripcion',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);

    }
}
