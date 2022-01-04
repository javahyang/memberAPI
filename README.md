<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

‼️ `.env` 파일은 `.gitignore` 파일에 포함하는 것이 원칙이나, 샘플프로젝트이므로 본 레포지토리에 업로드하였습니다.

## 실행환경

- PHP 7.4
- [Docker](https://docs.docker.com/engine/install/)


## 실행 준비순서
1. 레포지토리 clone
    ```bash
        git clone https://github.com/javahyang/memberAPI.git
    ```
2. 레포지토리 폴더 위치로 이동
3. `composer` 설치
    ```bash
        composer install
    ```
4. `memberAPI` 프로젝트 실행
    ```bash
        ## laravel sail 프로젝트 실행
        ./vendor/bin/sail up

        ## 또는 편하게 사용하기 위한 알리어스 설정 후 실행
        alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
        sail up
    ```
5. `docker` 에 `composer` 설치
    ```bash
        sail composer install
    ```
6. 인증을 위한 `passport` 클라이언트 생성
    ```bash
        sail artisan passport:install
    ```
7. 데이터베이스 마이그레이션
    ```bash
        sail artisan migrate
    ```
8. 주문목록 API 호출 테스트를 위한 테스트데이터 입력
    ```bash
        sail artisan db:seed
    ```
     - 주문목록(`orders` 테이블)의 이메일주소는 임의의 값입니다. `회원 주문목록 조회`, `전체회원 조회`, `회원 이름/이메일 검색` 을 위해 회원가입한 이메일주소로 `orders` 테이블의 `email` 필드를 수정해야 정상적으로 API 테스트가 가능합니다. 📢

## API 기능
 - **[API Documentation](http://localhost/api/documentation)**
 - 참고: 인증값 설정
   - Bearer {token}
    <img width="1452" alt="set-bearer" src="https://user-images.githubusercontent.com/77231082/148055808-1132c910-4ac0-47fd-a312-7f4b8600865d.png">


 - 회원가입
    ![api:signup](https://user-images.githubusercontent.com/77231082/148053908-c7ebe704-50f5-4b68-9f25-d9b0b32e6c12.png)

 - 로그인
    ![api:signin](https://user-images.githubusercontent.com/77231082/148053779-58033b6d-5b15-4c9b-bed5-d66138a58a3d.png)

 - 회원 상세정보 조회
    ![api:users:details](https://user-images.githubusercontent.com/77231082/148055115-fb77571d-01c2-413b-8f93-04ae5defaa98.png)
    
 - 회원 주문목록 조회
    ![api:orders:details](https://user-images.githubusercontent.com/77231082/148054815-3ee1428b-5871-4caa-81d0-407a01dfa0ef.png)

 - 전체회원 조회(페이지네이션 적용)
    ![GET  api:users](https://user-images.githubusercontent.com/77231082/148054981-7d672234-c86d-48ea-804f-439e86dd2d97.png)
    
 - 회원 이름/이메일 검색
    ![api:users:search](https://user-images.githubusercontent.com/77231082/148060340-56e27612-25ba-4f86-861d-8298825b4fa8.png)

 - 로그아웃
    ![api:signout](https://user-images.githubusercontent.com/77231082/148054052-c8e39594-27e3-4b9e-b7c2-1293cb4ac593.png)
