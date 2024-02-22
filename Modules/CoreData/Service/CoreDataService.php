<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Basic\Service\CustomTranslationService;
use Modules\Setting\Service\CancellationService;
use Modules\Setting\Service\FqService;
use Modules\Setting\Service\PageService;
use Modules\Setting\Service\SettingService;

class CoreDataService extends BasicService
{
    protected $countryService, $categoryService, $cityService, $genderService, $languageService, $levelService, $nationalityService, $stateService, $socialService, $statusService,
        $customTranslationService, $pageService, $settingService, $fqService, $currencyService, $jobNameService, $tagService,$cancellationService,$areaService;

    public function __construct(CountryService  $countryService, CategoryService $categoryService, CityService $cityService, GenderService $genderService,
                                LanguageService $languageService, LevelService $levelService, NationalityService $nationalityService, StateService $stateService,
                                SocialService   $socialService, StatusService $statusService, CustomTranslationService $customTranslationService, PageService $pageService,
                                SettingService  $settingService, FqService $fqService, CurrencyService $currencyService, JobNameService $jobNameService, TagService $tagService,
    CancellationService $cancellationService,AreaService $areaService)
    {
        $this->countryService = $countryService;
        $this->categoryService = $categoryService;
        $this->cityService = $cityService;
        $this->genderService = $genderService;
        $this->languageService = $languageService;
        $this->levelService = $levelService;
        $this->nationalityService = $nationalityService;
        $this->stateService = $stateService;
        $this->socialService = $socialService;
        $this->statusService = $statusService;
        $this->customTranslationService = $customTranslationService;
        $this->pageService = $pageService;
        $this->settingService = $settingService;
        $this->fqService = $fqService;
        $this->currencyService = $currencyService;
        $this->jobNameService = $jobNameService;
        $this->tagService = $tagService;
        $this->cancellationService = $cancellationService;
        $this->areaService = $areaService;
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        if ($request && isset($request->model) && !empty($request->model)) {
            $data = [];
            if (!is_array($request->model)) {
                $models = explode(',', $request->model);
            } else {
                $models = $request->model;
            }
            foreach ($models as $model) {
                $checkModel = $this->{$model . 'Service'} ?? null;
                if ($checkModel) {
                    $data[$model] = $this->{$model . 'Service'}->list($request, $pagination, $perPage);
                }
            }
            return $data;
        }
        return [];
    }
}
