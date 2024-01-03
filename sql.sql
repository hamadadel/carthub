truncate table products;
truncate table product_variation_types;

insert into products set name='Coffee', slug='coffee', price=6000;

insert into product_variation_types (name) VALUES('Whole bean'), ('Ground');

insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 1;
insert into product_variations set product_id = 1,
name = '500g', product_variations.order = 2, product_variation_type_id = 1;
insert into product_variations set product_id = 1,
name = '1kg', product_variations.order = 3, product_variation_type_id = 1;


insert into product_variations set product_id = 1,
name = '250g', product_variations.order = 1, product_variation_type_id = 2;
insert into product_variations set product_id = 1,
name = '500g', product_variations.order = 2, product_variation_type_id = 2;
insert into product_variations set product_id = 1,
name = '1kg', product_variations.order = 3, product_variation_type_id = 2;

