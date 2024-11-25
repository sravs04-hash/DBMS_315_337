use gym;
SELECT * FROM gym;
-- SOURCE C:/xampp/htdocs/gymproj/gym_queries.sql;

-- Step 2: Insert records into gym table if necessary
INSERT INTO gym (gym_id, gym_name,address,type) VALUES
('GYM9', 'City Gym','Indiranagar','unisex'),
('GYM10', 'Fitness Center','hebbal','male');

-- Step 3: Insert records into payment table
INSERT INTO payment (pay_id, amount, gym_id) VALUES
('Payment9', '1000', 'GYM8'),
('Payment10', '2000', 'GYM9'),
('Payment11', '1500', 'GYM10');

INSERT INTO subscriptions (mem_id, exercise, duration, price) 
VALUES (20, 'Boxing', 1, 10500);

INSERT INTO subscriptions (mem_id, exercise, duration, price) 
VALUES (21, 'Zumba', 3, 27000);

-- update queries
UPDATE gym 
SET address = 'New Shiv Nagar' 
WHERE gym_id = 'GYM1';

UPDATE member 
SET package = '6000', age = '27' 
WHERE mem_id = 'M1';

UPDATE trainer 
SET mobileno = '9876543210' 
WHERE trainer_id = 'T1';

UPDATE subscriptions 
SET price = 11000.00 
WHERE exercise = 'Zumba' AND duration = 1;

DELETE FROM gym 
WHERE gym_id = 'GYM8';

DELETE FROM member 
WHERE mem_id = 'M2';

DELETE FROM trainer 
WHERE trainer_id = 'T3';

-- Create Trigger for before_member_insert
DELIMITER //

CREATE TRIGGER before_member_insert
BEFORE INSERT ON member
FOR EACH ROW
BEGIN
    -- Check if the member is associated with any subscription
    DECLARE subscription_count INT;
    
    -- Ensure member has at least one subscription record
    SELECT COUNT(*) INTO subscription_count
    FROM subscriptions
    WHERE mem_id = NEW.mem_id;
    
    -- If no subscription exists, raise an error
    IF subscription_count = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No valid subscription found for the member!';
    END IF;
END;

//
DELIMITER ;

INSERT INTO member (mem_id, name, dob, age, package, mobileno, pay_id, trainer_id)
VALUES ('M7', 'John Doe', '1995-05-15', 28, '67890', '9998887777', 'Payment7', 'T6');



-- Create Stored Procedure
DELIMITER //
CREATE PROCEDURE AddSubscription(
    IN exercise_name VARCHAR(50),
    IN duration INT,
    IN price DECIMAL(10, 2)
)
BEGIN
    INSERT INTO subscriptions (exercise, duration, price)
    VALUES (exercise_name, duration, price);
END;
//
DELIMITER ;
CALL AddSubscription('HRX Workout', 6, 18000.00);


-- FUNCTION FOR GETTING PAYMENT AMOUNT BASED ON ID
DELIMITER $$

CREATE FUNCTION get_payment_amount(payment_id VARCHAR(20))
RETURNS VARCHAR(20)
READS SQL DATA
BEGIN
    DECLARE payment_amount VARCHAR(20);
    
    SELECT amount INTO payment_amount
    FROM payment
    WHERE pay_id = payment_id;
    
    RETURN payment_amount;
END $$

DELIMITER ;

SELECT get_payment_amount('Payment1') AS PaymentAmount;

-- Sample Queries
-- Nested Query
SELECT *
FROM subscriptions
WHERE exercise = (
    SELECT exercise
    FROM subscriptions
    ORDER BY price DESC
    LIMIT 1
);

-- Join Query
SELECT m.name, s.exercise, s.duration, s.price
FROM member m
JOIN subscriptions s ON m.mem_id = s.mem_id;



-- JOIN QUERY WITH TABLES SUBSCRIPTIONS,TRAINER,PAYMENT
SELECT m.name, t.name, s.exercise, s.duration, s.price, p.amount
FROM member m
INNER JOIN subscriptions s ON m.mem_id = s.mem_id
INNER JOIN trainer t ON m.trainer_id = t.trainer_id
INNER JOIN payment p ON m.mem_id = p.gym_id;

-- Aggregate Query
SELECT SUM(price) AS total_revenue
FROM subscriptions;

-- procedure
-- Example: Procedure to calculate the total price for a member
DELIMITER $$

CREATE PROCEDURE calculate_total_price(IN member_id INT)
BEGIN
    SELECT SUM(price) AS total_price
    FROM subscriptions
    WHERE mem_id = member_id;
END $$

DELIMITER ;

-- Call the procedure for member with ID 1
CALL calculate_total_price(1);

-- aggregrate
-- Get the number of subscriptions per exercise type
SELECT exercise, COUNT(*) AS number_of_subscriptions
FROM subscriptions
GROUP BY exercise;

-- average
-- Get the average price of subscriptions
SELECT AVG(price) AS average_price
FROM subscriptions;
