<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\AdminAction;
use App\Models\NotesAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;


class NotificationsController extends Controller
{
    public function index()
    {
        $adminActions = AdminAction::latest()->paginate(50);
        return view('admin.notificationspanel', compact('adminActions'));
    }

    //? A NOTA NAO É CRIADA AQUI, ELA É CRIADA NO MIDDLEWARE LogAdminActions.php

    public function setNotificationAsSeen(Request $request)
    {

        // Marca todas as notificações como 'seen' = 1
        AdminAction::where('seen', 0)->update(['seen' => 1]);

        // Retorna uma resposta de sucesso
        return response()->json(['success' => true]);
    }


}
