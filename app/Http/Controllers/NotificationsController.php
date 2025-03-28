<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\AdminAction;
use App\Models\NotesAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotificationsController extends Controller
{
    public function index()
{
    $adminActions = AdminAction::latest()->paginate(50);
    return view('admin.notificationspanel', compact('adminActions'));
}

}
