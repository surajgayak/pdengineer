<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',

            // 'category_view',
            // 'category_create',
            // 'category_edit',

            // 'product_view',
            // 'product_create',
            // 'product_edit',
            // 'product_delete',

            // 'services_view',
            // 'services_create',
            // 'services_edit',
            // 'services_delete',

            // 'projects_view',
            // 'projects_create',
            // 'projects_edit',
            // 'projects_delete',

            // 'clients_partners_view',
            // 'clients_partners_create',
            // 'clients_partners_edit',
            // 'clients_partners_delete',

            // 'portfolio_view',
            // 'portfolio_create',
            // 'portfolio_edit',
            // 'portfolio_delete',

            // 'company_document_view',
            // 'company_document_create',
            // 'company_document_edit',
            // 'company_document_delete',
            // 'company_document_download',

            'bank_guarantee_retention_money_view',
            'bank_guarantee_retention_money_create',
            'bank_guarantee_retention_money_edit',
            'bank_guarantee_retention_money_delete',
            'bank_guarantee_retention_money_update_status',


            'tracking_project_view',
            'tracking_project_create',
            'tracking_project_edit',
            'tracking_project_delete',
            'tracking_project_timeline',
            'tracking_project_update_status',

            // 'stock_management_view',
            // 'stock_management_create',
            // 'stock_management_edit',

            // 'slider_view',
            // 'slider_create',
            // 'slider_edit',
            // 'slider_delete',



            'settings'




        ];
        foreach ($permissions as $permission) :
            Permission::create(['name' => $permission]);
        endforeach;
    }
}
