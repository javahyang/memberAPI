<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Token",
 *      description="로그인 후 발급되는 엑세스 토큰",
 *      type="object"
 * )
 */

 class ResponseToken
 {
     /**
     * @OA\Property(
     *      title="token",
     *      description="엑세스 토큰값",
     *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDQ4ZWEzNWM2Mjg2YzcwNWI5ZWI5YTEyNTkxYzJjZjZhNjA2NWE2ZWIwNjQ2NjI1ZDIzNzY5NzBlYTg5YjYwYWQ3ZjY5OTA5MGEzODJiMzAiLCJpYXQiOjE2NDExOTM2NjEuMTcwOTg5LCJuYmYiOjE2NDExOTM2NjEuMTcwOTkyLCJleHAiOjE2NzI3Mjk2NjEuMTY4ODg3LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.JvFn3iIvpN4iM8Jzg_3C6gQuwpIpFXf68YahKjAHz1Ts7czPwI4c5CqTEZ-89eoUKvMo2Zvs-JtdwQQU8QgD5pPFQhQCVeQNu6oNvNnA3-UeJICHTQ1ZbcZC1kYmzURvHCWJEyudqqESN_dDWIrSDLFGNx6zzIQnXUXPZY-iN2nmULrzFjlVgyCon6X0OVrgza-BWxDk7cGtCCvDZ5UIaWRPTxCqhZTUZ9cb0JZemghDTIykvubM9LRuEfTXlDBcRSnFz643gy6OmgimZZRoe7KA9tbc0d1XxcaiKkeHU_5kp3MYQwRFTqloNglXrs0JjIOcXBwViNBGlYV-fcjtfGZVMhH7EPxXc2BCRfS_JXDG4WvcuPWFtXpNn87Wnuyg1aN4uEoPF_gWF0kRseP166-7wVIzbpBx_dr4VNQj8-SMd0Laf2l7K2yPvZ4uQTQlxGjJp7xuxscufW5BaiHySQFna_28ei71f5C6IWto3YU5WdNJwt1rrRddhOiiEJQEO3258MeR53K3Vw0bl9b7BUOXNendHsl6piNPXIxtaOudD5I4FWBlStMTQKzy4J853_bNczCcC0H3IutCN9-QTOHwMs3CnMRXShwvJ_wFVBrkuLmauWEhFZyAExtZJUqcvGSSYzyVgVsYqjNhHAMzQLuCSE3eAkJYiKIzbG8OU5A"
     * )
     *
     * @var string
     */
    public $token;
 }
