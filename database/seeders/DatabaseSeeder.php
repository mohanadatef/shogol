<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageTableSeeder::class);
        //$this->call(CsvFileSeeder::class);
       /* $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);*/
/*        $this->call(StateTableSeeder::class);*/
        $this->call(GenderTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(SocialTableSeeder::class);
        $this->call(JobNameCustomTranslationsTableSeeder::class);
        $this->call(JobNameTableSeeder::class);
        $this->call(TagCustomTranslationsTableSeeder::class);
        $this->call(userCustomTranslationsTableSeeder::class);
        $this->call(CategoryCustomTranslationsTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(customTranslationsTableSeeder::class);
        $this->call(statusTableSeeder::class);
        $this->call(pageCustomTranslationsTableSeeder::class);
        $this->call(settingTableSeeder::class);
        $this->call(settingCustomTranslationsTableSeeder::class);
        $this->call(fQCustomTranslationTableSeeder::class);
        $this->call(taskCustomTranslationsTableSeeder::class);
        $this->call(taskSettingValueTableSeeder::class);
        $this->call(adCustomTranslationsTableSeeder::class);
        $this->call(adSettingValueTableSeeder::class);
        $this->call(currencyTableSeeder::class);
        $this->call(currencyCustomTranslationsTableSeeder::class);
        $this->call(OfferSettingValueTableSeeder::class);
        $this->call(OfferCustomTranslationsTableSeeder::class);
        $this->call(LogCustomTranslationsTableSeeder::class);
        $this->call(CancellationTableSeeder::class);
        $this->call(CancellationCustomTranslationsTableSeeder::class);
        $this->call(NotificationCustomTranslationsTableSeeder::class);
        $this->call(NotificationSettingValueTableSeeder::class);
        $this->call(OtpCustomTranslationsTableSeeder::class);
        $this->call(OtpSettingValueTableSeeder::class);
        $this->call(FrontCustomTranslationTableSeeder::class);
        $this->call(PermissionCustomTranslationsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserPermissionTableSeeder::class);
        $this->call(PermissionPermissionTableSeeder::class);
        $this->call(AdPermissionTableSeeder::class);
        $this->call(TaskPermissionTableSeeder::class);
        $this->call(SocialPermissionTableSeeder::class);
        //$this->call(CityPermissionTableSeeder::class);
        //$this->call(CountryPermissionTableSeeder::class);
        //$this->call(StatePermissionTableSeeder::class);
        $this->call(JobNamePermissionTableSeeder::class);
        $this->call(CategoryPermissionTableSeeder::class);
        $this->call(TagPermissionTableSeeder::class);
        $this->call(NationalityPermissionTableSeeder::class);
        $this->call(CurrencyPermissionTableSeeder::class);
        $this->call(LevelPermissionTableSeeder::class);
        $this->call(GenderPermissionTableSeeder::class);
        $this->call(SettingPermissionTableSeeder::class);
        $this->call(LanguagePermissionTableSeeder::class);
        $this->call(CustomTranslationPermissionTableSeeder::class);
        $this->call(CancellationPermissionTableSeeder::class);
        $this->call(FqPermissionTableSeeder::class);
        $this->call(PagePermissionTableSeeder::class);
        $this->call(ContactUsPermissionTableSeeder::class);
        $this->call(OfferPermissionTableSeeder::class);
        $this->call(RoleCustomTranslationsTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(LogPermissionTableSeeder::class);
        $this->call(NotificationPermissionTableSeeder::class);
        $this->call(DeleteSoftDeleteSeederTableSeeder::class);
        $this->call(AddAdminRoleTableSeeder::class);
        $this->call(AddCompanyRoleTableSeeder::class);
        $this->call(AddFreelancerRoleTableSeeder::class);
        $this->call(AddClientRoleTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(StatusPermissionTableSeeder::class);
        $this->call(StatusCustomTranslationsTableSeeder::class);
/*        $this->call(AreaTableSeeder::class);*/
       // $this->call(TaskPriceTableSeeder::class);
        //$this->call(AdPriceTableSeeder::class);
        $this->call(UserRateTableSeeder::class);
        $this->call(PassportTokens::class);
    }
}
