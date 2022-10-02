<?php

declare(strict_types=1);

namespace App\Http\Containers\PageContainer\Controllers;

use App\Http\Containers\AwardContainer\Actions\AwardGetAction;
use App\Http\Core\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    public function show(AwardGetAction $awardGetAction, Request $request): View
    {
        return view('pages.index', [
            'title' => 'Fio task',
            'paginationHandle' => null,
            'groups' => $awardGetAction->getGroupedByYear(),
            'sharedMoviesPaginator' => $awardGetAction->getSharedAwards($request)
        ]);
    }
}
