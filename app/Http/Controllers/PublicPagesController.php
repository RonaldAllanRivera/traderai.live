<?php

namespace App\Http\Controllers;

use App\Settings\SiteAppearanceSettings;
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
    protected function resolveTemplate(): string
    {
        /** @var SiteAppearanceSettings $settings */
        $settings = app(SiteAppearanceSettings::class);
        $selected = trim((string) ($settings->public_template ?? ''));
        $available = array_keys((array) config('templates.available', []));
        $default = (string) config('templates.default', 'traderai-template');

        // Fallback to default if invalid
        if ($selected === '' || ! in_array($selected, $available, true)) {
            return $default;
        }
        return $selected;
    }

    public function home(Request $request)
    {
        $tpl = $this->resolveTemplate();
        $view = $tpl . '.home';
        if (! view()->exists($view)) {
            $view = config('templates.default', 'traderai-template') . '.home';
        }
        return view($view);
    }

    public function safe()
    {
        $tpl = $this->resolveTemplate();
        $view = $tpl . '.safe';
        if (! view()->exists($view)) {
            $view = config('templates.default', 'traderai-template') . '.safe';
        }
        return view($view);
    }

    public function redirect()
    {
        $tpl = $this->resolveTemplate();
        $view = $tpl . '.redirect';
        if (! view()->exists($view)) {
            $view = config('templates.default', 'traderai-template') . '.redirect';
        }
        return view($view);
    }
}
