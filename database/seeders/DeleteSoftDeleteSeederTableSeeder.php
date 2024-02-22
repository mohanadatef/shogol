<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\DeviceToken;
use Modules\Acl\Entities\Favourite;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Entities\Role;
use Modules\Acl\Entities\RolePermission;
use Modules\Acl\Entities\Skill;
use Modules\Acl\Entities\UserCategory;
use Modules\Acl\Entities\UserSocial;
use Modules\Basic\Entities\Comment;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Entities\ErrorLog;
use Modules\Basic\Entities\Log;
use Modules\Basic\Entities\Media;
use Modules\Basic\Entities\Seeder as EntitiesSeeder;
use Modules\Basic\Entities\Translation;
use Modules\CoreData\Entities\Area;
use Modules\CoreData\Entities\Bank;
use Modules\CoreData\Entities\Category;
use Modules\CoreData\Entities\City;
use Modules\CoreData\Entities\Country;
use Modules\CoreData\Entities\Currency;
use Modules\CoreData\Entities\Gender;
use Modules\CoreData\Entities\JobName;
use Modules\CoreData\Entities\Language;
use Modules\CoreData\Entities\Level;
use Modules\CoreData\Entities\Nationality;
use Modules\CoreData\Entities\Social;
use Modules\CoreData\Entities\State;
use Modules\CoreData\Entities\Status;
use Modules\CoreData\Entities\Tag;
use Modules\Setting\Entities\Cancellation;
use Modules\Setting\Entities\ContactUs;
use Modules\Setting\Entities\Fq;
use Modules\Setting\Entities\Notification;
use Modules\Setting\Entities\Page;
use Modules\Setting\Entities\Report;
use Modules\Setting\Entities\Review;
use Modules\Setting\Entities\Setting;
use Modules\Task\Entities\Ad;
use Modules\Task\Entities\AdCategory;
use Modules\Task\Entities\Offer;
use Modules\Task\Entities\Task;
use Modules\Task\Entities\TaskCategory;

class DeleteSoftDeleteSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasColumn('users', 'deleted_at')) {
        User::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('device_tokens', 'deleted_at')) {
        DeviceToken::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('favourites', 'deleted_at')) {
        Favourite::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('permissions', 'deleted_at')) {
        Permission::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('roles', 'deleted_at')) {
        Role::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('role_permissions', 'deleted_at')) {
        RolePermission::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('skills', 'deleted_at')) {
        Skill::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('user_categories', 'deleted_at')) {
        UserCategory::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('user_socials', 'deleted_at')) {
        UserSocial::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('comments', 'deleted_at')) {
        Comment::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('custom_translations', 'deleted_at')) {
        CustomTranslation::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('error_logs', 'deleted_at')) {
        ErrorLog::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('logs', 'deleted_at')) {
        Log::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('medias', 'deleted_at')) {
        Media::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('translations', 'deleted_at')) {
        Translation::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('areas', 'deleted_at')) {
        Area::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('banks', 'deleted_at')) {
        Bank::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('categories', 'deleted_at')) {
        Category::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('cities', 'deleted_at')) {
        City::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('countries', 'deleted_at')) {
        Country::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('currencies', 'deleted_at')) {
        Currency::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('genders', 'deleted_at')) {
        Gender::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('job_names', 'deleted_at')) {
        JobName::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('languages', 'deleted_at')) {
        Language::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('levels', 'deleted_at')) {
        Level::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('nationalities', 'deleted_at')) {
        Nationality::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('socials', 'deleted_at')) {
        Social::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('states', 'deleted_at')) {
        State::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('status', 'deleted_at')) {
        Status::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('tags', 'deleted_at')) {
        Tag::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('cancellations', 'deleted_at')) {
        Cancellation::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('contactus', 'deleted_at')) {
        ContactUs::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('fqs', 'deleted_at')) {
        Fq::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('notifications', 'deleted_at')) {
        Notification::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('pages', 'deleted_at')) {
        Page::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('reports', 'deleted_at')) {
        Report::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('reviews', 'deleted_at')) {
        Review::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('settings', 'deleted_at')) {
        Setting::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('ads', 'deleted_at')) {
        Ad::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('ad_categories', 'deleted_at')) {
        AdCategory::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('offers', 'deleted_at')) {
        Offer::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('tasks', 'deleted_at')) {
        Task::whereNotNull('deleted_at')->delete();
        }
        if (Schema::hasColumn('task_categories', 'deleted_at')) {
        TaskCategory::whereNotNull('deleted_at')->delete();
        }
    }
}
