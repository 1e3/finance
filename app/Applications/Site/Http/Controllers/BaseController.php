<?php
namespace App\Applications\Site\Http\Controllers;

use App\Core\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $viewNamespace;

    protected function view($view = null, $data = [], $mergeData = [])
    {
        if (!empty($this->viewNamespace) && !str_contains($view, '::')){
            $view = $this->viewNamespace.$view;
        }
        return view($view,$data,$mergeData);
    }
}