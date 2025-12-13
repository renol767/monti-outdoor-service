<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        
        // Determine which vertical menu to load based on user role
        $verticalMenuFile = 'verticalMenu.json'; // default
        if ($user) {
            if ($user->isAdmin()) {
                $verticalMenuFile = 'adminMenu.json';
            } elseif ($user->isUser()) {
                $verticalMenuFile = 'userMenu.json';
            }
        }
        
        $verticalMenuJson = file_get_contents(base_path('resources/menu/' . $verticalMenuFile));
        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);

        $view->with('menuData', [$verticalMenuData, $horizontalMenuData]);
    }
}
