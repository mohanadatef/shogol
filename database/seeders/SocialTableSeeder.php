<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Basic\Entities\Media;
use Modules\CoreData\Entities\Social;

class SocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social = [
            [
                'order' => 1,
                'name' => 'بحر',
                'file' => 'download (7).png',
            ]
            ,[
                'order' => 2,
                'name' => 'مستقل',
                'file' => 'Mostaql-Logo.svg',
            ],[
                'order' => 3,
                'name' => 'خمسات',
                'file' => 'download (5).png',
            ],[
                'order' => 4,
                'name' => 'حراج',
                'file' => 'download (4).png',
            ],[
                'order' => 5,
                'name' => 'مستعمل',
                'file' => 'download (1).jpeg',
            ],[
                'order' => 6,
                'name' => 'السوق المفتوح',
                'file' => 'download (3).png',
            ],[
                'order' => 7,
                'name' => 'فري لانسر',
                'file' => 'Freelancer 60.svg',
            ],[
                'order' => 8,
                'name' => 'اب ورك',
                'file' => 'Upwork.svg',
            ],[
                'order' => 9,
                'name' => 'فايفر',
                'file' => 'download.jpeg',
            ],[
                'order' => 10,
                'name' => 'بنترست',
                'file' => 'Mask Group 59.svg',
            ],[
                'order' => 11,
                'name' => 'انستقرام',
                'file' => 'Instagram_logo_2016.svg.svg',
            ],[
                'order' => 12,
                'name' => 'تويتر',
                'file' => 'Mask Group 62.svg',
            ],[
                'order' => 13,
                'name' => 'فيس بوك',
                'file' => 'Mask Group 64.svg',
            ],[
                'order' => 14,
                'name' => 'لينكند',
                'file' => 'LinkedIn_logo_initials.png',
            ],[
                'order' => 15,
                'name' => 'سناب',
                'file' => 'Mask Group 61.svg',
            ],[
                'order' => 16,
                'name' => 'تيك توك',
                'file' => 'tiktok.png',
            ]
        ];
        foreach ($social as $value) {
            $data = Social::create(['order'=>$value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
            Media::create(['category_type'=>'Modules\CoreData\Entities\Social','category_id'=>$data->id,'file'=>$value['file'],'type'=>mediaType()['lm']]);
        }
    }
}
