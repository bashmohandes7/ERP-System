<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Models\Email;
use App\Models\User;
use App\Notifications\AddEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
class EmailController extends Controller
{

    public function index()
    {
         // Check user id to return his email request
        if(auth()->user()->id){
            $id = auth()->user()->id;
            $emails = \DB::table('emails')->where('user_id', $id)->get();
            return view('emails.index', compact('emails'));

        }
        // return all emails to check by manager and Hr
        $emails= \DB::table('emails')->get();
        return view('emails.index',compact('emails'));
    }

    /**
     * return create email view
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * store email data
     */
    public function store(StoreEmailRequest $request)
    {
        Email::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        // Returns only users with the role 'manager'
        $users = User::role('Manager')->get();

        // send notification to manager
        Notification::send($users, new AddEmail());


        return redirect('emails')->with('success', 'Email has been successfully submited pending for approval');
    }


    /**
     * edit email approval
     */
    public function edit($id)
    {
        $email = \DB::table('emails')->where('id', $id)->first();
        return view('emails.edit', compact('email', 'id'));
    }
    /**
     * check status of email request by manager then notify hr
     */
    public function update(Request $request, $id)
    {
        switch($request->get('approve'))
        {
            case 0:
                Email::pending($id);
                break;
            case 1:
                Email::approve($id);

                $users = User::role('HR')->get();

                // send notification to HR with email id
                Notification::send($users, new AddEmail());
                break;
            case 2:
                Email::reject($id);
                break;
                case 3:
                    Email::postpone($id);

                $users = User::role('HR')->get();

                // send notification to HR with email id
                Notification::send($users, new AddEmail());

                 break;
            default:
                break;

        }
        return redirect('allemails');
    }

    /**
     * Notification mark all as read
     */
    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }

    /**
     * Notifications count
     */

    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    /**
     *  unreaded notifications
     */
    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

       return $notification->data['title'];

        }

    }

}
