<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\Controllers\Breadcrumbs;
use App\Traits\Controllers\HasMessages;
use App\Traits\Controllers\SEOMeta;

abstract class BaseController extends Controller
{
    use HasMessages;
    use Breadcrumbs;
    use SEOMeta;

    public function __construct() { }
}











