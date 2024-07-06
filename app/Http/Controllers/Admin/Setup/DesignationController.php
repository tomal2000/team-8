<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index(): View
    {
        $designations = Designation::paginate(15);
        return view('admin.setup.index',compact('designations'));
    }
}
