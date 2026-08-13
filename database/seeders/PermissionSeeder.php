<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-view',

            //Users
            'user-create',
            'user-index',
            'user-edit',
            'user-destroy',

            //Roles
            'roles-create',
            'roles-index',
            'roles-edit',
            'roles-destroy',

            //brands
            'brands-create',
            'brands-index',
            'brands-edit',
            'brands-destroy',

            //warehouses
            'warehouses-create',
            'warehouses-index',
            'warehouses-edit',
            'warehouses-destroy',

            //product_categories
            'product_categories-create',
            'product_categories-index',
            'product_categories-edit',
            'product_categories-destroy',

            //sub_categories
            'sub_categories-create',
            'sub_categories-index',
            'sub_categories-edit',
            'sub_categories-destroy',

            //blogs
            'blogs-create',
            'blogs-index',
            'blogs-edit',
            'blogs-destroy',

            //coupons
            'coupons.create',
            'coupons.index',
            'coupons.edit',
            'coupons.update',

            //products
            'products.create',
            'products.index',
            'products.edit',
            'products.update',

            //pages
            'pages.create',
            'pages.index',
            'pages.edit',
            'pages.update',

            //Offer-Cat
            'offer-category.create',
            'offer-category.index',
            'offer-category.edit',
            'offer-category.update',

            //Offer
            'offer.create',
            'offer.index',
            'offer.edit',
            'offer.update',

            //products
            'product.create',
            'product.index',
            'product.edit',
            'product.update',

            //Website Pages
            'website-pages',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name'=>$permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
