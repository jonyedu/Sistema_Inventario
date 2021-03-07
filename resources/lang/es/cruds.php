<?php

return [
    'userManagement' => [
        'title'          => 'Manejo de Usuarios',
        'title_singular' => 'Manejo de Usuario',
    ],
    'permission'     => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Título',
            'title_helper'      => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Título',
            'title_helper'       => '',
            'permissions'        => 'Permisos',
            'permissions_helper' => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
        ],
    ],
    'user'           => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Nombre',
            'name_helper'              => '',
            'email'                    => 'Correo',
            'email_helper'             => '',
            'email_verified_at'        => 'Correo verificado en',
            'email_verified_at_helper' => '',
            'password'                 => 'Contraseña',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Creado en',
            'created_at_helper'        => '',
            'updated_at'               => 'Editado en',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Eliminado en',
            'deleted_at_helper'        => '',
            'team'                     => 'Hospital',
            'team_helper'              => '',
        ],
    ],
    'asset'         => [
        'title'          => 'Insumos',
        'title_singular' => 'Insumo',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Nombre',
            'name_helper'        => '',
            'description'        => 'Descripcion',
            'description_helper' => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
        ],
    ],
    'donador'         => [
        'title'          => 'Donadores',
        'title_singular' => 'Donador',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Nombre',
            'name_helper'        => '',
            'description'        => 'Descripcion',
            'description_helper' => '',
            'telefono'           => 'Telefono',
            'telefono_helper'    => '',
            'email'              => 'Correo',
            'email_helper'       => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
        ],
    ],
    'proovedor'         => [
        'title'          => 'Proovedores',
        'title_singular' => 'Proovedor',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Nombre',
            'name_helper'        => '',
            'description'        => 'Descripcion',
            'description_helper' => '',
            'telefono'           => 'Telefono',
            'telefono_helper'    => '',
            'email'              => 'Correo',
            'email_helper'       => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
        ],
    ],
    'orden_donacion'         => [
        'title'          => 'Ordenes de Donación',
        'title_singular' => 'Orden de Donación',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'description'        => 'Descripcion',
            'description_helper' => '',
            'insumos'           => 'Insumos',
            'insumos_helper'    => '',
            'estado'           => 'Estado',
            'estado_helper'    => '',
            'donador'           => 'Donador',
            'donador_helper'    => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
            'cantidad' => 'Cantidad',
        ],
    ],
    'team'           => [
        'title'          => 'Hospitales',
        'title_singular' => 'Hospital',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
            'name'              => 'Nombre',
            'name_helper'       => '',
        ],
    ],
    'stock'          => [
        'title'          => 'Inventario',
        'title_singular' => 'Inventario',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'asset'                => 'Insumo',
            'asset_helper'         => '',
            'current_stock'        => 'Existencias',
            'current_stock_helper' => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
            'team'                 => 'Hospital',
            'team_helper'          => '',
        ],
    ],
    'transaction'    => [
        'title'          => 'Transacciones',
        'title_singular' => 'Transacción',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'asset'             => 'Insumo',
            'asset_helper'      => '',
            'stock'             => 'Existencias',
            'stock_helper'      => '',
            'created_at'        => 'Creado en',
            'created_at_helper' => '',
            'updated_at'        => 'Editado en',
            'updated_at_helper' => '',
            'deleted_at'        => 'Eliminado en',
            'deleted_at_helper' => '',
            'team'              => 'Hospital',
            'team_helper'       => '',
            'user'              => 'Usuario',
            'user_helper'       => '',
        ],
    ],
];