<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\Media;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class HomeSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'home_section_1_title', 'value' => '<p style="text-align: center; "><font face="Arial Black"><b><br></b></font></p><p style="text-align: center; "><font face="Arial Black"><b>منصة شغل</b></font></p><p></p>'],
            ['key' => 'home_section_1_image', 'value' => "1669319046Shogol Image Header.png"],
            ['key' => 'home_section_1_description', 'value' => '<p><span style="font-weight: bolder; font-family: &quot;Arial Black&quot;; text-align: right;">منصة شاملة لجميع الاشغال التى يمكن تقديمها عن قرب و عن بعد </span></p><p><span style="font-weight: bolder; font-family: &quot;Arial Black&quot;; text-align: right;">تختص بتنظيم قطاع الخدمات و تعمل بمفهوم جديد "يثمن وقتك"</span><br></p>'],
            ['key' => 'home_section_1_link', 'value' => ""],
            ['key' => 'home_section_2_title', 'value' => '<p class="OfferPriceInfo_component_title1__OQ0mU" style="height: auto; margin-right: 0px; margin-left: 0px; padding: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 35px; line-height: normal; font-family: Cairo-Medium; color: rgb(30, 170, 173); opacity: 1; background-color: rgb(248, 250, 252);"><span style="color: rgb(55, 56, 59); font-size: 50px; font-weight: 700;">&nbsp; لماذا طلب عرض سعر افضل؟</span><br></p>'],
            ['key' => 'home_section_2_description', 'value' => '<div style="text-align: right;"><div style="text-align: right; margin-left: 25px;"><div style="text-align: right; margin-left: 25px;"><p class="Default"><o:p>&nbsp;</o:p><span style="font-size: 1rem; font-family: &quot;Segoe UI&quot;, sans-serif;">&nbsp;&nbsp;</span><span lang="AR-SA" dir="RTL" style="font-size: 36pt; font-family: &quot;Segoe UI&quot;, sans-serif; color: rgb(30, 170, 172);">معلومات</span></p>

<p class="MsoNormal" align="right" style="margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span lang="AR-SA" dir="RTL" style="font-size:28.0pt;font-family:&quot;Segoe UI&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#37383A">لماذا طلب عرض سعر ..</span></p>

<div style="text-align: right;"><p class="MsoNormal" align="right" style="margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><img src="data:image/png;base64,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" data-filename="image.png" style="font-size: 1rem; width: 104px;"><br></p></div><div><b><span style="color: rgb(143, 143, 143); font-family: &quot;Segoe UI&quot;, sans-serif; font-size: 14pt;"><br>اولا&nbsp; : ستطلب ولن تبحث وستوفر عنا البحث</span><br></b><p class="MsoNormal" align="right" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span lang="AR-SA" dir="RTL" style="font-family: &quot;Segoe UI&quot;, sans-serif;"><font color="#8f8f8f"><span style="font-size: 14pt;">ثانيا&nbsp; : ستكشف سعر السوق للخدمة التى تبحث عنها</span></font><font size="1"><br></font></span><span style="color: rgb(143, 143, 143); font-family: &quot;Segoe UI&quot;, sans-serif; font-size: 14pt;">ثالثا&nbsp; : ستتصفح السيرة الذكية للمشتغلين
الجاهزين لخدمتك<br></span><span style="color: rgb(143, 143, 143); font-family: &quot;Segoe UI&quot;, sans-serif; font-size: 14pt;">رابعا : ستختار السعر و المشتغل الانسب لك بكل
ثقه وراحه بال</span></b></p></div></div></div></div><div style="text-align: right;"><div style="text-align: right; margin-left: 25px;"><div style="text-align: right; margin-left: 25px;"><p class="Default" style="line-height:40.0pt"><o:p></o:p></p></div></div></div>'],
            ['key' => 'home_section_2_video_link', 'value' => "https://www.youtube.com/watch?v=ORpDekrTavU"],
            ['key' => 'home_section_3_title', 'value' => ""],
            ['key' => 'home_section_3_image', 'value' => ""],
            ['key' => 'home_section_4_title', 'value' => '<p class="m-0 fLT-Bold-sD cLT-secondary-text" style="height: auto; padding: 0px; font-family: Cairo-Bold; font-size: 42px; color: rgb(30, 170, 173); text-align: center; background-color: rgb(248, 250, 252);">بعض الخدمات وظائف شغل</p><p class="m-0 LT-advsTitle-size cLT-main-text" style="height: auto; padding: 0px; color: rgb(2, 56, 90); font-family: Cairo-Bold; font-size: 54px; text-align: center; background-color: rgb(248, 250, 252);">اهم الخدمات الاحترافية لتطوير وتنمية اعمالك</p>'],
            ['key' => 'home_section_4_url', 'value' => ""],
            ['key' => 'home_section_5_title', 'value' => '<p class="m-0 cLT-secondary-text fLT-Bold-sC" style="height: auto; padding: 0px; font-family: Cairo-Bold; font-size: 30px; color: rgb(30, 170, 173); text-align: right; background-color: rgb(248, 250, 252);">معلومات</p><p class="m-0 cLT-main-text fLT-Bold-sD" style="height: auto; padding: 0px; font-family: Cairo-Bold; font-size: 42px; color: rgb(2, 56, 90); text-align: right; background-color: rgb(248, 250, 252);">نحن نفضل ان نسمع منك؟</p>'],
            ['key' => 'home_section_5_image', 'value' => "1662813590MicrosoftTeams-image.png"],
            ['key' => 'home_main_category', 'value' => "0"],
            ['key' => 'home_category', 'value' => ""],


        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key' => strtolower($value['key'])]), 'count');
            if ($data == 0) {
                $data = ['key' => strtolower($value['key']), 'value' => $value['value'] ?? ""];
                $data = Setting::create($data);
                if (str_contains($data->key, 'home') && in_array($data->key, ['home_section_1_title', 'home_section_1_description', 'home_section_2_title', 'home_section_2_description', 'home_section_3_title', 'home_section_4_title', 'home_section_5_title'])) {
                    foreach (language() as $lang) {
                        $data->translation()->create(['key' => $data->key, 'value' => $value['value'], 'language_id' => $lang->id]);
                    }
                }
                if (str_contains($data->key, 'home') && in_array($data->key, ['home_section_1_image','home_section_5_image'])){
                Media::create(['category_type'=>'Modules\Setting\Entities\Setting','category_id'=>$data->id,'file'=>$value['value'],'type'=>mediaType()['im']]);
                }
            }
        }
    }
}
