<?php

declare(strict_types=1);

namespace App\Http\Containers\AwardContainer\Controllers;

use App\Http\Containers\AwardContainer\Actions\AwardStoreAction;
use App\Http\Core\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AwardController extends Controller
{
    public function store(
        Request $request,
        AwardStoreAction $awardStoreAction,
    ): RedirectResponse
    {
        try {
            $awardStoreAction->run($request);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with('message', 'Csv data uploaded');
    }
}
