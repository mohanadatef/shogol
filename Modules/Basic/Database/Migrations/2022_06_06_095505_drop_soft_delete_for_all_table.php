<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSoftDeleteForAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'deleted_at')) {
        Schema::table("users", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('permissions', 'deleted_at')) {
        Schema::table("permissions", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('role_permissions', 'deleted_at')) {
        Schema::table("role_permissions", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('user_categories', 'deleted_at')) {
        Schema::table("user_categories", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('skills', 'deleted_at')) {
        Schema::table("skills", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('user_socials', 'deleted_at')) {
        Schema::table("user_socials", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('favourites', 'deleted_at')) {
        Schema::table("favourites", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('device_tokens', 'deleted_at')) {
        Schema::table("device_tokens", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('medias', 'deleted_at')) {
        Schema::table("medias", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('translations', 'deleted_at')) {
        Schema::table("translations", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('comments', 'deleted_at')) {
        Schema::table("comments", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('logs', 'deleted_at')) {
        Schema::table("logs", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('custom_translations', 'deleted_at')) {
        Schema::table("custom_translations", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('error_logs', 'deleted_at')) {
        Schema::table("error_logs", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('languages', 'deleted_at')) {
        Schema::table("languages", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('countries', 'deleted_at')) {
        Schema::table("countries", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('cities', 'deleted_at')) {
        Schema::table("cities", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('states', 'deleted_at')) {
         Schema::table("states", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('genders', 'deleted_at')) {
        Schema::table("genders", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('job_names', 'deleted_at')) {
        Schema::table("job_names", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('nationalities', 'deleted_at')) {
        Schema::table("nationalities", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('categories', 'deleted_at')) {
        Schema::table("categories", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('tags', 'deleted_at')) {
        Schema::table("tags", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('levels', 'deleted_at')) {
        Schema::table("levels", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('socials', 'deleted_at')) {
        Schema::table("socials", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('currencies', 'deleted_at')) {
        Schema::table("currencies", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('status', 'deleted_at')) {
        Schema::table("status", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('banks', 'deleted_at')) {
        Schema::table("banks", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('areas', 'deleted_at')) {
        Schema::table("areas", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('contactus', 'deleted_at')) {
        Schema::table("contactus", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('pages', 'deleted_at')) {
        Schema::table("pages", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('settings', 'deleted_at')) {
        Schema::table("settings", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('fqs', 'deleted_at')) {
        Schema::table("fqs", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('cancellations', 'deleted_at')) {
        Schema::table("cancellations", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('notifications', 'deleted_at')) {
        Schema::table("notifications", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('reports', 'deleted_at')) {
        Schema::table("reports", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('reviews', 'deleted_at')) {
        Schema::table("reviews", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('tasks', 'deleted_at')) {
        Schema::table("tasks", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('task_categories', 'deleted_at')) {
        Schema::table("task_categories", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('ads', 'deleted_at')) {
        Schema::table("ads", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('ad_categories', 'deleted_at')) {
        Schema::table("ad_categories", function ($table) {
            $table->dropSoftDeletes();
        });
        }
        if (Schema::hasColumn('offers', 'deleted_at')) {
        Schema::table("offers", function ($table) {
            $table->dropSoftDeletes();
        });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
