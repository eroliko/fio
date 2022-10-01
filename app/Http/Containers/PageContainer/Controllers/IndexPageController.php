<?php

declare(strict_types=1);

namespace App\Http\Containers\PageContainer\Controllers;

use App\Http\Core\Controllers\Controller;
use Illuminate\Contracts\View\View;

class IndexPageController extends Controller
{
    public function show(): View
    {
        return view('pages.index', [
            'title' => 'Fio task'
        ]);
    }
}
