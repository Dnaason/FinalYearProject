# FinalYearProject
Admin username: naason@gmail.com password:bite


triger code:

CREATE TRIGGER `update status` AFTER UPDATE ON `orders`
 FOR EACH ROW UPDATE order_products SET status=NEW.payment_status WHERE order_id=NEW.id
