<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LayoutApp extends Component
{
    /**
     * Create a new component instance.
     */

    public $categories;
    public function __construct()
    {
        $this->categories = Category::with(['children' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('status', 1)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app');
    }
}
