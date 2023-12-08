<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
        'قائمة الطلبات',
        'الطلبات الجديدة للبطائق',
        'الطلبات الجديدة للقيود',
        'طلبات التعديل على البيانات الاساسية',
        'التقارير',
        'تقارير كل الطلبات',
        'تقارير الطلبات التي تم الرد عليها',
        'تقرير الطلبات الملغية',
        'تقرير المستخدمين',
        'المستخدمين',
        'قائمة المستخدمين',
        'صلاحيات المستخدمين',
        'الاعدادات',
        'المحافظات',
        'المديريات',
        'المراكز',


        'اضافة طلب بطاقة جديد',
        'اضافة طلب قيد جديد',
        'عرض الطلب',
        'تصدير EXCEL',
        'تعديل الطلب',
        'طباعة الطلب',

        'اضافة مستخدم',
        'تعديل مستخدم',
        'حذف مستخدم',

        'عرض صلاحية',
        'اضافة صلاحية',
        'تعديل صلاحية',
        'حذف صلاحية',

        'اضافة محافظة',
        'تعديل محافظة',
        'حذف محافظة',

        'اضافة مديرية',
        'تعديل مديرية',
        'حذف مديرية',

        'اضافة مركز',
        'تعديل مركز',
        'حذف مركز',
        
        'مواطن',

        'الاشعارات',
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
