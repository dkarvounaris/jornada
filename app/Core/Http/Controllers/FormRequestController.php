<?php

namespace App\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * This allows to combine FormRequest and Controller into one. Useful, to have everything in one place,
 * when there isn't much code or when there is no benefit to split into separate classes.
 *
 * It takes care of the issue, that every subsequent request would have been cached and not working properly.
 */
class FormRequestController extends Controller
{
    // TODO: Implementation
}
