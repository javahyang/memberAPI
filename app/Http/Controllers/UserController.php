<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
    public function signup(SignupRequest $request) {
        $input = $request->all();
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
    public function signin(SigninRequest $request) {
        $input = $request->all();
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
     * @OA\Get(
     *      path="/api/users/search",
     *      tags={"회원"},
     *      summary="회원검색",
     *      description="회원검색(이름, 이메일) API",
     *      @OA\Parameter(
     *        name="name",
     *        in="query",
     *        description="검색할 회원 이름(Full name) 또는 성씨(Last name)",
     *        @OA\Schema(type="string"),
     *        example="홍"
     *     ),
     *     @OA\Parameter(
     *       name="email",
     *       in="query",
     *       description="검색할 회원 이메일",
     *       @OA\Schema(type="string"),
     *       example="gildong@test.com"
     *     ),
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
    public function search(SearchRequest $request) {
        $input = $request->all();

        $name = $input['name'] ?? '';
        $email = $input['email'] ?? '';

        if (Str::of($name)->isEmpty() && Str::of($email)->isEmpty()) {
            $error['name'] = ['이름은 한글, 영어 대문자/소문자 로 입력해주세요'];
            $error['email'] = ['이메일형식을 확인해주세요'];
            return response()->json(['error'=>$error], 400);
        } elseif (Str::of($name)->isNotEmpty() && Str::of($email)->isNotEmpty()) {
            return UserResource::collection(User::where([
                ['name', '=', $name],
                ['email', '=', $email]
            ])->get());
        } elseif (Str::of($name)->isNotEmpty()) {
            return UserResource::collection(User::where('name', 'like', $name.'%')->get());
        } elseif (Str::of($email)->isNotEmpty()) {
            return UserResource::collection(User::where('email', $email)->get());
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
