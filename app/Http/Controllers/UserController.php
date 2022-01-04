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
     *          response=400,
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
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $result['token'] = $user->createToken('memberAPI')->accessToken;
        $result['user'] = $user;
        return response()->json($result, 201);
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
     *          response=400,
     *          description="정규식에 맞지 않는 필드명과 오류메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSigninInvalidData")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="로그인 정보 오류메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSigninFail")
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
        $rules = [
            'email' => ['required'],
            'password' => ['required'],
        ];
        $message = [
            'email.required' => '이메일을 입력해주세요',
            'password.required' => '비밀번호를 입력해주세요',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        if (Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password']
        ])) {
            $user = Auth::user();
            $result['token'] =  $user->createToken('memberAPI')->accessToken;
            return response()->json($result, 200);
        } else {
            return response()->json(['error'=>'이메일주소 또는 비밀번호를 확인해주세요'], 401);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/users/details",
     *      tags={"회원"},
     *      summary="회원 상세정보",
     *      description="회원 상세정보 조회 API",
     *      security={ {"bearer_token": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="로그인한 회원정보를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseUsersDetails")
     *      )
     * )
     */
    /**
     * Users details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details() {
        $user = Auth::user();
        $result['user'] = $user;
        return response()->json($result, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/users",
     *      tags={"회원"},
     *      summary="회원목록",
     *      description="회원목록 조회 API",
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="페이지네이션의 페이지 넘버",
     *          required=false,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *          example=1
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="회원목록을 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseUsers")
     *      )
     * )
     */
    /**
     * Users list api
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        return UserResource::collection(User::paginate(config('app.per_page')));
    }

    /**
     * @OA\Post(
     *      path="/api/users/search",
     *      tags={"회원"},
     *      summary="회원검색",
     *      description="회원검색(이름, 이메일) API",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RequestUsers")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="이름, 이메일로 검색한 회원정보를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseUsers")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="정규식에 맞지 않는 필드명과 오류메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseUsersInvalidData")
     *      )
     * )
     */
    /**
     * Search api
     *
     * @param  [string] name
     * @param  [string] email
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $input = $request->all();
        $rules = [
            'name' => ['nullable', 'regex:/^[가-힣|a-z|A-Z]+$/'],
            'email' => ['nullable', 'email:filter'],
        ];
        $message = [
            'name.regex' => '이름은 한글, 영어 대문자/소문자 로 입력해주세요',
            'email.email' => '이메일형식을 확인해주세요',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        if (!empty($input['name']) && !empty($input['email'])) {
            return UserResource::collection(User::where([
                ['name', '=', $input['name']],
                ['email', '=', $input['email']]
            ])->get());
        } else if (!empty($input['name'])) {
            return UserResource::collection(User::where('name', 'like', $input['name'].'%')->get());
        } else if (!empty($input['email'])) {
            return UserResource::collection(User::where('email', $input['email'])->get());
        }
    }

    /**
     * @OA\Get(
     *      path="/api/signout",
     *      tags={"회원"},
     *      summary="로그아웃",
     *      description="로그아웃 API",
     *      security={ {"bearer_token": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="로그아웃 메시지를 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseSignout")
     *      )
     * )
     */
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
        $result['message'] = '로그아웃 되었습니다.';
        return response()->json($result, 200);
    }
}
