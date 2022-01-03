<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/signup",
     *      tags={"회원"},
     *      summary="신규 회원가입",
     *      description="회원가입 API",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RequestSignup")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="회원가입 후, token 과 user 를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSignup")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="정규식에 맞지 않는 필드명과 오류메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSignupInvalidData")
     *      )
     * )
     */
    /**
     * Signup api
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] c_password
     * @param  [string] nickname
     * @param  [string] phone_number
     * @param  [string] gender
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request) {
        $input = $request->all();
        $rules = [
            'name' => ['required', 'regex:/^[가-힣|a-z|A-Z]+$/'],
            'email' => ['required', 'email:filter'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@^$!%*?&])[A-Za-z\d@^$!%*?&]{10,}$/'],
            'c_password' => ['required', 'same:password'],
            'nickname' => ['required', 'regex:/^[a-z]+$/'],
            'phone_number' => ['required', 'numeric'],
            'gender' => [Rule::in(['M', 'F'])],
        ];
        $message = [
            'name.regex' => '이름은 한글, 영어 대문자/소문자 로 입력해주세요',
            'email.email' => '이메일형식을 확인해주세요',
            'password.regex' => '비밀번호는 영어 대문자, 소문자, 특수문자(@^$!%*?&), 숫자가 각 1회 이상씩 포함된 10자리 이상이어야 합니다.',
            'c_password.same' => '동일한 비밀번호를 입력해주세요',
            'nickname.regex' => '닉네임은 영어 소문자 로 입력해주세요',
            'phone_number.numeric' => '전화번호는 숫자만 입력해주세요',
            'gender.in' => '올바른 타입을 입력해주세요: 남성(M), 여성(F)'
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('memberAPI')->accessToken;
        $success['user'] = $user;
        return response()->json(['success'=>$success], 201);
    }

    /**
     * @OA\Post(
     *      path="/api/signin",
     *      tags={"회원"},
     *      summary="로그인",
     *      description="로그인 API",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RequestSignin")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="로그인 후, token 을 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSignin")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="로그인 정보 오류메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSigninInvalidData")
     *      )
     * )
     */
    /**
     * Signin api
     *
     * @param  [string] email
     * @param  [string] password
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request) {
        $input = $request->all();
        if (Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password']
        ])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('memberAPI')->accessToken;
            return response()->json(['success'=>$success], 200);
        } else {
            return response()->json(['error'=>'이메일주소 또는 비밀번호를 확인해주세요'], 401);
        }
    }

    /**
     * Signout api
     *
     * @return \Illuminate\Http\Response
     */
    public function signout() {
        $user = Auth::user();
        $accessToken = $user->token();
        $accessToken->revoke();
        $accessToken->delete();
        $success['message'] = '로그아웃 되었습니다.';
        return response()->json(['success'=>$success], 200);
    }

    /**
     * Details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details() {
        $user = Auth::user();
        $success['user'] = $user;
        return response()->json(['success'=>$success], 200);
    }

    public function list(Request $request) {
        $input = $request->all();

        if (!empty($input['name']) && !empty($input['email'])) {
            return UserResource::collection(User::where([
                ['name', '=', $input['name']],
                ['email', '=', $input['email']]
            ])->get());
        } else if (!empty($input['name'])) {
            return UserResource::collection(User::where('name',$input['name'])->get());
        } else if (!empty($input['email'])) {
            return UserResource::collection(User::where('email',$input['email'])->get());
        } else {
            return UserResource::collection(User::paginate(config('app.per_page')));
        }
    }
}
