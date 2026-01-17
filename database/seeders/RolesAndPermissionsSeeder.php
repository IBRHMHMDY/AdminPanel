<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. تنظيف الكاش الخاص بالصلاحيات (مهم جداً لتجنب الأخطاء الغريبة)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. قائمة الصلاحيات التي نريد إضافتها
        $permissions = [
            // Restaurant Permissions
            'view_restaurants',
            'create_restaurants',
            'update_restaurants',
            'delete_restaurants',
            // Booking Permissions
            'view_bookings',
            'create_bookings',
            'update_bookings',
            'delete_bookings',
            // Table Permissions
            'view_tables',
            'create_tables',
            'update_tables',
            'delete_tables',
            // User Permissions
            'view_users',
            'create_users',
            'update_users',
        ];

        // نقوم بالدوران على كل صلاحية وإنشائها إذا لم تكن موجودة
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3. إنشاء الأدوار (أو جلبها إذا كانت موجودة)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $manager = Role::firstOrCreate(['name' => 'Restaurant Manager']);

        // 4. إعطاء الصلاحيات للأدوار
        // ملاحظة: syncPermissions أفضل من givePermissionTo في الـ Seeders
        // لأنها تضمن أن الدور يمتلك "فقط" هذه الصلاحيات ولا تكررها
        $manager->syncPermissions(['view_restaurants', 'edit_restaurants']);

        // الـ Super Admin لا يحتاج صلاحيات محددة لأننا أعطيناه صلاحية كاملة في الـ Policy،
        // لكن إن أردت يمكنك منحه كل الصلاحيات:
        $superAdmin->syncPermissions(Permission::all());

        // 5. تعيين الدور للمستخدم (تعديل الـ ID حسب الحاجة)
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'], // البحث بواسطة الإيميل
            [
                'name' => 'Ibrahim Hamdy',
                'password' => bcrypt('admin@0000'), // كلمة المرور الافتراضية
            ]
        );

        // تعيين الدور له
        $user->assignRole('Super Admin');
        // ملاحظة هامة: تأكد من تحديث صلاحيات الـ Super Admin
        // $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        // $superAdmin->syncPermissions(Permission::all()); // لضمان أنه يملك الصلاحيات الجديدة
    }
}
