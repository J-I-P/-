<?php
/**
 * Created by PhpStorm.
 * User: jypin
 * Date: 01/12/2017
 * Time: 1:47 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
//use PHPMailerAutoload;
//use PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require_once 'PHPMailer'
use Carbon\Carbon;
use Illuminate\Http\Request;

class testController extends Controller
{

    public $global_sender_email_user = "U0424029";
    public $global_sender_email_pass = "";
    public $global_sender_email_host = "mail.nuu.edu.tw";


    public function ww(){
        return view('QAQ')->with('aa',"AA");
        //$users = DB::table('data')->select('id', 'name')->get();
        //echo $users;
    }

    public function show(Request $request){
        $name = $request->input('searchbyname');
        $record = DB::table('package')->where('NAME',$name)->where('STATE',NULL)->get();

        return view('show', ['RECORD' => $record]);
    }

    public function update(Request $request){
        $id = $request->input('record_NO');
        $record = DB::table('package')->where('NO',$id)->first();

        return view('changedata', ['RECORD' => $record]);
    }

    public function new(Request $request){

        $name = $request->input('NAME');
        $type = $request->input('TYPE');
        $date = $request->input('RECEIEVE_DATE');
        $test = $request->input('sort');
        $id = $request->input('record_NO');
        if($test==2){
            $place="八甲";
        }
        if($test==1){
            $place="二坪";
        }

        $carbon_today = Carbon::now('Asia/Taipei')->format('Y-m-d');
        //$carbon_today->timezone = new DateTimeZone('Asia/Taipei');
        //$carbon_today = Carbon::createFromFormat('Y-m-d', Carbon::today(), 'Asia/Taipei');


        if ($request->has('update')){
            DB::table('package')->where('NO',$id)->update(['NAME' => $name, 'TYPE' => $type, 'RECEIEVE_DATE' => $date, 'PLACE' => $place, 'MAILED' => $carbon_today, 'STATE' => NULL] );
            $this->mail($id,$name,$type,$place);
            //return redirect()->route('adminpage');
            //$record = DB::table('package')->where('STATE', NULL)->get();

            $new = DB::table('package')
                ->join('student', 'package.NAME', '=', 'student.NAME')
                ->select('package.*', 'student.UNIT')
                ->where('STATE', NULL)
                ->get();

            return view('admin', ['RECORD' => $new]);
        }
        if ($request->has('insert')){
            //$mail = $request->input('MAILED');
            DB::table('package')->insert(['NAME' => $name, 'TYPE' => $type, 'RECEIEVE_DATE' => $date, 'PLACE' => $place, 'MAILED' => $carbon_today, 'STATE' => NULL]);
            $this->mail($id,$name,$type,$place);
            //return redirect()->route('adminpage');
            //$record = DB::table('package')->where('STATE', NULL)->get();

            $new = DB::table('package')
                ->join('student', 'package.NAME', '=', 'student.NAME')
                ->select('package.*', 'student.UNIT')
                ->where('STATE', NULL)
                ->get();

            return view('admin', ['RECORD' => $new]);
        }
    }

    public function delete(Request $request){
        $id = $request->input('record_NO');
        $carbon_today = Carbon::now('Asia/Taipei')->format('Y-m-d');
        DB::table('package')->where('NO',$id)->update(['STATE' => $carbon_today] );

        $new = DB::table('package')
            ->join('student', 'package.NAME', '=', 'student.NAME')
            ->select('package.*', 'student.UNIT')
            ->where('STATE', NULL)
            ->get();

        return view('admin', ['RECORD' => $new]);
    }

    public function enroll(Request $request){
        $username = $request->input('USERNAME');
        $password = $request->input('PASSWORD');
        $token = $request->input('TOKEN');

        if (strcasecmp($token, "qS4GCctn") == 0){
            $record = DB::table('admin')->where('USERNAME', $username)->first();

            if($record == NULL){
                DB::table('admin')->insert(['USERNAME' => $username, 'PASSWORD' => hash('sha256', $password)]);
                return redirect()->route('login');
            }else{
                echo "username existed!!!!!";
            }
        }else{
            echo "token error!!";
        }
    }

    public function login(Request $request){
        $username = $request->input('USERNAME');
        $password = $request->input('PASSWORD');

        $finduser = DB::table('admin')->where([['USERNAME',$username], ['PASSWORD', hash('sha256', $password)]] )->count();
        if ($finduser == 1){

            $request->session()->put('name', $username);
            //$record = DB::table('package')->where('STATE', NULL)->get();

            $new = DB::table('package')
                ->join('student', 'package.NAME', '=', 'student.NAME')
                ->select('package.*', 'student.UNIT')
                ->where('STATE', NULL)
                ->get();

            return view('admin', ['RECORD' => $new]);
        }else{
            return redirect()->route('login');
        }
    }

    public function logout(Request $request){
        if ($request->session()->has('name')) {
            $request->session()->forget('name');
            $request->session()->flush();
        }

        return redirect()->route('homepage');
    }

    public function sendMail($user,$pass,$host,$toAddr,$subject,$content)
    {
        $mail = new PHPMailer;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->CharSet = "utf-8";
        $mail->Encoding = "base64";
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers

        $mail->SMTPAuth = false;
        //$mail->SMTPAuth = true;                               // Enable SMTP authentication
        //$mail->Username = $user;                 // SMTP username
        //$mail->Password = $pass;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Helo = $host;
//$mail->AuthType = 'LOGIN';
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($user.'@'.$host, $user);
        $mail->addAddress($toAddr, $toAddr);     // Add a recipient
        $mail->isHTML(false);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
/*

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent \n';
        }
*/
    }

    public function sendToUser($email, $name, $type, $place)
    {
        mb_internal_encoding('UTF-8');
        $this->sendMail($this->global_sender_email_user,
            $this->global_sender_email_pass,
            $this->global_sender_email_host,
            $email."@smail.nuu.edu.tw",
            "Pin訊息" ,
            "哈囉！".$name." 你的".$type."已送達 ".$place." 的收發室囉！\n請記得前來領取！");
    }

    public function mail($id,$name,$type,$place)
    {
        $new = DB::table('package')
            ->join('student', 'package.NAME', '=', 'student.NAME')
            ->select('package.*', 'student.NUMBER')
            ->where('package.NAME',$name)
            ->first();

        $email = $new->NUMBER;
        $this->sendToUser($email, $name, $type, $place);
        $carbon_today = Carbon::now('Asia/Taipei')->format('Y-m-d');

        DB::table('package')->where('NO', $id)->update(['MAILED' => $carbon_today]);

        return redirect()->route('adminpage');
    }


    public function send()
    {
        $record = DB::table('package')->where('MAILED',Carbon::now('Asia/Taipei')->subDays(3)->ToDateString())->get();
        foreach($record as $user){
            $name = $user->NAME;
            $type = $user->TYPE;
            $place = $user->PLACE;
            $id = $user->NO;

            $new = DB::table('package')
                ->join('student', 'package.NAME', '=', 'student.NAME')
                ->select('package.*', 'student.NUMBER')
                ->where('package.NAME',$name)
                ->first();

            $email = $new->NUMBER;
            $this->sendToUser($email, $name, $type, $place);

            $carbon_today= Carbon::today('Asia/Taipei')->format('Y-m-d');

            DB::table('package')->where('NO', $id)->update(['MAILED' => $carbon_today]);
        }

        $new = DB::table('package')
            ->join('student', 'package.NAME', '=', 'student.NAME')
            ->select('package.*', 'student.UNIT')
            ->where('STATE', NULL)
            ->get();

        return view('admin', ['RECORD' => $new]);

    }

}