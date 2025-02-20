<?php
namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Models\activity_log;
use App\Models\Station;
use App\Models\User;
use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    public function login2(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');
      Activity::create([
        'section'=>'Login',
        'action'=>'Login',
        'target'=>'Mobile',
        'user_id'=>$user->id
      ]);

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }


    public function login(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();
        if (!$user || $user->hasRole(['admin', 'Admin'])) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        if ($user === null) {
            return response()
                ->json(
                    [
                        'message' => 'Unauthorized',
                        'phone_number' => $request->phone_number
                    ],
                    401
                );
        }
        if ($user->status === 'suspended') {
            return response()
                ->json(['message' => 'Account suspended, Please contact Admin'], 401);
        }
        try {

//        $station = Station::where('id', $sentryid->premise_id ?? '')->first();
            $user_code = UserCode::all()->pluck("code")->toArray();
            $code = rand(100000, 999999);

            while (in_array($code, $user_code)) {
                $code = rand(100000, 999999);
            }
            $tokenUser = $user->createToken('auth_token')->plainTextToken;
            UserCode::updateOrCreate([
                'user_id' => $user->id,
                'code' => $code
            ]);
            $curl = curl_init();
            $url = 'https://accounts.jambopay.com/auth/token';
            curl_setopt($curl, CURLOPT_URL, $url);

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/x-www-form-urlencoded',
                )
            );

            curl_setopt(
                $curl,
                CURLOPT_POSTFIELDS,
                http_build_query(
                    array(
                        'grant_type' => 'client_credentials',
                        'client_id' => "qzuRm3UxXShEGUm2OHyFgHzkN1vTkG3kIVGN2z9TEBQ=",
                        'client_secret' => "36f74f2b-0911-47a5-a61b-20bae94dd3f1gK2G2cWfmWFsjuF5oL8+woPUyD2AbJWx24YGjRi0Jm8="
                    )
                )
            );

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);

            $token = json_decode($curl_response);
            curl_close($curl);

            $message = 'Your OB verification code is ' . $code;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://swift.jambopay.co.ke/api/public/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(
                    array(
                        "sender_name" => "PASANDA",
                        "contact" => $request->phone_number,
                        "message" => $message,
                        "callback" => "https://pasanda.com/sms/callback"
                    )
                ),

                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token->access_token
                ),
            ));
            $responsePassanda = curl_exec($curl);
            curl_close($curl);

            Activity::create([
                'user_id' => $user->id,
                'target' => "Mobile",
                'section' => "Login",
                'action' => "User Logged in"
            ]);
//            $user->last_login_at = now();
//            $user->save();
          $user = User::updateOrCreate(
            ['id' => $user->id],
            ['last_login_at' => now()]
          );
            return response()->json([
                "success" => true,
                "token_type" => 'Bearer',
                "message" => "User Logged in",
                "access_token" => $tokenUser,
                "user" => $user,
                "code" => $code,
                "response" => $responsePassanda,
            ]);
        }catch (Exception $ex){
        return response()->json([
            "success" => false,
            "message" => "Logged in Error",
            "response" => "Error occurred while trying yo login ",
            "details"=>$ex
        ]);
    }
    }

    /**
     * verify otp
     *
     * @return \Illuminate\Http\JsonResponse()
     */
    public function verifyOTP($number, $otp)
    {
        $exists = UserCode::where('code', $otp)
            ->where('updated_at', '>=', now()->subMinutes(5))
            ->latest('updated_at')
            ->first();
        if (!$exists){
            return response()->json(['message' => 'Invalid OTP entered'], 406);
        }
        $user = DB::table('users')->where('id', $exists->user_id)->first();
        if ($user) {
          Activity::create([
            'section'=>'Verify OTP',
            'action'=>'Valid OTP',
            'target'=>'Mobile',
            'user_id'=>$user->id
          ]);
            return response()->json(
                [
                    'message' => 'Valid OTP entered'
                ],
                200
            );
        }
      Activity::create([
        'section'=>'Verify OTP',
        'action'=>'Invalid OTP',
        'target'=>'Mobile',
        'user_id'=>$user->id
      ]);
        return response()->json(['message' => 'Invalid OTP entered'], 406);
    }

    public function verifyOTP1(Request $request, $otp)
    {
        $exists = UserCode::where('code', $otp)
            ->where('updated_at', '>=', now()->subMinutes(5))
            ->latest('updated_at')
            ->exists();
        if ($exists) {
            return response()->json(['message' => 'Valid OTP entered'], 200);
        }
        return response()->json(['message' => 'Invalid OTP entered'], 406);
    }
  public function updatePassword(Request $request)
  {

    $request->validate([
      'phone_number' => 'required|string|exists:users',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

    ]);

    User::where('phone_number', $request->phone_number)->update(['password' => Hash::make($request->password)]);
    $activityLog = new activity();
    $activityLog->activity = 'Password  updating';
    $activityLog->section = 'Mobile';
    $activityLog->action = 'Password ' . $request->user()->name . ' successfully updated ';
    $activityLog->user_id = auth()->user()->id;
    $activityLog->save();

    return response()->json(['message' => 'Password has been changed sucessfully']);

  }
}
