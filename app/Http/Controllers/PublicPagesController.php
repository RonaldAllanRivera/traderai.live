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
        $slug = $tpl;
        $view = $tpl . '.home';
        if (! view()->exists($view)) {
            $slug = (string) config('templates.default', 'traderai-template');
            $view = $slug . '.home';
        }
        return view($view, [
            'assetBase' => rtrim(request()->getSchemeAndHttpHost(), '/') . '/' . trim($slug, '/') . '/',
        ]);
    }

    public function safe()
    {
        $tpl = $this->resolveTemplate();
        $slug = $tpl;
        $view = $tpl . '.safe';
        if (! view()->exists($view)) {
            $slug = (string) config('templates.default', 'traderai-template');
            $view = $slug . '.safe';
        }
        return view($view, [
            'assetBase' => rtrim(request()->getSchemeAndHttpHost(), '/') . '/' . trim($slug, '/') . '/',
        ]);
    }

    public function redirect()
    {
        $tpl = $this->resolveTemplate();
        $slug = $tpl;
        $view = $tpl . '.redirect';
        if (! view()->exists($view)) {
            $slug = (string) config('templates.default', 'traderai-template');
            $view = $slug . '.redirect';
        }
        return view($view, [
            'assetBase' => rtrim(request()->getSchemeAndHttpHost(), '/') . '/' . trim($slug, '/') . '/',
        ]);
    }

    public function terms()
    {
        $tpl = $this->resolveTemplate();
        $view = $tpl . '.terms';
        if (! view()->exists($view)) {
            $slug = (string) config('templates.default', 'traderai-template');
            $view = $slug . '.terms';
        }
        return view($view);
    }

    public function privacyPolicy()
    {
        $tpl = $this->resolveTemplate();
        $view = $tpl . '.privacy-policy';
        if (! view()->exists($view)) {
            $slug = (string) config('templates.default', 'traderai-template');
            $view = $slug . '.privacy-policy';
        }
        return view($view);
    }
}
