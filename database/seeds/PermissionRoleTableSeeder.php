<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        
        
        $user_jpc_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 5) != 'team_'
                && substr($permission->title, 0, 5) != 'transaction_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 19) != 'orden_retiro_upload'
                && substr($permission->title, 0, 19) != 'orden_compra_upload'
                && substr($permission->title, 0, 21) != 'orden_donacion_upload';
        });

        Role::findOrFail(2)->permissions()->sync($user_jpc_permissions);

        $user_apc_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 5) != 'team_'
                && substr($permission->title, 0, 5) != 'transaction_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 10) != 'asset_edit'
                && substr($permission->title, 0, 12) != 'asset_delete'
                && substr($permission->title, 0, 12) != 'asset_create'
                && substr($permission->title, 0, 10) != 'stock_edit'
                && substr($permission->title, 0, 12) != 'stock_delete'
                && substr($permission->title, 0, 12) != 'stock_create'
                && substr($permission->title, 0, 12) != 'donador_edit'
                && substr($permission->title, 0, 14) != 'donador_delete'
                && substr($permission->title, 0, 14) != 'donador_create'
                && substr($permission->title, 0, 14) != 'proveedor_edit'
                && substr($permission->title, 0, 16) != 'proveedor_delete'
                && substr($permission->title, 0, 16) != 'proveedor_create'
                && substr($permission->title, 0, 19) != 'orden_donacion_edit'
                && substr($permission->title, 0, 21) != 'orden_donacion_delete'
                && substr($permission->title, 0, 21) != 'orden_donacion_create'
                && substr($permission->title, 0, 21) != 'orden_donacion_upload'
                && substr($permission->title, 0, 17) != 'orden_compra_edit'
                && substr($permission->title, 0, 19) != 'orden_compra_delete'
                && substr($permission->title, 0, 19) != 'orden_compra_create'
                && substr($permission->title, 0, 19) != 'orden_compra_upload'
                && substr($permission->title, 0, 17) != 'orden_retiro_edit'
                && substr($permission->title, 0, 19) != 'orden_retiro_delete'
                && substr($permission->title, 0, 19) != 'orden_retiro_create'
                && substr($permission->title, 0, 19) != 'orden_retiro_upload'
                && substr($permission->title, 0, 15) != 'cotizacion_edit'
                && substr($permission->title, 0, 17) != 'cotizacion_delete'
                && substr($permission->title, 0, 17) != 'cotizacion_create';
        });
        
        Role::findOrFail(3)->permissions()->sync($user_apc_permissions);

        $user_jb_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 5) != 'team_'
                && substr($permission->title, 0, 5) != 'transaction_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 6) != 'asset_'
                && substr($permission->title, 0, 8) != 'donador_'
                && substr($permission->title, 0, 10) != 'proveedor_'
                && substr($permission->title, 0, 19) != 'orden_donacion_edit'
                && substr($permission->title, 0, 21) != 'orden_donacion_delete'
                && substr($permission->title, 0, 21) != 'orden_donacion_create'
                && substr($permission->title, 0, 17) != 'orden_compra_edit'
                && substr($permission->title, 0, 19) != 'orden_compra_delete'
                && substr($permission->title, 0, 19) != 'orden_compra_create'
                && substr($permission->title, 0, 17) != 'orden_retiro_edit'
                && substr($permission->title, 0, 19) != 'orden_retiro_delete'
                && substr($permission->title, 0, 19) != 'orden_retiro_create'
                && substr($permission->title, 0, 11) != 'cotizacion_';
        });

        Role::findOrFail(4)->permissions()->sync($user_jb_permissions);
    }
}
