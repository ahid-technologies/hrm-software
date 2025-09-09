<?php

if (!function_exists('app_logo')) {
    /**
     * Get the application logo URL
     *
     * @return string
     */
    function app_logo()
    {
        $logoPath = config('app.logo');
        return $logoPath && \Illuminate\Support\Facades\File::exists(storage_path('app/public/' . $logoPath))
            ? asset('storage/' . $logoPath)
            : asset('static/grafton-logo.png');
    }
}

if (!function_exists('app_favicon')) {
    /**
     * Get the application favicon URL
     *
     * @return string
     */
    function app_favicon()
    {
        $faviconPath = config('app.favicon');
        return $faviconPath && \Illuminate\Support\Facades\File::exists(storage_path('app/public/' . $faviconPath))
            ? asset('storage/' . $faviconPath)
            : asset('icons/favicon.ico');
    }
}
