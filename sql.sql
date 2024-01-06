truncate table products;
truncate table product_variation_types;
truncate table categories;
truncate table users;


insert into products set name='Coffee', slug='coffee', price=6000, created_at=now(), updated_at=now();

insert into product_variation_types (name, created_at, updated_at) VALUES('Whole bean', now(), now()), ('Ground', now(), now());

insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 1, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '500g', product_variations.order = 2, product_variation_type_id = 1, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '1kg', product_variations.order = 3, product_variation_type_id = 1, created_at=now(), updated_at=now();


insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 2, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '500g', product_variations.order = 2, product_variation_type_id = 2, created_at=now(), updated_at=now();
insert into product_variations set product_id = 1,
name = '1kg', product_variations.order = 3, product_variation_type_id = 2,created_at=now(), updated_at=now();



-- insert into users set name='Alex Garrett-Smith', email='alex@codecourse.com', password='password', created_at=now(), updated_at=now();

 select count(product_variation_types.id), product_variation_types.name 
 from product_variations 
 inner join product_variation_types 
 on product_variations.product_variation_type_id = product_variation_types.id
group by product_variation_types.id;

