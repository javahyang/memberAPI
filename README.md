<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

‼️ `.env` 파일은 `.gitignore` 파일에 포함하는 것이 원칙이나, 샘플프로젝트이므로 현재 레포지토리에 업로드하였습니다.

## 실행환경

- [Docker](https://docs.docker.com/engine/install/)


## 실행 준비순서
1. 레포지토리 clone
    ```bash
        git clone https://github.com/javahyang/memberAPI.git
    ```
2. 레포지토리 폴더 위치로 이동
3. `memberAPI` 프로젝트 실행
    ```bash
        ## laravel sail 프로젝트 실행
        ./vendor/bin/sail up

        ## 또는 편하게 사용하기 위한 알리어스 설정 후 실행
        alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
        sail up
    ```
4. `docker` 에 `composer` 설치
    ```bash
        sail composer install
    ```
5. 인증을 위한 `passport` 클라이언트 생성
    ```bash
        sail artisan passport:install
    ```
6. 데이터베이스 마이그레이션
    ```bash
        sail artisan migrate
    ```
7. 주문목록 API 호출 테스트를 위한 테스트데이터 입력
    ```bash
        sail artisan db:seed
    ```


## API 기능
 - **[API Doc](http://localhost/api/documentation)**
 - 회원가입
 - 로그인
 - 로그아웃
 - 회원 상세정보 조회
 - 회원 주문목록 조회
 - 전체회원 조회
