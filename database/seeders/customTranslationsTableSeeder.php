<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class customTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds for custom translation.
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $custom =[
            [
                "key"=> "job_name",
                "value"=> [
                    "ar"=> "المسمى الوظيفى",
                    "en"=> "job  name"
                ]
            ],
            [
                "key"=> "tag",
                "value"=> [
                    "ar"=> "وسم",
                    "en"=> "tag"
                ]
            ],
            [
                "key"=> "title",
                "value"=> [
                    "ar"=> "عنوان - لقب",
                    "en"=> "Title"
                ]
            ],
            [
                "key"=> "name",
                "value"=> [
                    "ar"=> "اسم",
                    "en"=> "Name"
                ]
            ],
            [
                "key"=> "copy",
                "value"=> [
                    "ar"=> "نسخه",
                    "en"=> "Copy"
                ]
            ],
            [
                "key"=> "index",
                "value"=> [
                    "ar"=> "فهرس",
                    "en"=> "Index"
                ]
            ],
            [
                "key"=> "language",
                "value"=> [
                    "ar"=> "لغه",
                    "en"=> "Language"
                ]
            ],
            [
                "key"=> "dashboard",
                "value"=> [
                    "ar"=> "لوحه الاعدادات",
                    "en"=> "DashBoard"
                ]
            ],
            [
                "key"=> "create",
                "value"=> [
                    "ar"=> "انشاء",
                    "en"=> "Create"
                ]
            ],
            [
                "key"=> "status",
                "value"=> [
                    "ar"=> "الحاله",
                    "en"=> "Status"
                ]
            ],
            [
                "key"=> "controller",
                "value"=> [
                    "ar"=> "تحكم",
                    "en"=> "Controller"
                ]
            ],
            [
                "key"=> "an_active",
                "value"=> [
                    "ar"=> "غير مفعل",
                    "en"=> "An Active"
                ]
            ],
            [
                "key"=> "active",
                "value"=> [
                    "ar"=> "مفعل",
                    "en"=> "Active"
                ]
            ],
            [
                "key"=> "edit",
                "value"=> [
                    "ar"=> "تعديل",
                    "en"=> "Edit"
                ]
            ],
            [
                "key"=> "code",
                "value"=> [
                    "ar"=> "رمز",
                    "en"=> "Code"
                ]
            ],
            [
                "key"=> "order",
                "value"=> [
                    "ar"=> "ترتيب",
                    "en"=> "Order"
                ]
            ],
            [
                "key"=> "media",
                "value"=> [
                    "ar"=> "وسائل الاعلام",
                    "en"=> "Media"
                ]
            ],
            [
                "key"=> "image",
                "value"=> [
                    "ar"=> "صورة",
                    "en"=> "Image"
                ]
            ],
            [
                "key"=> "core_data",
                "value"=> [
                    "ar"=> "البيانات الاساسية",
                    "en"=> "Core Data"
                ]
            ],
            /*[
                "key"=> "country",
                "value"=> [
                    "ar"=> "الدوله",
                    "en"=> "Country"
                ]
            ],
            [
                "key"=> "city",
                "value"=> [
                    "ar"=> "مدينة",
                    "en"=> "City"
                ]
            ],
            [
                "key"=> "state",
                "value"=> [
                    "ar"=> "منطقة",
                    "en"=> "State"
                ]
            ],*/
            [
                "key"=> "select",
                "value"=> [
                    "ar"=> "اختار",
                    "en"=> "Select"
                ]
            ],
            [
                "key"=> "delete",
                "value"=> [
                    "ar"=> "يمحو",
                    "en"=> "Delete"
                ]
            ],
            [
                "key"=> "amenity",
                "value"=> [
                    "ar"=> "اعتدال",
                    "en"=> "Amenity"
                ]
            ],
            [
                "key"=> "category",
                "value"=> [
                    "ar"=> "مجالات",
                    "en"=> "Category"
                ]
            ],
            [
                "key"=> "highlight",
                "value"=> [
                    "ar"=> "عنوان رئيسى",
                    "en"=> "High Light"
                ]
            ],
            [
                "key"=> "package",
                "value"=> [
                    "ar"=> "حزمة",
                    "en"=> "Package"
                ]
            ],
            [
                "key"=> "type",
                "value"=> [
                    "ar"=> "نوع",
                    "en"=> "Type"
                ]
            ],
            [
                "key"=> "update",
                "value"=> [
                    "ar"=> "تحديث",
                    "en"=> "Update"
                ]
            ],
            [
                "key"=> "year",
                "value"=> [
                    "ar"=> "سنه",
                    "en"=> "year"
                ]
            ],
            [
                "key"=> "day",
                "value"=> [
                    "ar"=> "يوم",
                    "en"=> "day"
                ]
            ],
            [
                "key"=> "month",
                "value"=> [
                    "ar"=> "شهر",
                    "en"=> "month"
                ]
            ],
            [
                "key"=> "listing",
                "value"=> [
                    "ar"=> "تسجيل",
                    "en"=> "Listing"
                ]
            ],
            [
                "key"=> "type_date",
                "value"=> [
                    "ar"=> "ادخال التاريخ",
                    "en"=> "Type"
                ]
            ],
            [
                "key"=> "close",
                "value"=> [
                    "ar"=> "غلق",
                    "en"=> "Close"
                ]
            ],
            [
                "key"=> "social",
                "value"=> [
                    "ar"=> "اجتماعى",
                    "en"=> "Social"
                ]
            ],
            [
                "key"=> "count_date",
                "value"=> [
                    "ar"=> "التاريخ",
                    "en"=> "Count"
                ]
            ],
            [
                "key"=> "home",
                "value"=> [
                    "ar"=> "الرئيسى",
                    "en"=> "Home"
                ]
            ],
            [
                "key"=> "delete_message",
                "value"=> [
                    "ar"=> "ازالة الرساله",
                    "en"=> "Are you Need To Delete This"
                ]
            ],
            [
                "key"=> "delete_index_message",
                "value"=> [
                    "ar"=> "ازالة الرساله المحررة",
                    "en"=> "Data you Deleted At Before"
                ]
            ],
            [
                "key"=> "enter_name",
                "value"=> [
                    "ar"=> "ادراج الاسم",
                    "en"=> "Enter Title"
                ]
            ],
            [
                "key"=> "enter_code",
                "value"=> [
                    "ar"=> "ادراج الكود",
                    "en"=> "Enter Code"
                ]
            ],
            [
                "key"=> "enter_order",
                "value"=> [
                    "ar"=> "ادخال الاوردر",
                    "en"=> "Enter Order"
                ]
            ],
            [
                "key"=> "enter_listing",
                "value"=> [
                    "ar"=> "ادخال القائمة",
                    "en"=> "Enter Listing"
                ]
            ],
            [
                "key"=> "enter_count_date",
                "value"=> [
                    "ar"=> "ادراج التاريخ",
                    "en"=> "Enter Count"
                ]
            ],
            [
                "key"=> "create_done",
                "value"=> [
                    "ar"=> "تم الانشاء",
                    "en"=> "Create Done"
                ]
            ],
            [
                "key"=> "done",
                "value"=> [
                    "ar"=> "تم الانتهاء",
                    "en"=> "Done"
                ]
            ],
            [
                "key"=> "edit_done",
                "value"=> [
                    "ar"=> "تعديل بعد الانتهاء",
                    "en"=> "Edit Done"
                ]
            ],
            [
                "key"=> "delete_done",
                "value"=> [
                    "ar"=> "محو ما تم انجازة",
                    "en"=> "Delete Done"
                ]
            ],
            [
                "key"=> "an_active_done",
                "value"=> [
                    "ar"=> "عدم التشغيل",
                    "en"=> "An Active Done"
                ]
            ],
            [
                "key"=> "active_done",
                "value"=> [
                    "ar"=> "تشغيل",
                    "en"=> "Active Done"
                ]
            ],
            [
                "key"=> "meta",
                "value"=> [
                    "ar"=> "ميتا",
                    "en"=> "Meta"
                ]
            ],
            [
                "key"=> "setting",
                "value"=> [
                    "ar"=> "الاعدادات",
                    "en"=> "Setting"
                ]
            ],
            [
                "key"=> "role",
                "value"=> [
                    "ar"=> "دور",
                    "en"=> "Role"
                ]
            ],
            [
                "key"=> "acl",
                "value"=> [
                    "ar"=> "اداره المستخدمين",
                    "en"=> "Acl"
                ]
            ],
            [
                "key"=> "permission",
                "value"=> [
                    "ar"=> "تصريح",
                    "en"=> "Permission"
                ]
            ],
            [
                "key"=> "type_access",
                "value"=> [
                    "ar"=> "نوع التصريح",
                    "en"=> "Type Access"
                ]
            ],
            [
                "key"=> "all",
                "value"=> [
                    "ar"=> "كل",
                    "en"=> "All"
                ]
            ],
            [
                "key"=> "user",
                "value"=> [
                    "ar"=> "المستخدم",
                    "en"=> "User"
                ]
            ],
            [
                "key"=> "full_name",
                "value"=> [
                    "ar"=> "الاسم بالكامل",
                    "en"=> "Full Name"
                ]
            ],
            [
                "key"=> "user_name",
                "value"=> [
                    "ar"=> "اسم المستخدم",
                    "en"=> "User Name"
                ]
            ],
            [
                "key"=> "email",
                "value"=> [
                    "ar"=> "البريد الالكترونى",
                    "en"=> "Email"
                ]
            ],
            [
                "key"=> "password",
                "value"=> [
                    "ar"=> "كلمة المرور",
                    "en"=> "Password"
                ]
            ],
            [
                "key"=> "password_confirmation",
                "value"=> [
                    "ar"=> "تأكيد كلمة المرور",
                    "en"=> "Password Confirmation"
                ]
            ],
            [
                "key"=> "enter_full_name",
                "value"=> [
                    "ar"=> "ادخال الاسم بالكامل",
                    "en"=> "Enter Full Name"
                ]
            ],
            [
                "key"=> "enter_user_name",
                "value"=> [
                    "ar"=> "ادخال اسم المستخدم",
                    "en"=> "Enter User Name"
                ]
            ],
            [
                "key"=> "enter_email",
                "value"=> [
                    "ar"=> "ادخال البريد الالكترونى",
                    "en"=> "Enter Email"
                ]
            ],
            [
                "key"=> "enter_password",
                "value"=> [
                    "ar"=> "ادخال كلمة المرور",
                    "en"=> "Enter Password"
                ]
            ],
            [
                "key"=> "enter_password_confirmation",
                "value"=> [
                    "ar"=> "الضغط على تأكيد كلمة المرور",
                    "en"=> "Enter Password Confirmation"
                ]
            ],
            [
                "key"=> "mobile",
                "value"=> [
                    "ar"=> "رقم الموبايل",
                    "en"=> "Mobile"
                ]
            ],
            [
                "key"=> "enter_mobile",
                "value"=> [
                    "ar"=> "ادخال رقم الموبايل",
                    "en"=> "Enter Mobile"
                ]
            ],
            [
                "key"=> "gender",
                "value"=> [
                    "ar"=> "النوع",
                    "en"=> "Gender"
                ]
            ],
            [
                "key"=> "male",
                "value"=> [
                    "ar"=> "ذكر",
                    "en"=> "Male"
                ]
            ],
            [
                "key"=> "famel",
                "value"=> [
                    "ar"=> "انثى",
                    "en"=> "Famel"
                ]
            ],
            [
                "key"=> "dob",
                "value"=> [
                    "ar"=> "تاريخ الميلاد",
                    "en"=> "Birth Day"
                ]
            ],
            [
                "key"=> "agecny",
                "value"=> [
                    "ar"=> "الشركه",
                    "en"=> "agecny"
                ]
            ],
            [
                "key"=> "subject",
                "value"=> [
                    "ar"=> "الموضوع",
                    "en"=> "Subject"
                ]
            ],
            [
                "key"=> "message",
                "value"=> [
                    "ar"=> "الرساله",
                    "en"=> "Message"
                ]
            ],
            [
                "key"=> "nationality",
                "value"=> [
                    "ar"=> "الجنسيه",
                    "en"=> "Nationality"
                ]
            ],
            [
                "key"=> "message_support",
                "value"=> [
                    "ar"=> "دعم الرساله",
                    "en"=> "Places Call Admin"
                ]
            ],
            [
                "key"=> "avatar",
                "value"=> [
                    "ar"=> "افاتار",
                    "en"=> "Avatar"
                ]
            ],
            [
                "key"=> "job_value",
                "value"=> [
                    "ar"=> "تقييم العمل",
                    "en"=> "Job_value"
                ]
            ],
            [
                "key"=> "thank_you",
                "value"=> [
                    "ar"=> "شكرا",
                    "en"=> "Thank you"
                ]
            ],
            [
                "key"=> "approve",
                "value"=> [
                    "ar"=> "موافقه",
                    "en"=> "Approve"
                ]
            ],
            [
                "key"=> "approve_done",
                "value"=> [
                    "ar"=> "تمت الموافقه",
                    "en"=> "Approve Done"
                ]
            ],
            [
                "key"=> "index_system",
                "value"=> [
                    "ar"=> "نظام الجدوله",
                    "en"=> "Index System"
                ]
            ],
            [
                "key"=> "index_client",
                "value"=> [
                    "ar"=> "ترقيم العميل",
                    "en"=> "Index Client"
                ]
            ],
            [
                "key"=> "index_freelance",
                "value"=> [
                    "ar"=> "تحديد الفرى لانس",
                    "en"=> "Index Freelance"
                ]
            ],
            [
                "key"=> "index_active",
                "value"=> [
                    "ar"=> "تفعيل الفهرسه",
                    "en"=> "Index Active"
                ]
            ],
            [
                "key"=> "index_unactive",
                "value"=> [
                    "ar"=> "عدم تفعيل الفهرسه",
                    "en"=> "Index UnActive"
                ]
            ],
            [
                "key"=> "index_approve",
                "value"=> [
                    "ar"=> "قبول الفهرسه",
                    "en"=> "Index Approve"
                ]
            ],
            [
                "key"=> "index_rejectapprove",
                "value"=> [
                    "ar"=> "فهرس الرفض",
                    "en"=> "Index reject Approve"
                ]
            ],
            [
                "key"=> "index_unapprove",
                "value"=> [
                    "ar"=> "عدم قبول الفهرسه",
                    "en"=> "Index UnApprove"
                ]
            ],
            [
                "key"=> "index_verified",
                "value"=> [
                    "ar"=> "تم تأكيد الفهرسة",
                    "en"=> "Index Verified"
                ]
            ],
            [
                "key"=> "index_unverified",
                "value"=> [
                    "ar"=> "عدم تأكيد الفهرسه",
                    "en"=> "Index UnVerified"
                ]
            ],
            [
                "key"=> "problem",
                "value"=> [
                    "ar"=> "مشكله",
                    "en"=> "Sorry But there Was an issue in saving Data please try again"
                ]
            ],
            [
                "key"=> "accept",
                "value"=> [
                    "ar"=> "قبول",
                    "en"=> "accept"
                ]
            ],
            [
                "key"=> "reject",
                "value"=> [
                    "ar"=> "الرفض",
                    "en"=> "reject"
                ]
            ],
            [
                "key"=> "an_approve_done",
                "value"=> [
                    "ar"=> "اتمام القبول",
                    "en"=> "An Approve Done"
                ]
            ],
            [
                "key"=> "reject_title",
                "value"=> [
                    "ar"=> "رفض العنوان",
                    "en"=> "places write reject comment"
                ]
            ],
            [
                "key"=> "commit",
                "value"=> [
                    "ar"=> "تم التنفيذ",
                    "en"=> "commit"
                ]
            ],
            [
                "key"=> "created_at",
                "value"=> [
                    "ar"=> "انشاء فى",
                    "en"=> "create at"
                ]
            ],
            [
                "key"=> "approve_at",
                "value"=> [
                    "ar"=> "الموافقه على",
                    "en"=> "approve at"
                ]
            ],
            [
                "key"=> "level",
                "value"=> [
                    "ar"=> "مستوى",
                    "en"=> "Level"
                ]
            ],
            [
                "key"=> "enter_level",
                "value"=> [
                    "ar"=> "ادخال المستوى",
                    "en"=> "Enter Level"
                ]
            ],
            [
                "key"=> "contact_us",
                "value"=> [
                    "ar"=> "اتصل بنا",
                    "en"=> "Contact Us"
                ]
            ],
            [
                "key"=> "contactus",
                "value"=> [
                    "ar"=> "اتصل بنا",
                    "en"=> "Contact Us"
                ]
            ],
            [
                "key"=> "description",
                "value"=> [
                    "ar"=> "وصف",
                    "en"=> "Description"
                ]
            ],
            [
                "key"=> "failed",
                "value"=> [
                    "ar"=> "فشل التسجيل",
                    "en"=> "These credentials do not match our records"
                ]
            ],
            [
                "key"=> "failed_password",
                "value"=> [
                    "ar"=> "كلمة مرور خاطئة",
                    "en"=> "The provided password is incorrect."
                ]
            ],
            [
                "key"=> "password_change",
                "value"=> [
                    "ar"=> "تغيير كلمة المرور",
                    "en"=> "The password change sucseed."
                ]
            ],
            [
                "key"=> "throttle",
                "value"=> [
                    "ar"=> "محاولات عديده للدخول.. من فضلك حاول مره اخرى بعد فترة",
                    "en"=> "Too many login attempts. Please try again in =>seconds seconds."
                ]
            ],
            [
                "key"=> "login",
                "value"=> [
                    "ar"=> "تسجيل - دخول",
                    "en"=> "login success"
                ]
            ],
            [
                "key"=> "login_here",
                "value"=> [
                    "ar"=> "الدخول من هنا",
                    "en"=> "login here"
                ]
            ],
            [
                "key"=> "register_here",
                "value"=> [
                    "ar"=> "التسجيل هنا",
                    "en"=> "register here"
                ]
            ],
            [
                "key"=> "support",
                "value"=> [
                    "ar"=> "الدعم",
                    "en"=> "call support"
                ]
            ],
            [
                "key"=> "wait_approve",
                "value"=> [
                    "ar"=> "انتظار الموافقه",
                    "en"=> "wait approve"
                ]
            ],
            [
                "key"=> "verified",
                "value"=> [
                    "ar"=> "تم التأكيد",
                    "en"=> "you must verified your email first"
                ]
            ],
            [
                "key"=> "verified_here",
                "value"=> [
                    "ar"=> "تأكد من هنا",
                    "en"=> "verify here"
                ]
            ],
            [
                "key"=> "register_before",
                "value"=> [
                    "ar"=> "التسجيل اولا",
                    "en"=> "register before"
                ]
            ],
            [
                "key"=> "login_first",
                "value"=> [
                    "ar"=> "الدخول اولا",
                    "en"=> "places login"
                ]
            ],
            [
                "key"=> "code_wrong",
                "value"=> [
                    "ar"=> "كود خاطيئ",
                    "en"=> "code wrong"
                ]
            ],
            [
                "key"=> "code_send",
                "value"=> [
                    "ar"=> "تم ارسال الكود",
                    "en"=> "check your mobile"
                ]
            ],
            [
                "key"=> "code_used",
                "value"=> [
                    "ar"=> "كود مستخدم من قبل",
                    "en"=> "this code used before"
                ]
            ],
            [
                "key"=> "register_message",
                "value"=> [
                    "ar"=> "تسجيل الرساله",
                    "en"=> "Register Done places check your email"
                ]
            ],
            [
                "key"=> "verify_message",
                "value"=> [
                    "ar"=> "تم التأكيد.. برجاء الانتظار لحين الموافقه على حسابك من قبل الادمن",
                    "en"=> "Verify Done places wait admin to approve your account"
                ]
            ],
            [
                "key"=> "verify_title",
                "value"=> [
                    "ar"=> "التأكيد من عنوان الرساله",
                    "en"=> "Mail for verify 00"
                ]
            ],
            [
                "key"=> "verify_body",
                "value"=> [
                    "ar"=> "التأكيد من مكضمون الرساله",
                    "en"=> "Mail for verify"
                ]
            ],
            [
                "key"=> "wait_approve_title",
                "value"=> [
                    "ar"=> "انتظر لحين الموافقه على العنوان",
                    "en"=> "wait approve admin00"
                ]
            ],
            [
                "key"=> "wait_approve_body",
                "value"=> [
                    "ar"=> "انتظر لحين الموافقه على مضمون الرساله",
                    "en"=> "wait approve admin"
                ]
            ],
            [
                "key"=> "accept_approve_title",
                "value"=> [
                    "ar"=> "تم الموافقه على العنوان",
                    "en"=> "approve accept"
                ]
            ],
            [
                "key"=> "accept_approve_body",
                "value"=> [
                    "ar"=> "تم الموافقه على مضمون الرساله",
                    "en"=> "approve accept , places try login"
                ]
            ],
            [
                "key"=> "reject_approve_title",
                "value"=> [
                    "ar"=> "رفض عنوان الرساله",
                    "en"=> "approve reject"
                ]
            ],
            [
                "key"=> "reject_approve_body",
                "value"=> [
                    "ar"=> "رفض مضمون الرساله",
                    "en"=> "approve reject , commit =>"
                ]
            ],
            [
                "key"=> "customtranslation",
                "value"=> [
                    "ar"=> "ترجمه مخصصه",
                    "en"=> "Custom Translation"
                ]
            ],
            [
                "key"=> "key",
                "value"=> [
                    "ar"=> "الرمز",
                    "en"=> "Key"
                ]
            ],
            [
                "key"=> "value",
                "value"=> [
                    "ar"=> "القيمة",
                    "en"=> "Value"
                ]
            ],
            [
                "key"=> "enter_key",
                "value"=> [
                    "ar"=> "ادخال الرمز",
                    "en"=> "Enter Key"
                ]
            ],
            [
                "key"=> "enter_value",
                "value"=> [
                    "ar"=> "ادخال القيمة",
                    "en"=> "Enter Value"
                ]
            ],
            [
                "key"=> "login_page",
                "value"=> [
                    "ar"=> "صفحة الدخول",
                    "en"=> "Login"
                ]
            ],
            [
                "key"=> "login_start",
                "value"=> [
                    "ar"=> "بدء الدخول",
                    "en"=> "Sign in to start your session"
                ]
            ],
            [
                "key"=> "sign_in",
                "value"=> [
                    "ar"=> "الدخول",
                    "en"=> "Sign In"
                ]
            ],
            [
                "key"=> "404",
                "value"=> [
                    "ar"=> "خطأ فى السيرفر",
                    "en"=> "404 Page not found"
                ]
            ],
            [
                "key"=> "oops",
                "value"=> [
                    "ar"=> "حدث خطأ ما",
                    "en"=> "Oops! Page not found."
                ]
            ],
            [
                "key"=> "email_approve",
                "value"=> [
                    "ar"=> "قبول البريد الالكترونى",
                    "en"=> "email approve"
                ]
            ],
            [
                "key"=> "mobile_approve",
                "value"=> [
                    "ar"=> "قبول رقم المحمول",
                    "en"=> "mobile approve"
                ]
            ],
            [
                "key"=> "country_id",
                "value"=> [
                    "ar"=> "رمز الدوله",
                    "en"=> "country"
                ]
            ],
            [
                "key"=> "role_id",
                "value"=> [
                    "ar"=> "وصف",
                    "en"=> "role"
                ]
            ],
            [
                "key"=> "state_id",
                "value"=> [
                    "ar"=> "رمز المنطقة",
                    "en"=> "state"
                ]
            ],
            [
                "key"=> "status_id",
                "value"=> [
                    "ar"=> "حاله",
                    "en"=> "status"
                ]
            ],
            [
                "key"=> "user_id",
                "value"=> [
                    "ar"=> "المستخدم",
                    "en"=> "user"
                ]
            ],
            [
                "key"=> "or",
                "value"=> [
                    "ar"=> "او",
                    "en"=> "or"
                ]
            ],
            [
                "key"=> "verified_manule",
                "value"=> [
                    "ar"=> "التأكيد يدويا",
                    "en"=> "تاكيد"
                ]
            ],
            [
                "key"=> "next",
                "value"=> [
                    "ar"=> "التالى",
                    "en"=> "next"
                ]
            ],
            [
                "key"=> "last",
                "value"=> [
                    "ar"=> "الاخير",
                    "en"=> "last"
                ]
            ],
            [
                "key"=> "of",
                "value"=> [
                    "ar"=> "من",
                    "en"=> "of"
                ]
            ],
            [
                "key"=> "displaying",
                "value"=> [
                    "ar"=> "ابراز",
                    "en"=> "Displaying"
                ]
            ],
            [
                "key"=> "records",
                "value"=> [
                    "ar"=> "تسجيل",
                    "en"=> "records"
                ]
            ],
            [
                "key"=> "online",
                "value"=> [
                    "ar"=> "عن بعد",
                    "en"=> "online"
                ]
            ],
            [
                "key"=> "offline",
                "value"=> [
                    "ar"=> "بالحضور",
                    "en"=> "offline"
                ]
            ],
            [
                "key"=> "week",
                "value"=> [
                    "ar"=> "اسبوع",
                    "en"=> "week"
                ]
            ],
            [
                "key"=> "client",
                "value"=> [
                    "ar"=> "عميل",
                    "en"=> "client"
                ]
            ],
            [
                "key"=> "count",
                "value"=> [
                    "ar"=> "عدد",
                    "en"=> "count"
                ]
            ],
            [
                "key"=> "to",
                "value"=> [
                    "ar"=> "الى",
                    "en"=> "to"
                ]
            ],
            [
                "key"=> "from",
                "value"=> [
                    "ar"=> "من",
                    "en"=> "from"
                ]
            ],
            [
                "key"=> "skill_validation",
                "value"=> [
                    "ar"=> "التحقق من المهارات",
                    "en"=> "skill must be min =>count"
                ]
            ],
            [
                "key"=> "index_freelancer",
                "value"=> [
                    "ar"=> "فهرسة الفرى لانس",
                    "en"=> "Index Freelancer"
                ]
            ],
            [
                "key"=> "index_company",
                "value"=> [
                    "ar"=> "فهرسه الشركه",
                    "en"=> "Index company"
                ]
            ],
            [
                "key"=> "done_by",
                "value"=> [
                    "ar"=> "تم بواسطة",
                    "en"=> "done by"
                ]
            ],
            [
                "key"=> "logout",
                "value"=> [
                    "ar"=> "تسجيل الخروج",
                    "en"=> "logout"
                ]
            ],
            [
                "key"=> "logout_done",
                "value"=> [
                    "ar"=> "تم تسجيل الخروج",
                    "en"=> "logout Done"
                ]
            ],
            [
                "key"=> "favourite",
                "value"=> [
                    "ar"=> "المفضله",
                    "en"=> "Favourite"
                ]
            ],
            [
                "key"=> "unactive",
                "value"=> [
                    "ar"=> "غير مفعل",
                    "en"=> "unactive"
                ]
            ],
            [
                "key"=> "more_info",
                "value"=> [
                    "ar"=> "معلومات اضافيه",
                    "en"=> "More info"
                ]
            ],
            [
                "key"=> "forgot_password",
                "value"=> [
                    "ar"=> "نسيت كلمة المرور",
                    "en"=> "I forgot my password"
                ]
            ],
            [
                "key"=> "recover_password",
                "value"=> [
                    "ar"=> "استعادة كلمة المرور",
                    "en"=> "Recover Password"
                ]
            ],
            [
                "key"=> "forgot_password_title",
                "value"=> [
                    "ar"=> "نسيت عنوان كلمة المرور",
                    "en"=> "forgot password"
                ]
            ],
            [
                "key"=> "request_password",
                "value"=> [
                    "ar"=> "طلب كلمة المرور",
                    "en"=> "Request new password"
                ]
            ],
            [
                "key"=> "message_recover_password",
                "value"=> [
                    "ar"=> "رسالة استعادة كلمة المرور",
                    "en"=> "You are only one step a way from your new password, recover your password now."
                ]
            ],
            [
                "key"=> "message_forgot_password",
                "value"=> [
                    "ar"=> "رسالة عند نسيان كلمة المرور",
                    "en"=> "You forgot your password? Here you can easily retrieve a new password."
                ]
            ],
            [
                "key"=> "login_button",
                "value"=> [
                    "ar"=> "زر الدخول او التسجيل",
                    "en"=> "login"
                ]
            ],
            [
                "key"=> "confirm_password",
                "value"=> [
                    "ar"=> "تأكيد كلمة المرور",
                    "en"=> "Confirm Password"
                ]
            ],
            [
                "key"=> "pusher",
                "value"=> [
                    "ar"=> "يدفع",
                    "en"=> "pusher"
                ]
            ],
            [
                "key"=> "receiver",
                "value"=> [
                    "ar"=> "المرسل اليه",
                    "en"=> "receiver"
                ]
            ],
            [
                "key"=> "enter_fullname",
                "value"=> [
                    "ar"=> "ادخال الاسم بالكامل",
                    "en"=> "Enter fullname"
                ]
            ],
            [
                "key"=> "fullname",
                "value"=> [
                    "ar"=> "الاسم بالكامل",
                    "en"=> "fullname"
                ]
            ],
            [
                "key"=> "username",
                "value"=> [
                    "ar"=> "اسم المستخدم",
                    "en"=> "username"
                ]
            ],
            [
                "key"=> "display_name",
                "value"=> [
                    "ar"=> "عرض الاسم",
                    "en"=> "display name"
                ]
            ],
            [
                "key"=> "reports",
                "value"=> [
                    "ar"=> "تقارير",
                    "en"=> "Reports"
                ]
            ],
            [
                "key"=> "report_user",
                "value"=> [
                    "ar"=> "مستخدم التقرير",
                    "en"=> "user Reports"
                ]
            ],
            [
                "key"=> "report_ads",
                "value"=> [
                    "ar"=> "اعلانات التقارير",
                    "en"=> "ads Reports"
                ]
            ],
            [
                "key"=> "report_task",
                "value"=> [
                    "ar"=> "مهام التقارير",
                    "en"=> "task Reports"
                ]
            ],
            [
                "key"=> "solved",
                "value"=> [
                    "ar"=> "تم الحل",
                    "en"=> "solved"
                ]
            ],
            [
                "key"=> "solved_by",
                "value"=> [
                    "ar"=> "تم الحل بواسطة",
                    "en"=> "solved By"
                ]
            ],
            [
                "key"=> "page",
                "value"=> [
                    "ar"=> "صفحه",
                    "en"=> "Page"
                ]
            ],
            [
                "key"=> "mail_confighost",
                "value"=> [
                    "ar"=> "اعدادات ميل المضيف",
                    "en"=> "mail config Host"
                ]
            ],
            [
                "key"=> "mail_config_port",
                "value"=> [
                    "ar"=> "اعدادات بورت الميل",
                    "en"=> "mail config port"
                ]
            ],
            [
                "key"=> "mail_config_encryption",
                "value"=> [
                    "ar"=> "mail config encryption",
                    "en"=> "mail config encryption"
                ]
            ],
            [
                "key"=> "mail_config_address",
                "value"=> [
                    "ar"=> "اعدادات الميل",
                    "en"=> "mail config address"
                ]
            ],
            [
                "key"=> "mail_config_password",
                "value"=> [
                    "ar"=> "اعدادات كلمه مرور الميل",
                    "en"=> "mail config password"
                ]
            ],
            [
                "key"=> "skill_count_required",
                "value"=> [
                    "ar"=> "skill count required",
                    "en"=> "skill count required"
                ]
            ],
            [
                "key"=> "performers_profile_open",
                "value"=> [
                    "ar"=> "فتح ملف المستخدم",
                    "en"=> "performers profile open"
                ]
            ],
            [
                "key"=> "verify_mail_link",
                "value"=> [
                    "ar"=> "التأكد من رابط الميل",
                    "en"=> "verify mail link"
                ]
            ],
            [
                "key"=> "accept_mail_link",
                "value"=> [
                    "ar"=> "قبول رابط البريد الالكترونى",
                    "en"=> "accept mail link"
                ]
            ],
            [
                "key"=> "reject_mail_link",
                "value"=> [
                    "ar"=> "رفض رابط البريد الالكترونى",
                    "en"=> "reject mail link"
                ]
            ],
            [
                "key"=> "swear",
                "value"=> [
                    "ar"=> "يجزم",
                    "en"=> "swear"
                ]
            ],
            [
                "key"=> "facebook",
                "value"=> [
                    "ar"=> "الفيس بوك",
                    "en"=> "facebook"
                ]
            ],
            [
                "key"=> "youtube",
                "value"=> [
                    "ar"=> "يوتيوب",
                    "en"=> "youtube"
                ]
            ],
            [
                "key"=> "linkedin",
                "value"=> [
                    "ar"=> "لينكدان",
                    "en"=> "linkedIn"
                ]
            ],
            [
                "key"=> "ios",
                "value"=> [
                    "ar"=> "نظام ios",
                    "en"=> "ios"
                ]
            ],
            [
                "key"=> "android",
                "value"=> [
                    "ar"=> "نظام الاندرويد",
                    "en"=> "android"
                ]
            ],
            [
                "key"=> "links",
                "value"=> [
                    "ar"=> "روابط",
                    "en"=> "links"
                ]
            ],
            [
                "key"=> "main",
                "value"=> [
                    "ar"=> "اساسى",
                    "en"=> "main"
                ]
            ],
            [
                "key"=> "manage_profile",
                "value"=> [
                    "ar"=> "ادارة الملف",
                    "en"=> "manage profile"
                ]
            ],
            [
                "key"=> "fq",
                "value"=> [
                    "ar"=> "F & Q",
                    "en"=> "F & Q"
                ]
            ],
            [
                "key"=> "answer",
                "value"=> [
                    "ar"=> "الاجابة",
                    "en"=> "Answer"
                ]
            ],
            [
                "key"=> "enter_answer",
                "value"=> [
                    "ar"=> "ادخال الاجابة",
                    "en"=> "Enter Answer"
                ]
            ],
            [
                "key"=> "question",
                "value"=> [
                    "ar"=> "سؤال",
                    "en"=> "Question"
                ]
            ],
            [
                "key"=> "enter_question",
                "value"=> [
                    "ar"=> "ادخال سؤال",
                    "en"=> "enter Question"
                ]
            ],
            [
                "key"=> "task",
                "value"=> [
                    "ar"=> "طلب عرض سعر",
                    "en"=> "Task"
                ]
            ],
            [
                "key"=> "price",
                "value"=> [
                    "ar"=> "سعر",
                    "en"=> "price"
                ]
            ],
            [
                "key"=> "time",
                "value"=> [
                    "ar"=> "وقت",
                    "en"=> "time"
                ]
            ],
            [
                "key"=> "start_date",
                "value"=> [
                    "ar"=> "تاريخ البدأ",
                    "en"=> "start date"
                ]
            ],
            [
                "key"=> "end_date",
                "value"=> [
                    "ar"=> "تاريخ الانتهاء",
                    "en"=> "end date"
                ]
            ],
            [
                "key"=> "type_work",
                "value"=> [
                    "ar"=> "نوع العمل",
                    "en"=> "type work"
                ]
            ],
            [
                "key"=> "address",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "address"
                ]
            ],
            [
                "key"=> "freelancer",
                "value"=> [
                    "ar"=> "مشتغل",
                    "en"=> "freelancer"
                ]
            ],
            [
                "key"=> "category_task_count_required",
                "value"=> [
                    "ar"=> "طلب عد نماذج المهام",
                    "en"=> "category in task required"
                ]
            ],
            [
                "key"=> "client_task_count",
                "value"=> [
                    "ar"=> "عد مهام العميل",
                    "en"=> "client in task count can add"
                ]
            ],
            [
                "key"=> "freelancer_task_count",
                "value"=> [
                    "ar"=> "عد مهام الفرى لانس",
                    "en"=> "freelancer in task count can accept"
                ]
            ],
            [
                "key"=> "index_inprocesses",
                "value"=> [
                    "ar"=> "الفهرسة تحت التنفيذ",
                    "en"=> "Index in processes"
                ]
            ],
            [
                "key"=> "index_review",
                "value"=> [
                    "ar"=> "مراجعة الفهرسة",
                    "en"=> "Index review"
                ]
            ],
            [
                "key"=> "index_done",
                "value"=> [
                    "ar"=> "تمت الفهرسة",
                    "en"=> "Index done"
                ]
            ],
            [
                "key"=> "you_have_many_task",
                "value"=> [
                    "ar"=> "لديك عده مهام",
                    "en"=> "you have many task places call admin"
                ]
            ],
            [
                "key"=> "index_inprocess",
                "value"=> [
                    "ar"=> "فهرس فى العمل",
                    "en"=> "Index in process"
                ]
            ],
            [
                "key"=> "index_unapprovebyclient",
                "value"=> [
                    "ar"=> "عدم قبول الفهرسه من قبل العميل",
                    "en"=> "Index un approve by client"
                ]
            ],
            [
                "key"=> "index_unapprovebyfreelancer",
                "value"=> [
                    "ar"=> "عدم قبول الفهرسه من قبل الفرى لانس",
                    "en"=> "Index un approve by freelancer"
                ]
            ],
            [
                "key"=> "time_out_task",
                "value"=> [
                    "ar"=> "انهاء الوقت المحدد للمهام",
                    "en"=> "time out for task by hours"
                ]
            ],
            [
                "key"=> "user_create",
                "value"=> [
                    "ar"=> "انشاء مستخدم",
                    "en"=> "user create"
                ]
            ],
            [
                "key"=> "translation",
                "value"=> [
                    "ar"=> "ترجمه",
                    "en"=> "translation"
                ]
            ],
            [
                "key"=> "location",
                "value"=> [
                    "ar"=> "موقع",
                    "en"=> "location"
                ]
            ],
            [
                "key"=> "system_data",
                "value"=> [
                    "ar"=> "بيانات النظام",
                    "en"=> "system data"
                ]
            ],
            [
                "key"=> "system",
                "value"=> [
                    "ar"=> "نظام",
                    "en"=> "system"
                ]
            ],
            [
                "key"=> "videos_task_count",
                "value"=> [
                    "ar"=> "الفيديو",
                    "en"=> "videos task count"
                ]
            ],
            [
                "key"=> "images_task_count",
                "value"=> [
                    "ar"=> "الصور",
                    "en"=> "images task count"
                ]
            ],
            [
                "key"=> "ad",
                "value"=> [
                    "ar"=> "الاعلانات",
                    "en"=> "Ad"
                ]
            ],
            [
                "key"=> "freelancer_ad_count",
                "value"=> [
                    "ar"=> "قبول الاعلانات فى الفرى لانس",
                    "en"=> "freelancer in ads count can accept"
                ]
            ],
            [
                "key"=> "you_have_many_ad",
                "value"=> [
                    "ar"=> "اعلانات متكررة",
                    "en"=> "you have many ad places call admin"
                ]
            ],
            [
                "key"=> "cant_edit",
                "value"=> [
                    "ar"=> "لا يمكن التعديل",
                    "en"=> "can't edit this"
                ]
            ],
            [
                "key"=> "index_new",
                "value"=> [
                    "ar"=> "فهرس جديد",
                    "en"=> "Index new"
                ]
            ],
            [
                "key"=> "index_cansel",
                "value"=> [
                    "ar"=> "الغاء الفهرس",
                    "en"=> "Index cansel"
                ]
            ],
            [
                "key"=> "index_timeout",
                "value"=> [
                    "ar"=> "انتهاء وقت الفهرس",
                    "en"=> "Index time out"
                ]
            ],
            [
                "key"=> "index_open",
                "value"=> [
                    "ar"=> "فتح الفهرس",
                    "en"=> "Index open"
                ]
            ],
            [
                "key"=> "minute",
                "value"=> [
                    "ar"=> "دقيقه",
                    "en"=> "Minute"
                ]
            ],
            [
                "key"=> "hour",
                "value"=> [
                    "ar"=> "ساعه",
                    "en"=> "Hour"
                ]
            ],
            [
                "key"=> "new",
                "value"=> [
                    "ar"=> "جديد",
                    "en"=> "new"
                ]
            ],
            [
                "key"=> "inprocess",
                "value"=> [
                    "ar"=> "جارى العمل عليه",
                    "en"=> "in process"
                ]
            ],
            [
                "key"=> "open",
                "value"=> [
                    "ar"=> "فتح",
                    "en"=> "open"
                ]
            ],
            [
                "key"=> "timeout",
                "value"=> [
                    "ar"=> "انتهاء الوقت",
                    "en"=> "time out"
                ]
            ],
            [
                "key"=> "cansel",
                "value"=> [
                    "ar"=> "الغاء",
                    "en"=> "cansel"
                ]
            ],
            [
                "key"=> "comment",
                "value"=> [
                    "ar"=> "تعليق",
                    "en"=> "comment"
                ]
            ],
            [
                "key"=> "unapprove",
                "value"=> [
                    "ar"=> "رفض",
                    "en"=> "un approve"
                ]
            ],
            [
                "key"=> "cansel_done",
                "value"=> [
                    "ar"=> "تم الالغاء",
                    "en"=> "cansel Done"
                ]
            ],
            [
                "key"=> "show",
                "value"=> [
                    "ar"=> "اظهار",
                    "en"=> "show"
                ]
            ],
            [
                "key"=> "document",
                "value"=> [
                    "ar"=> "مستند",
                    "en"=> "document"
                ]
            ],
            [
                "key"=> "approved_at",
                "value"=> [
                    "ar"=> "تم الموافقه على اساس...",
                    "en"=> "approved at"
                ]
            ],
            [
                "key"=> "time_out_ad",
                "value"=> [
                    "ar"=> "انتهاء وقت الاعلانات",
                    "en"=> "time out for ad by hours"
                ]
            ],
            [
                "key"=> "only_freelancer",
                "value"=> [
                    "ar"=> "الفرى لانس فقط",
                    "en"=> "only freelancer or company make ad"
                ]
            ],
            [
                "key"=> "back",
                "value"=> [
                    "ar"=> "الرجوع",
                    "en"=> "back"
                ]
            ],
            [
                "key"=> "videos_ad_count",
                "value"=> [
                    "ar"=> "فيديوهات اعلانات",
                    "en"=> "videos ad count"
                ]
            ],
            [
                "key"=> "images_ad_count",
                "value"=> [
                    "ar"=> "صور اعلانات",
                    "en"=> "images ad count"
                ]
            ],
            [
                "key"=> "images_validation",
                "value"=> [
                    "ar"=> "تفعيل الصور",
                    "en"=> "images must be min =>count"
                ]
            ],
            [
                "key"=> "videos_validation",
                "value"=> [
                    "ar"=> "تفعيل الفيديو",
                    "en"=> "videos must be min =>count"
                ]
            ],
            [
                "key"=> "un_active",
                "value"=> [
                    "ar"=> "غير فعال",
                    "en"=> "unactive"
                ]
            ],
            [
                "key"=> "currency",
                "value"=> [
                    "ar"=> "العمله المقررة",
                    "en"=> "Currency"
                ]
            ],
            [
                "key"=> "currency_id",
                "value"=> [
                    "ar"=> "هويه العمله",
                    "en"=> "currency"
                ]
            ],
            [
                "key"=> "company",
                "value"=> [
                    "ar"=> "الشركه",
                    "en"=> "company"
                ]
            ],
            [
                "key"=> "job_name_id",
                "value"=> [
                    "ar"=> "هوية المسمى الوظيفى",
                    "en"=> "job name"
                ]
            ],
            [
                "key"=> "tax_number",
                "value"=> [
                    "ar"=> "الرقم الضريبى",
                    "en"=> "tax number"
                ]
            ],
            [
                "key"=> "nationality_number",
                "value"=> [
                    "ar"=> "رقم الجنسيه",
                    "en"=> "nationality   number"
                ]
            ],
            [
                "key"=> "email_verified_at",
                "value"=> [
                    "ar"=> "تم تفعيل البريد الكترونى",
                    "en"=> "email verified at"
                ]
            ],
            [
                "key"=> "parent_id",
                "value"=> [
                    "ar"=> "هويه الوالد",
                    "en"=> "paren t"
                ]
            ],
            [
                "key"=> "parent",
                "value"=> [
                    "ar"=> "والد",
                    "en"=> "parent"
                ]
            ],
            [
                "key"=> "offer",
                "value"=> [
                    "ar"=> "عرض",
                    "en"=> "Offer"
                ]
            ],
            [
                "key"=> "many_offer",
                "value"=> [
                    "ar"=> "عروض متعدده",
                    "en"=> "you have many offer"
                ]
            ],
            [
                "key"=> "time_out_offer",
                "value"=> [
                    "ar"=> "انتهت العروض",
                    "en"=> "time out offer"
                ]
            ],
            [
                "key"=> "log",
                "value"=> [
                    "ar"=> "سجل",
                    "en"=> "log"
                ]
            ],
            [
                "key"=> "action",
                "value"=> [
                    "ar"=> "فعل",
                    "en"=> "action"
                ]
            ],
            [
                "key"=> "url",
                "value"=> [
                    "ar"=> "رابط",
                    "en"=> "url"
                ]
            ],
            [
                "key"=> "affected",
                "value"=> [
                    "ar"=> "متأثر - متصنع",
                    "en"=> "affected"
                ]
            ],
            [
                "key"=> "visitor",
                "value"=> [
                    "ar"=> "زائر",
                    "en"=> "visitor"
                ]
            ],
            [
                "key"=> "view",
                "value"=> [
                    "ar"=> "رؤية",
                    "en"=> "view"
                ]
            ],
            [
                "key"=> "generate code",
                "value"=> [
                    "ar"=> "انشاء كود",
                    "en"=> "generate code"
                ]
            ],
            [
                "key"=> "reset password",
                "value"=> [
                    "ar"=> "تغير كلمه السر",
                    "en"=> "reset password"
                ]
            ],
            [
                "key"=> "change status",
                "value"=> [
                    "ar"=> "تغير حاله",
                    "en"=> "change status"
                ]
            ],
            [
                "key"=> "convert",
                "value"=> [
                    "ar"=> "تحويل",
                    "en"=> "convert"
                ]
            ],
            [
                "key"=> "un approve",
                "value"=> [
                    "ar"=> "رفض",
                    "en"=> "un approve"
                ]
            ],
            [
                "key"=> "cancellation",
                "value"=> [
                    "ar"=> "الغاء",
                    "en"=> "Cancellation"
                ]
            ],
            [
                "key"=> "cancellation_id",
                "value"=> [
                    "ar"=> "الغاء",
                    "en"=> "Cancellation"
                ]
            ],
            [
                "key"=> "notification",
                "value"=> [
                    "ar"=> "اشعارات",
                    "en"=> "Notification"
                ]
            ],
            [
                "key"=> "pusher_id",
                "value"=> [
                    "ar"=> "الراسل",
                    "en"=> "pusher_id"
                ]
            ],
            [
                "key"=> "receiver_id",
                "value"=> [
                    "ar"=> "المستقبل",
                    "en"=> "receiver_id"
                ]
            ],
            [
                "key"=> "fcm_secret_key",
                "value"=> [
                    "ar"=> "كود الفير بيز السرى",
                    "en"=> "FCM SECRET KEY"
                ]
            ],
            [
                "key"=> "firebase_api_key",
                "value"=> [
                    "ar"=> "كود الفير بيز",
                    "en"=> "firebase api key"
                ]
            ],
            [
                "key"=> "firebase_auth_domain",
                "value"=> [
                    "ar"=> "ادمن الفير بيز",
                    "en"=> "firebase auth domain"
                ]
            ],
            [
                "key"=> "firebase_database_url",
                "value"=> [
                    "ar"=> "رابط الداتا بيز للفير بيز",
                    "en"=> "firebase database url"
                ]
            ],
            [
                "key"=> "firebase_project_id",
                "value"=> [
                    "ar"=> "رقم مشروع الفير بيز",
                    "en"=> "firebase project id"
                ]
            ],
            [
                "key"=> "firebase_storage_bucket",
                "value"=> [
                    "ar"=> "firebase storage bucket",
                    "en"=> "firebase storage bucket"
                ]
            ],
            [
                "key"=> "firebase_messaging_sender_id",
                "value"=> [
                    "ar"=> "رقم راسل الفير بيز",
                    "en"=> "firebase messaging sender id"
                ]
            ],
            [
                "key"=> "firebase_app_id",
                "value"=> [
                    "ar"=> "firebase app id",
                    "en"=> "firebase app id"
                ]
            ],
            [
                "key"=> "firebase_measurement_id",
                "value"=> [
                    "ar"=> "firebase measurement id",
                    "en"=> "firebase measurement id"
                ]
            ],
            [
                "key"=> "is_send_notification",
                "value"=> [
                    "ar"=> "تم ارسال اشعار",
                    "en"=> "is send notification"
                ]
            ],
            [
                "key"=> "title_approved_user",
                "value"=> [
                    "ar"=> "المستخدم فى انتظار الموافقه",
                    "en"=> "There is user need to approve",
                ]
            ],
            [
                "key"=> "description_approved_user",
                "value"=> [
                    "ar"=> "المستخدم :id بنتظار موافقه",
                    "en"=> "user :id need to approve"
                ]
            ],
            [
                "key"=> "read",
                "value"=> [
                    "ar"=> "قرأه",
                    "en"=> "read notification"
                ]
            ],
            [
                "key"=> "title_timeout_ads",
                "value"=> [
                    "ar"=> "تم انتهاؤ وقت الاعلان",
                    "en"=> "Ads Time out"
                ]
            ],
            [
                "key"=> "description_timeout_ads",
                "value"=> [
                    "ar"=> "تم انتهاء :id",
                    "en"=> "Ads :id Time out"
                ]
            ],
            [
                "key"=> "title_cancel_ads",
                "value"=> [
                    "ar"=> "الغاء الاعلان",
                    "en"=> "Ads canceled"
                ]
            ],
            [
                "key"=> "description_cancel_ads",
                "value"=> [
                    "ar"=> "تم الغاء :id",
                    "en"=> "Ads :id canceled"
                ]
            ],
            [
                "key"=> "title_create_task",
                "value"=> [
                    "ar"=> "طلب عرض السعر يحتاج الى موافقة",
                    "en"=> "there is task need to approve"
                ]
            ],
            [
                "key"=> "description_create_task",
                "value"=> [
                    "ar"=> "طلب عرض السعر :id يحتاج الى موافقة",
                    "en"=> "task :id need approve"
                ]
            ],
            [
                "key"=> "title_opened_task",
                "value"=> [
                    "ar"=> "طلبك قيد المراجعة من قبل الادارة",
                    "en"=> "task is opened"
                ]
            ],
            [
                "key"=> "description_opened_task",
                "value"=> [
                    "ar"=> "تم استقبال طلبك  :id وجاري مراجعته من قبل الإدارة خلال دقائق",
                    "en"=> "task :id opened"
                ]
            ],
            [
                "key"=> "title_time_out_task",
                "value"=> [
                    "ar"=> "تم انتهاء وقت طلب عرض السعر",
                    "en"=> "task is time out"
                ]
            ],
            [
                "key"=> "description_time_out_task",
                "value"=> [
                    "ar"=> "تم انتهاء طلب عرض سعر :id",
                    "en"=> "task :id time out"
                ]
            ],
            [
                "key"=> "title_cancel_task",
                "value"=> [
                    "ar"=> "تم الغاء طلب عرض السعر",
                    "en"=> "task is canceled"
                ]
            ],
            [
                "key"=> "description_cancel_task",
                "value"=> [
                    "ar"=> "تم الغاء طلب عرض السعر :id",
                    "en"=> "task :id canceled"
                ]
            ],
            [
                "key"=> "title_reject_task",
                "value"=> [
                    "ar"=> "تم رفض طلب عرض السعر",
                    "en"=> "task is rejected"
                ]
            ],
            [
                "key"=> "description_reject_task",
                "value"=> [
                    "ar"=> "تم رفض طلب عرض سعر :id",
                    "en"=> "task :id rejected"
                ]
            ],
            [
                "key"=> "title_approve_task",
                "value"=> [
                    "ar"=> "تم الموافقة علي طلبك من قبل الادارة ",
                    "en"=> "task is approved"
                ]
            ],
            [
                "key"=> "description_approve_task",
                "value"=> [
                    "ar"=> "تمت الموافقة علي طلبك :id سوف تستقبل الأن العروض اختر مايناسبك",
                    "en"=> "task :id approved"
                ]
            ],
            [
                "key"=> "notification_system",
                "value"=> [
                    "ar"=> "نظام الاشعارات",
                    "en"=> "notification system"
                ]
            ],
            [
                "key"=> "push_notification",
                "value"=> [
                    "ar"=> "اشعارات الدفع",
                    "en"=> "push Notification"
                ]
            ],
            [
                "key"=> "push",
                "value"=> [
                    "ar"=> "دفع",
                    "en"=> "push"
                ]
            ],
            [
                "key"=> "reset",
                "value"=> [
                    "ar"=> "اعاده وضع",
                    "en"=> "Reset"
                ]
            ],
            [
                "key"=> "error_otp",
                "value"=> [
                    "ar"=> "يوجد مشكله فى الكود المرسل",
                    "en"=> "error in otp sms"
                ]
            ],
            [
                "key"=> "otp",
                "value"=> [
                    "ar"=> "كود الرسائل",
                    "en"=> "otp unifonic"
                ]
            ],
            [
                "key"=> "otp_app_id",
                "value"=> [
                    "ar"=> "otp app id unifonic",
                    "en"=> "otp app id unifonic"
                ]
            ],
            [
                "key"=> "otp_authorization",
                "value"=> [
                    "ar"=> "otp authorization unifonic",
                    "en"=> "otp authorization unifonic"
                ]
            ],
            [
                "key"=> "whats_app_message_ad",
                "value"=> [
                    "ar"=> "التحدث عبر تطبيق الواتس اب",
                    "en"=> "start chat"
                ]
            ],
            [
                "key"=> "filter",
                "value"=> [
                    "ar"=> "فلتر",
                    "en"=> "filter"
                ]
            ],
            [
                "key"=> "remove_filter",
                "value"=> [
                    "ar"=> "restart",
                    "en"=> "restart"
                ]
            ],
            [
                "key"=> "is_web",
                "value"=> [
                    "ar"=> "عرض فى الموقع",
                    "en"=> "show in web"
                ]
            ],
            [
                "key"=> "is_approve",
                "value"=> [
                    "ar"=> "يحتاج الى موافقة",
                    "en"=> "need to approve"
                ]
            ],
            [
                "key"=> "is_report",
                "value"=> [
                    "ar"=> "عرض التقارير",
                    "en"=> "show in report"
                ]
            ],
            [
                "key"=> "is_verified",
                "value"=> [
                    "ar"=> "البريد الالكتورني يحتاج الى تاكيد",
                    "en"=> "email need to verified"
                ]
            ],
            [
                "key"=> "home_setting",
                "value"=> [
                    "ar"=> "الاعدادات الرئيسيه",
                    "en"=> "Home Setting"
                ]
            ],
            [
                "key"=> "title_update_time_task",
                "value"=> [
                    "ar"=> "وقت طلب عرض السعر يحتاج الى تجديد ",
                    "en"=> "update time Task need to approve "
                ]
            ],
            [
                "key"=> "description_update_time_task",
                "value"=> [
                    "ar"=> "وقت طلب عرض السعر :id الى تجديد",
                    "en"=> "task need to approve :id time updated"
                ]
            ],
            [
                "key"=> "title_done_freelancer",
                "value"=> [
                    "ar"=> "تم الانتهاء من طرف المستغل ",
                    "en"=> "Done freelancer "
                ]
            ],
            [
                "key"=> "description_done_freelancer",
                "value"=> [
                    "ar"=> "طلب عرض السعر :id تم الانتهاء منه من طرف المشتغل",
                    "en"=> "task done  :id by freelancer"
                ]
            ],
            [
                "key"=> "title_done_client",
                "value"=> [
                    "ar"=> "طلب عرض السعر تم انتهاء من قبل المستخدم ",
                    "en"=> "task done place pay commission "
                ]
            ],
            [
                "key"=> "description_done_client",
                "value"=> [
                    "ar"=> "تم انهاء طلب عرض السعر :id برجاء دفع العموله",
                    "en"=> "task :id done place pay commission"
                ]
            ],
            [
                "key"=> "title_unapprove_freelancer",
                "value"=> [
                    "ar"=> "تم رفض ",
                    "en"=> "this task un approve by freelancer "
                ]
            ],
            [
                "key"=> "description_unapprove_freelancer",
                "value"=> [
                    "ar"=> "تم رفض طلب عرض السعر :id من قبل المستغل",
                    "en"=> "task :id un approved by freelancer"
                ]
            ],
            [
                "key"=> "title_offer_create",
                "value"=> [
                    "ar"=> "تم استقبال عرض جديد",
                    "en"=> "new offer create"
                ]
            ],
            [
                "key"=> "description_offer_create",
                "value"=> [
                    "ar"=> " تم استقبال عرض لطلبك :id  تفقد العرض الأن",
                    "en"=> " :id new offer create"
                ]
            ],
            [
                "key"=> "title_new_Task",
                "value"=> [
                    "ar"=> "طلب عرض سعر جديد",
                    "en"=> "new Task create"
                ]
            ],
            [
                "key"=> "description_new_Task",
                "value"=> [
                    "ar"=> "تم ارسال طلبك وجاري الموافقة من قبل الادارة",
                    "en"=> "Your request has been sent and is being approved by the administration"
                ]
            ],
            [
                "key"=> "title_offer_update",
                "value"=> [
                    "ar"=> "تجديد العرض",
                    "en"=> "new offer update"
                ]
            ],
            [
                "key"=> "description_offer_update",
                "value"=> [
                    "ar"=> "يتم تعديلها الى يرجى تعديل السعر المقدم ",
                    "en"=> " :id new offer update"
                ]
            ],
            [
                "key"=> "title_offer_unapprove",
                "value"=> [
                    "ar"=> " تم رفض",
                    "en"=> " offer un Approve"
                ]
            ],
            [
                "key"=> "description_offer_unapprove",
                "value"=> [
                    "ar"=> " :id تم رفض العرض المقدم",
                    "en"=> "offer :id un Approve"
                ]
            ],
            [
                "key"=> "title_offer_approve",
                "value"=> [
                    "ar"=> " تم القبول",
                    "en"=> " offer Approve"
                ]
            ],
            [
                "key"=> "description_offer_approve",
                "value"=> [
                    "ar"=> " :id تم قبول عرضك",
                    "en"=> "offer :id Approve"
                ]
            ],
            [
                "key"=> "title_offer_timeout",
                "value"=> [
                    "ar"=> ":id  تم اخفاء",
                    "en"=> " this offer hidden"
                ]
            ],
            [
                "key"=> "description_offer_timeout",
                "value"=> [
                    "ar"=> "تم انتهاء الوقت للعرض",
                    "en"=> "offer :id timeout"
                ]
            ],
            [
                "key"=> "title_update_task",
                "value"=> [
                    "ar"=> "تم تعديل طلب عرض السعر",
                    "en"=> "there is task updated"
                ]
            ],
            [
                "key"=> "description_update_task",
                "value"=> [
                    "ar"=> "تم تعديل طلب عرض سعر :id",
                    "en"=> "task :id updated"
                ]
            ],
            [
                "key"=> "home_section_1_title",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "title"
                ]
            ],
            [
                "key"=> "home_section_1_image",
                "value"=> [
                    "ar"=> "صوره",
                    "en"=> "image"
                ]
            ],
            [
                "key"=> "home_section_1_description",
                "value"=> [
                    "ar"=> "تفاصيل",
                    "en"=> "description"
                ]
            ],
            [
                "key"=> "home_section_1_link",
                "value"=> [
                    "ar"=> "رابط",
                    "en"=> "link"
                ]
            ],
            [
                "key"=> "home_section_2_title",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "title"
                ]
            ],
            [
                "key"=> "home_section_2_description",
                "value"=> [
                    "ar"=> "تفاصيل",
                    "en"=> "description"
                ]
            ],
            [
                "key"=> "home_section_2_video_link",
                "value"=> [
                    "ar"=> "رابط الفيديو",
                    "en"=> "video link"
                ]
            ],
            [
                "key"=> "home_section_3_title",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "title"
                ]
            ],
            [
                "key"=> "home_section_3_image",
                "value"=> [
                    "ar"=> "صوره",
                    "en"=> "image"
                ]
            ],
            [
                "key"=> "home_section_4_title",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "title"
                ]
            ],
            [
                "key"=> "home_section_4_url",
                "value"=> [
                    "ar"=> "رابط",
                    "en"=> "url"
                ]
            ],
            [
                "key"=> "home_section_5_title",
                "value"=> [
                    "ar"=> "عنوان",
                    "en"=> "title"
                ]
            ],
            [
                "key"=> "home_section_5_image",
                "value"=> [
                    "ar"=> "صوره",
                    "en"=> "image"
                ]
            ],
            [
                "key"=> "section_1",
                "value"=> [
                    "ar"=> "القسم الاول",
                    "en"=> "section 1"
                ]
            ],
            [
                "key"=> "section_2",
                "value"=> [
                    "ar"=> "القسم الثانى",
                    "en"=> "section 2"
                ]
            ],
            [
                "key"=> "section_3",
                "value"=> [
                    "ar"=> "القسم الثالث",
                    "en"=> "section 3"
                ]
            ],
            [
                "key"=> "section_4",
                "value"=> [
                    "ar"=> "القسم الرابع",
                    "en"=> "section 4"
                ]
            ],
            [
                "key"=> "section_5",
                "value"=> [
                    "ar"=> "القسم الخامس",
                    "en"=> "section 5"
                ]
            ],
            [
                "key"=> "bank",
                "value"=> [
                    "ar"=> "بنك",
                    "en"=> "bank"
                ]
            ],
           /* [
                "key"=> "area",
                "value"=> [
                    "ar"=> "حي",
                    "en"=> "Area"
                ]
            ],*/
           /* [
                "key"=> "area_id",
                "value"=> [
                    "ar"=> "حي",
                    "en"=> "Area"
                ]
            ],*/
            [
                "key"=> "general",
                "value"=> [
                    "ar"=> "عام",
                    "en"=> "General"
                ]
            ],
            [
                "key"=> "total",
                "value"=> [
                    "ar"=> "اجمالى",
                    "en"=> "Total"
                ]
            ],
            [
                "key"=> "search_log",
                "value"=> [
                    "ar"=> "سجل البحث",
                    "en"=> "Search Log"
                ]
            ],
            [
                "key"=> "search",
                "value"=> [
                    "ar"=> "بحث",
                    "en"=> "Search"
                ]
                ],
            [
                "key"=> "this_mobile_used",
                "value"=> [
                    "ar"=> "هذا الرقم مستخدم",
                    "en"=> "this mobile used"
                ]
                ],
            [
                "key"=> "this_user_name_used",
                "value"=> [
                    "ar"=> "هذا اسم المستخدم تم استعماله من قبل",
                    "en"=> "this username used"
                ]
            ],
            [
                "key"=> "this_email_used",
                "value"=> [
                    "ar"=> "هذا البريد الالكترورني تم استعماله من قبل",
                    "en"=> "this email used"
                ]
            ],
                [
                    "key"=> "code_expired",
                    "value"=> [
                        "ar"=> "كود منتهي الصلاحية",
                        "en"=> "code expired"
                    ]
                ],
                [
                    "key"=> "incorrect",
                    "value"=> [
                        "ar"=> "خطا",
                        "en"=> "incorrect"
                    ]
                ],
                [
                    "key"=> "correct",
                    "value"=> [
                        "ar"=> "صحيح",
                        "en"=> "correct"
                    ]
                ],
                [
                    "key"=> "can_t_delete",
                    "value"=> [
                        "ar"=> "لا يمكن مسح هذا المحتوي",
                        "en"=> "can't delete This content"
                    ]
                ],

        ];
        foreach ($custom as $value) {
            $data = app()->make(CustomTranslationService::class)->findBy(new Request(['key' => strtolower($value['key'])]), false, 10, 'count');
            if ($data == 0) {
                $data = CustomTranslation::create(['key' => strtolower($value['key'])]);
                foreach (language() as $lang) {
                    if (isset($value['value'][$lang->code])) {
                        $data->translation()->create(['key' => 'value', 'value' => $value['value'][$lang->code], 'language_id' => $lang->id]);
                    }
                }
            }
        }
    }
}
