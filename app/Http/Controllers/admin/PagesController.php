<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\page;

class PagesController extends Controller
{
    public function index()
    {
        $pages = page::get();
        return view('admin.pages.index',compact('pages'));
    }

    public function addPage()
      {
        return view('admin.pages.add');
      }
}
