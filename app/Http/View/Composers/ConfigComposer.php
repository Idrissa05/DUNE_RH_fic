<?php
namespace App\Http\View\Composers;


use App\Config;
use Illuminate\View\View;

class ConfigComposer {


    public function compose(View $view) {

        $config = Config::first() ?? new Config();

        $view->with('config', $config);
    }
}
