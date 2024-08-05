<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 9,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 10,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 11,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 12,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            [
                'id' => 13,
                'name' => 'wards.view',
                'group' => 'wards',
            ],
            [
                'id' => 14,
                'name' => 'wards.create',
                'group' => 'wards',
            ],
            [
                'id' => 15,
                'name' => 'wards.edit',
                'group' => 'wards',
            ],
            [
                'id' => 16,
                'name' => 'wards.delete',
                'group' => 'wards',
            ],
            [
                'id' => 17,
                'name' => 'complaint.add',
                'group' => 'citizen',
            ],
            [
                'id' => 18,
                'name' => 'complaint.rejectlist',
                'group' => 'citizen',
            ],
            [
                'id' => 19,
                'name' => 'complaint.hearinglist',
                'group' => 'citizen',
            ],
            [
                'id' => 20,
                'name' => 'complaint.closelist',
                'group' => 'citizen',
            ],
            [
                'id' => 21,
                'name' => 'masters.allmasters',
                'group' => 'masters',
            ],
            [
                'id' => 22,
                'name' => 'lists.complaintlist',
                'group' => 'lists',
            ],
            [
                'id' => 23,
                'name' => 'lists.approvedcomplaintlist',
                'group' => 'lists',
            ],
            [
                'id' => 24,
                'name' => 'lists.annexureverificationlist',
                'group' => 'lists',
            ],
            [
                'id' => 25,
                'name' => 'lists.hearinglist',
                'group' => 'lists',
            ],
            [
                'id' => 26,
                'name' => 'lists.closelist',
                'group' => 'lists',
            ],
            [
                'id' => 27,
                'name' => 'lists.stopworklist',
                'group' => 'lists',
            ],
            [
                'id' => 28,
                'name' => 'lists.finalstopworklist',
                'group' => 'lists',
            ],
            [
                'id' => 29,
                'name' => 'lists.totalapplicationlist',
                'group' => 'lists',
            ],
            [
                'id' => 30,
                'name' => 'lists.explainationcalllist',
                'group' => 'lists',
            ],
            [
                'id' => 31,
                'name' => 'complaint.applicationlist',
                'group' => 'citizen',
            ],
            [
                'id' => 32,
                'name' => 'schemeDetails.module',
                'group' => 'schemeDetails',
            ],
        ];

        foreach ($permissions as $permission)
        {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
