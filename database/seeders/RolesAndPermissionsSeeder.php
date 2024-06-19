<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Staff;
use App\Models\JobType;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * List of permissions to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'follow_up_children',
        'children_information',
        'attendance',
        'departure',
        'attendance_tracking',
        'children_create',
        'meal_tracking',
        'sleep_tracking',
        'classes_activities',
        'activities',
        'classes',
        'health_safety',
        'health_records',
        'cumulative_record',
        'incident_management',
        'communicate_with_child',
        'staff_management',
        'staff_information',
        'add_staff',
        'work_scheduling',
        'staff_attendance_traking',
        'staff_salary_management',
        'users',
        'users_information',
        'add_user',
        'account_setting',
        'roles',
    ];

    public function run()
    {     
        DB::transaction(function () {
            // Create permissions
            foreach ($this->permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            }

            // Create admin role
            $roleAdmin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
            // Assign all permissions to the Admin role
            $permissions = Permission::all();
            $roleAdmin->syncPermissions($permissions);

            // create baby sitter role
            $roleBabysitter = Role::firstOrCreate(['name' => 'babySitter', 'guard_name' => 'web']);
            $permissionsBabySitter = [
                'follow_up_children',
                'children_information',
                'attendance',
                'departure',
                'attendance_tracking',
                'children_create',
                'meal_tracking',
                'sleep_tracking',
                'classes_activities',
                'activities',
                'classes',
                'health_safety',
                'health_records',
                'cumulative_record',
                'incident_management',
                'communicate_with_child',
                'staff_management',
                'staff_information',
                'add_staff',
                'work_scheduling',
                'staff_attendance_traking',
                'users',
                'users_information',
                'add_user',
                'account_setting',
            ];
            //Assign permissions to baby sitter
            $roleBabysitter->syncPermissions($permissionsBabySitter);

            // create psychology role
            $rolePsychology = Role::firstOrCreate(['name' => 'psychology', 'guard_name' => 'web']);
            $permissionsPsychology = [
                'follow_up_children',
                'children_information',
                'attendance',
                'departure',
                'attendance_tracking',
                'children_create',
                'meal_tracking',
                'sleep_tracking',
                'classes_activities',
                'activities',
                'classes',
                'health_safety',
                'health_records',
                'cumulative_record',
                'incident_management',
                'communicate_with_child'
            ];
            //Assign permissions to psychology
            $rolePsychology->syncPermissions($permissionsPsychology);
            
            // Create JobTypes
            $adminstrator = JobType::firstOrCreate([
                'name' => 'إداري'
            ]);
            $psychologies = JobType::firstOrCreate([
                'name' => 'أخصائي نفساني'
            ]);
            $babysitters = JobType::firstOrCreate([
                'name' => 'مربي'
            ]);
            
            // Create users
            $admin = User::firstOrCreate([
                'email' => 'admin@email.com',
            ], [
                'name' => 'crech admin',
                'password' => Hash::make('password')
            ]);

            $psychology = User::firstOrCreate([
                'email' => 'psychology@email.com',
            ], [
                'name' => 'Psycology Name',
                'password' => Hash::make('psychology')
            ]);

            $babysitter = User::firstOrCreate([
                'email' => 'babysitter@email.com',
            ], [
                'name' => 'Baby Sitter',
                'password' => Hash::make('babysitter')
            ]);

            // create Staff
            $adminStaff = Staff::firstOrCreate([
                'name' => 'crech admin',
                'birthdate' => '1990-01-10',
                'gender' => 'ذكر',
                'address' => 'حي المجاهدين رقم 722',
                'phone_number' => '+2137895969696',
                'email' => 'admin@email.com',
                'job_title' => 'مدير حاضنة',
                'hire_date' => '2023-01-01',
                'salary' => NULL,
                'image' => NULL,
                'notes' => NULL,
                'job_type_id' =>1,
                'user_id' => $admin->id,
            ]);

            $psychologyStaff = Staff::firstOrCreate([
                'name' => 'Psycology Name',
                'birthdate' => '1993-01-10',
                'gender' => 'ذكر',
                'address' => 'حي المجاهدين رقم 999',
                'phone_number' => '+213783333233',
                'email' => 'psychology@email.com',
                'job_title' => ' أخصائي نفساني',
                'hire_date' => '2023-07-01',
                'salary' => NULL,
                'image' => NULL,
                'notes' => NULL,
                'job_type_id' => 2,
                'user_id' => $psychology->id,
            ]);

            $babysitterStaff = Staff::firstOrCreate([
                'name' => 'Baby Sitter',
                'birthdate' => '1995-01-10',
                'gender' => 'ذكر',
                'address' => 'حي الزيتون رقم 10/12',
                'phone_number' => '+2137698856583',
                'email' => 'babysitter@email.com',
                'job_title' => 'مربي أطفال',
                'hire_date' => '2023-10-01',
                'salary' => NULL,
                'image' => NULL,
                'notes' => NULL,
                'job_type_id' => 3,
                'user_id' => $babysitter->id,
            ]);
            
            // Assign roles to users
            $admin->assignRole($roleAdmin);
            $psychology->assignRole($rolePsychology);
            $babysitter->assignRole($roleBabysitter);
        });
    }
}
