<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;

class SidebarBg extends Component
{
    public function render()
    {
        $imagePaths = [
            '_admin/images/sidebar/sd-1.png',
            '_admin/images/sidebar/sd-2.jpg',
            '_admin/images/sidebar/sd-4.jpg',
            '_admin/images/sidebar/sd-3.jpeg',
        ];
        $key = (int)floor(now()->hour / 6);
        $path = $imagePaths[$key] ?? current($imagePaths);
        $with = compact(array_keys(get_defined_vars()));

        return view('components.admin.layout.sidebar-bg')->with($with);
    }
}
