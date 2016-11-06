<?php


class MessagesController extends BaseController {

    /**
     * Tweet Repository
     *
     * @var Tweet
     */
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function getMyMessages(){
// Get all the blog posts
        // return $this->post->all();
        $posts = $this->post->with(array(
            'author' => function ($query) {
                $query->withTrashed();
            },
        ))->orderBy('created_at', 'DESC')->paginate();

        return View::make('backend/account/messages');


    }
    public function getUserMessages($user_id){

        // check whether the user have any submitted messages
//        $user = Sentry::getUser();

        // get the message list
        $total_messages = Message::where('user_id','=',$user_id)->count();

        // if sif application is on live
        $today = date("Y-m-d");
//        $adverts = Advertisement::where('end', '>', $today)
//            ->where('start', '<', $today)
//            ->get();
        $user = User::where('id', '=', $user_id)->firstOrFail();
        $messages = $this->message
            ->with('category')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
//        var_dump($messages[0]->category->name);return;
        return View::make('backend/account/messages', compact('messages','user'));
    }
    public function getCreate()
    {
        return View::make('backend/account/messages');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(){
        try{

            $input = Input::all();
            $redirect = Input::get('redirect');
            $receiver = User::where('mobile','=',Input::get('receiver_mobile'))->first();

            if(is_null($receiver)){
                return Redirect::back()->with('error', Lang::get('messages/message.send_fail'));
            }
            DB::beginTransaction();
            $input['receiver_mobile']  = $receiver->mobile;
            $input['receiver_id']  = $receiver->id;
            $sender = Sentry::getUser();
            $input['sender_id']  = $sender->id;
            $input['sender_mobile']  = $sender->mobile;
            // var_dump($input); return;
            unset($input['to']);
            unset($input['redirect']);
            if ($this->message->create($input)) {

                $this->sendSMS($sender->mobile, $receiver->mobile,$input['body']);
                DB::commit();
                return Redirect::route($redirect)->with('success', Lang::get('messages/message.success'));
            }
        }catch(\Exception $e){
            DB::rollback();
            return Redirect::back()->with('error', Lang::get('messages/message.send_fail'));
        }
    }
    private function sendSMS($sender_no, $receiver_no,$msg) {
        $SMSGateway = "http://123.49.3.58:8081/web_send_sms.php";
        $SMSuser = "cG1vZmZpY2U=";
        $SMSpassw = "cG1vZmZpY2U=";
        $txt = urlencode($msg."\nFrom: ".$sender_no);
        return file_get_contents("$SMSGateway?ms=88{$receiver_no}&txt={$txt}&username=" . base64_decode($SMSuser) . '&password=' . base64_decode($SMSpassw));
    }
    /* public function getView(){

         // Get the user information
         $user = Sentry::getUser();
 //        var_dump($user); return;
         $applicant = Sentry::findGroupByName('Applicant');
         if ($user->inGroup($applicant)) {
 //            $layout = "frontend";
             return View::make('backend/account/messages', compact('user'));
         }
     }*/
    public function getIndex($userId)
    {

        $user = User::where('id','=',$userId)->first();
        $msg_user_list = DB::select( DB::raw("
SELECT MAX(tt.created_at) AS 'msg_time', tt.user_id, tt.in_out, u.`first_name`, u.`mobile`
FROM
(
SELECT receiver_id AS 'user_id', created_at, 'OUT' AS 'in_out' FROM `messages` WHERE sender_id = {$userId}
UNION
SELECT sender_id AS 'user_id', created_at, 'IN' AS 'in_out' FROM `messages` WHERE receiver_id = {$userId}
) tt
INNER JOIN `users` u ON tt.user_id = u.id
GROUP BY tt.user_id
ORDER BY msg_time DESC
") );

        return View::make('backend/account/messages', compact('msg_user_list','user'));
    }

    public function getUserMsg($senderId,$receiverId){
//        $user = Sentry::getUser();
        $user_msg = DB::select( DB::raw("
SELECT * FROM (
SELECT body, created_at, 'OUT' AS 'in_out' FROM `messages` WHERE sender_id = {$senderId} AND receiver_id = {$receiverId}
UNION
SELECT body, created_at, 'IN' AS 'in_out' FROM `messages` WHERE sender_id = {$receiverId} AND receiver_id = {$senderId}
) AS tt
ORDER BY created_at ASC
") );
//        var_dump($user_msg); return;

        return View::make('messages.view', compact('user_msg','user'));
    }
    public function getView($messageId){

//        $message = $this->message
//            ->where('sender_id', $messageId->id)
//            ->with('body')
//            ->orderBy('created_at', 'DESC');
//
//        if (is_null($message))
//        {
//            return Redirect::route('messages');
//        }
//        $user = Sentry::getUser();
//        //var_dump($user); return;
//        $applicant = Sentry::findGroupByName('Applicant');
//        if ($user->inGroup($applicant)){
//            return View::make('backend.account.view', compact('message','user'));
//        }
//        else{
//            return View::make('messages.view', compact('message','user'));
//        }
        return View::make('backend.account.view');
    }


}
