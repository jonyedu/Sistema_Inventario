<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'asset_create',
            ],
            [
                'id'    => '18',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '19',
                'title' => 'asset_show',
            ],
            [
                'id'    => '20',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '21',
                'title' => 'asset_access',
            ],
            [
                'id'    => '22',
                'title' => 'team_create',
            ],
            [
                'id'    => '23',
                'title' => 'team_edit',
            ],
            [
                'id'    => '24',
                'title' => 'team_show',
            ],
            [
                'id'    => '25',
                'title' => 'team_delete',
            ],
            [
                'id'    => '26',
                'title' => 'team_access',
            ],
            [
                'id'    => '27',
                'title' => 'stock_create',
            ],
            [
                'id'    => '28',
                'title' => 'stock_edit',
            ],
            [
                'id'    => '29',
                'title' => 'stock_show',
            ],
            [
                'id'    => '30',
                'title' => 'stock_delete',
            ],
            [
                'id'    => '31',
                'title' => 'stock_access',
            ],
            [
                'id'    => '32',
                'title' => 'transaction_create',
            ],
            [
                'id'    => '33',
                'title' => 'transaction_edit',
            ],
            [
                'id'    => '34',
                'title' => 'transaction_show',
            ],
            [
                'id'    => '35',
                'title' => 'transaction_delete',
            ],
            [
                'id'    => '36',
                'title' => 'transaction_access',
            ],
            [
                'id'    => '37',
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => '38',
                'title' => 'donaciones_access',
            ],
            [
                'id'    => '39',
                'title' => 'donador_create',
            ],
            [
                'id'    => '40',
                'title' => 'donador_edit',
            ],
            [
                'id'    => '41',
                'title' => 'donador_show',
            ],
            [
                'id'    => '42',
                'title' => 'donador_delete',
            ],
            [
                'id'    => '43',
                'title' => 'donador_access',
            ],

            [
                'id'    => '44',
                'title' => 'orden_donacion_create',
            ],
            [
                'id'    => '45',
                'title' => 'orden_donacion_edit',
            ],
            [
                'id'    => '46',
                'title' => 'orden_donacion_show',
            ],
            [
                'id'    => '47',
                'title' => 'orden_donacion_delete',
            ],
            [
                'id'    => '48',
                'title' => 'orden_donacion_access',
            ],
            [
                'id'    => '49',
                'title' => 'orden_donacion_download',
            ],

            [
                'id'    => '50',
                'title' => 'compras_access',
            ],
            [
                'id'    => '51',
                'title' => 'proveedor_create',
            ],
            [
                'id'    => '52',
                'title' => 'proveedor_edit',
            ],
            [
                'id'    => '53',
                'title' => 'proveedor_show',
            ],
            [
                'id'    => '54',
                'title' => 'proveedor_delete',
            ],
            [
                'id'    => '55',
                'title' => 'proveedor_access',
            ],

            [
                'id'    => '56',
                'title' => 'orden_compra_create',
            ],
            [
                'id'    => '57',
                'title' => 'orden_compra_edit',
            ],
            [
                'id'    => '58',
                'title' => 'orden_compra_show',
            ],
            [
                'id'    => '59',
                'title' => 'orden_compra_delete',
            ],
            [
                'id'    => '60',
                'title' => 'orden_compra_access',
            ],
            [
                'id'    => '61',
                'title' => 'orden_compra_download',
            ],

            [
                'id'    => '62',
                'title' => 'orden_retiro_create',
            ],
            [
                'id'    => '63',
                'title' => 'orden_retiro_edit',
            ],
            [
                'id'    => '64',
                'title' => 'orden_retiro_show',
            ],
            [
                'id'    => '65',
                'title' => 'orden_retiro_delete',
            ],
            [
                'id'    => '66',
                'title' => 'orden_retiro_access',
            ],
            [
                'id'    => '67',
                'title' => 'orden_retiro_download',
            ],
            [
                'id'    => '68',
                'title' => 'retiros_access',
            ],

            [
                'id'    => '69',
                'title' => 'cotizacion_create',
            ],
            [
                'id'    => '70',
                'title' => 'cotizacion_edit',
            ],
            [
                'id'    => '71',
                'title' => 'cotizacion_show',
            ],
            [
                'id'    => '72',
                'title' => 'cotizacion_delete',
            ],
            [
                'id'    => '73',
                'title' => 'cotizacion_access',
            ],
            [
                'id'    => '74',
                'title' => 'orden_compra_upload',
            ],
            [
                'id'    => '75',
                'title' => 'orden_donacion_upload',
            ],
            [
                'id'    => '76',
                'title' => 'orden_retiro_upload',
            ],


        ];

        Permission::insert($permissions);

    }
}
