<?php

namespace Modules\Debug\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;

class DebugController extends AppBaseController
{
    public function index()
    {
        return view('debug::index');
    }
}
