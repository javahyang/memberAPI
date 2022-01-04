### Users 테이블
- 회원 테이블
```sql
create table javahyang_database.users
(
    id           bigint unsigned auto_increment
        primary key,
    name         varchar(20)  not null, -- 이름
    email        varchar(255) not null, -- 이메일
    password     varchar(255) not null, -- 비밀번호
    nickname     varchar(30)  not null, -- 별명
    phone_number varchar(20)  not null, -- 전화번호
    gender       char         null, -- 성별
    created_at   timestamp    null,
    updated_at   timestamp    null,
    constraint users_email_unique
        unique (email)
)
collate = utf8mb4_unicode_ci;
```

### Orders 테이블
- 주문정보 테이블
```sql
create table javahyang_database.orders
(
    id           bigint unsigned auto_increment
        primary key,
    email        varchar(255) not null, -- 이메일
    order_number varchar(12)  not null, -- 주문번호
    product_name varchar(100) not null, -- 제품명
    paid_at      datetime     not null, -- 결제일시
    created_at   timestamp    null,
    updated_at   timestamp    null,
    constraint orders_order_number_unique
        unique (order_number)
)
collate = utf8mb4_unicode_ci;
```
