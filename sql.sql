SET FOREIGN_KEY_CHECKS=0;
truncate table products;
truncate table product_variation_types;
truncate table product_variations;
truncate table categories;
truncate table users;
truncate table stocks;
truncate table orders;
truncate table product_variation_order;
truncate table category_product;




insert into categories set name='Coffee', slug='coffee', created_at=now(),updated_at = now();
insert into products set name='Coffee', slug='coffee', price=1000, created_at=now(), updated_at=now();
insert into category_product(category_id, product_id) VALUES(1, 1);

insert into product_variation_types (name, created_at, updated_at) VALUES('Whole bean', now(), now()), ('Ground', now(), now());

insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 1, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '500g', price=1500, product_variations.order = 2, product_variation_type_id = 1, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '1kg', price =2000, product_variations.order = 3, product_variation_type_id = 1, created_at=now(), updated_at=now();


insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 2, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '500g', price=1500, product_variations.order = 2, product_variation_type_id = 2, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '1kg', price = 2000,  product_variations.order = 3, product_variation_type_id = 2,created_at=now(), updated_at=now();



insert into users set name='Alex Garrett-Smith', email='alex@codecourse.com', password='password', created_at=now(), updated_at=now();

INSERT INTO stocks (quantity, product_variation_id, created_at, updated_at)
VALUES(100, 1, now(), now()), (50, 2, now(), noW());

INSERT INTO orders (user_id, created_at, updated_at)
VALUES(1, now(), now());

INSERT INTO product_variation_order (product_variation_id, order_id, quantity, created_at, updated_at)
VALUES(1, 1, 5, now(), now());
--  select count(product_variation_types.id), product_variation_types.name 
--  from product_variations 
--  inner join product_variation_types 
--  on product_variations.product_variation_type_id = product_variation_types.id
-- group by product_variation_types.id;


SET FOREIGN_KEY_CHECKS=1;