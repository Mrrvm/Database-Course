# Labs resolutions
(This might not be completely correct. Exercises that aren't listed are just follow-throughs.)

- [Lab 1](#lab-1)
- [Lab 2](#lab-2)
  * [E-R models](#e-r-models)
    + [Exercise 1](#exercise-1)
    + [Exercise 2](#exercise-2)
    + [Exercise 3](#exercise-3)
    + [Exercise 4](#exercise-4)
- [Lab 3](#lab-3)
  * [Conversion of E-R models to Relational Models](#conversion-of-e-r-models-to-relational-models)
    + [Exercise 1](#exercise-1-1)
    + [Exercise 2](#exercise-2-1)
    + [Exercise 3](#exercise-3-1)
    + [Exercise 4](#exercise-4-1)
    + [Notes](#notes)
- [Lab 4](#lab-4)
  * [Introduction to SQL](#introduction-to-sql)
    + [PART I: Some basic experiments](#part-i--some-basic-experiments)
    + [Exercise 8](#exercise-8)
    + [Exercise 9](#exercise-9)
    + [Exercise 10](#exercise-10)
    + [Exercise 12](#exercise-12)
    + [Exercise 13](#exercise-13)
    + [Exercise 14](#exercise-14)
    + [Exercise 15](#exercise-15)
    + [PART II: Querying the database](#part-ii--querying-the-database)
    + [Exercise 1](#exercise-1-2)
    + [Exercise 2](#exercise-2-2)
    + [Exercise 3](#exercise-3-2)
    + [Exercise 4](#exercise-4-2)
    + [Exercise 5](#exercise-5)
    + [Exercise 6](#exercise-6)
    + [Exercise 7](#exercise-7)
    + [Exercise 8](#exercise-8-1)
    + [Exercise 9](#exercise-9-1)
    + [Notes](#notes-1)
- [Lab 5](#lab-5)
  * [SQL Queries](#sql-queries)
    + [Exercise 1](#exercise-1-3)
    + [Exercise 2](#exercise-2-3)
    + [Exercise 3](#exercise-3-3)
    + [Exercise 4](#exercise-4-3)
    + [Exercise 5](#exercise-5-1)
    + [Exercise 6](#exercise-6-1)
    + [Exercise 7](#exercise-7-1)
    + [Exercise 8](#exercise-8-2)
    + [Exercise 9](#exercise-9-2)
    + [Exercise 10](#exercise-10-1)
    + [Exercise 11](#exercise-11)
    + [Exercise 12](#exercise-12-1)
    + [Exercise 13](#exercise-13-1)
    + [Exercise 14](#exercise-14-1)
    + [Exercise 15](#exercise-15-1)
    + [Notes](#notes-2)
- [Lab 6](#lab-6)
  * [Advanced SQL](#advanced-sql)
    + [Part I: Customers with accounts in every branch of Brooklyn](#part-i--customers-with-accounts-in-every-branch-of-brooklyn)
    + [Exercise 1](#exercise-1-4)
    + [Exercise 2](#exercise-2-4)
    + [Exercise 3](#exercise-3-4)
    + [Exercise 4](#exercise-4-4)
    + [Exercise 5](#exercise-5-2)
    + [Exercise 6](#exercise-6-2)
    + [Exercise 7](#exercise-7-2)
    + [Part II: Customers with accounts in every branch of the city where they live](#part-ii--customers-with-accounts-in-every-branch-of-the-city-where-they-live)
    + [Exercise 8](#exercise-8-3)
    + [Exercise 9](#exercise-9-3)
    + [Exercise 10](#exercise-10-2)
    + [Exercise 11](#exercise-11-1)
- [Lab 7](#lab-7)
  * [Functions, Stored Procedures and Triggers](#functions--stored-procedures-and-triggers)
    + [Part I: Functions](#part-i--functions)
    + [Exercise 1](#exercise-1-5)
    + [Exercise 3](#exercise-3-5)
    + [Part II: Stored Procedures](#part-ii--stored-procedures)
    + [Exercise 4](#exercise-4-5)
    + [Exercise 5](#exercise-5-3)
    + [Part III: Triggers](#part-iii--triggers)
    + [Exercise 6](#exercise-6-3)
    + [Exercise 7](#exercise-7-3)
    + [Notes](#notes-3)
- [Lab 9](#lab-9)
  * [PHP and MySQL](#php-and-mysql)
    + [Notes](#notes-4)
- [Lab 10](#lab-10)
  * [Transactions](#transactions)
    + [Notes](#notes-5)
- [Lab 11](#lab-11)
  * [Data Warehouse](#data-warehouse)
    + [Exercise 15](#exercise-15-2)
    + [Exercise 16](#exercise-16)
    + [Exercise 17](#exercise-17)
    + [Exercise 18](#exercise-18)
    + [Exercise 19](#exercise-19)
    + [Exercise 20](#exercise-20)
    + [Notes](#notes-6)
- [Final notes](#final-notes)


## Lab 1 
Upload a database as such to a server. Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab01_en.pdf). The files are in `lab1/`.
<a>
  <img src="https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab1/bank.png">
</a>

## Lab 2
### E-R models
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab02_en.pdf).
#### Exercise 1
<a>
  <img src="https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab2/lab2ex1.png">
</a>

#### Exercise 2
<a>
  <img src="https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab2/lab2ex2.png">
</a>

#### Exercise 3
<a>
  <img src="https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab2/lab2ex3.png">
</a>

#### Exercise 4
<a>
  <img src="https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab2/lab2ex4.png">
</a>

## Lab 3
### Conversion of E-R models to Relational Models
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab03_en.pdf).
#### Exercise 1

**author**(<ins>name</ins>, <ins>address</ins>, URL)

**book**(<ins>ISB</ins>, price, title, year)

**publisher**(<ins>name</ins>, address, URL, phone)

**customer**(<ins>email</ins>, name, address, phone)

**shopping-basket**(<ins>basketID</ins>)

**warehhouse**(<ins>code</ins>, address, phone)

**written_by**(<ins>name</ins>, <ins>address</ins>, <ins>ISB</ins>)

&nbsp;&nbsp; name: FK(author)

&nbsp;&nbsp; address: FK(author)
  
&nbsp;&nbsp; ISB: FK(book)

**published_by**(<ins>name</ins>, <ins>ISB</ins>)

&nbsp;&nbsp; name: FK(publisher)

&nbsp;&nbsp; ISB: FK(book)

**contains**(<ins>ISB</ins>, <ins>basketID</ins>, number)

&nbsp;&nbsp; ISB: FK(book)

&nbsp;&nbsp; basketID: FK(shopping-basket)

**basket-of**(<ins>email</ins>, <ins>basketID</ins>)

&nbsp;&nbsp; basketID: FK(shopping-basket)

&nbsp;&nbsp; email: FK(customer)

**stocks**(<ins>ISB</ins>, <ins>code</ins>, number)

&nbsp;&nbsp; ISB: FK(book)

&nbsp;&nbsp; code: FK(warehouse)

#### Exercise 2

**student**(<ins>sid</ins>, name, program)

**instructor**(<ins>iid</ins>, name, dept, title)

**course**(<ins>courseno</ins>, syllabus, title, credits)

**course_offerings**(<ins>courseno</ins>, <ins>year</ins>, <ins>semester</ins>, time, secno, room)

&nbsp;&nbsp; courseno: FK(course)

**enrols**(<ins>sid</ins>, <ins>courseno</ins>, <ins>year</ins>, <ins>semester</ins>, grade)

&nbsp;&nbsp; sid: FK(student)

&nbsp;&nbsp; courseno: FK(course)

&nbsp;&nbsp; year: FK(course_offerings)

&nbsp;&nbsp; semester: FK(course_offerings)

**teaches**(<ins>iid</ins>, <ins>courseno</ins>, <ins>year</ins>, <ins>semester</ins>)

&nbsp;&nbsp; iid: FK(student)

&nbsp;&nbsp; courseno: FK(course)

**requires**(<ins>main_courseno</ins>, <ins>pre_courseno</ins>)

&nbsp;&nbsp; main_courseno: FK(course)

&nbsp;&nbsp; pre_courseno: FK(course)

#### Exercise 3

**Employee**(<ins>Number</ins>, Name)

**Mechanic**(<ins>Number</ins>)

&nbsp;&nbsp; Number: FK(Employee)

**Salesman**(<ins>Number</ins>)

&nbsp;&nbsp; Number: FK(Employee)

**RepairJob**(<ins>License</ins>, Number, Description, Parts, Work)

&nbsp;&nbsp; License: FK(Car)

**Does**(<ins>License</ins>, <ins>Employee_Number</ins>, <ins>Number</ins>)

&nbsp;&nbsp; License: FK(Car)

&nbsp;&nbsp; Employee_Number: FK(Employee)

**Car**(<ins>License</ins>, Manufacturer, Model, Year)

**Client**(<ins>ID</ins>, Name, Address, Phone)

**Buys**(<ins>License</ins>, <ins>ID</ins>, <ins>Number</ins>, Price, Date, Value)

&nbsp;&nbsp; License: FK(Car)

&nbsp;&nbsp; Number: FK(Employee)

&nbsp;&nbsp; ID: FK(Client)

**Sells**(<ins>License</ins>, <ins>ID</ins>, <ins>Number</ins>, Comission, Date, Value)

&nbsp;&nbsp; License: FK(Car)

&nbsp;&nbsp; Number: FK(Employee)

&nbsp;&nbsp; ID: FK(Client)

#### Exercise 4

**Person**(<ins>name</ins>, birthday, city, country)

**relative**(<ins>name</ins>, <ins>relative_name</ins>, relationship)

**Author**(<ins>name</ins>)

&nbsp;&nbsp; name: FK(Person)

**Director**(<ins>name</ins>)

&nbsp;&nbsp; name: FK(Person)

**Actor**(<ins>name</ins>)

&nbsp;&nbsp; name: FK(Person)

**Studio**(<ins>company</ins>, country)

**owns**(<ins>name</ins>, <ins>company</ins>)

&nbsp;&nbsp; name: FK(Person)

&nbsp;&nbsp; company: FK(Studio)

**Book**(<ins>isbn</ins>, title, publisher, year)

**written_by**(<ins>name</ins>, <ins>isbn</ins>)

&nbsp;&nbsp; name: FK(Author)

&nbsp;&nbsp; isbn: FK(Book)

**Movie**(<ins>title</ins>, <ins>year</ins>, rating, length)

**based_on**(<ins>title</ins>, <ins>year</ins>, <ins>isbn</ins>)

&nbsp;&nbsp; title: FK(Movie)

&nbsp;&nbsp; year: FK(Movie)

&nbsp;&nbsp; isbn: FK(Book)

**participate**(<ins>title</ins>, <ins>year</ins>, <ins>name</ins>, role)

&nbsp;&nbsp; name: FK(Actor)

&nbsp;&nbsp; title: FK(Movie)

&nbsp;&nbsp; year: FK(Movie)

**hires**(<ins>title</ins>, <ins>year</ins>, <ins>name</ins>, <ins>company</ins>, salary)

&nbsp;&nbsp; name: FK(Actor)

&nbsp;&nbsp; title: FK(Movie)

&nbsp;&nbsp; year: FK(Movie)

&nbsp;&nbsp; company: FK(Studio)

**Release**(<ins>title</ins>, <ins>year</ins>, <ins>country</ins>, date)

&nbsp;&nbsp; title: FK(Movie)

&nbsp;&nbsp; year: FK(Movie)

**directed_by**(<ins>title</ins>, <ins>year</ins>, name)

&nbsp;&nbsp; title: FK(Movie)

&nbsp;&nbsp; year: FK(Movie)

&nbsp;&nbsp; name: FK(Director)

#### Notes

- For derived attributes, a separate table is created with (entity_primary_key, attribute)
- Composite attributes are extended, e.g. customer(customer_id, first_name, middle_initial,
last_name, street_number, ..., city, ...)
- Derived attributes are not converted
- Aggregation, follow the rules inside and outside

## Lab 4
### Introduction to SQL
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab04_en.pdf).
This follows the database created on [Lab1](#lab-1).

#### PART I: Some basic experiments
#### Exercise 8
Selects the product of account per depositor. Account has 7 rows, depositor has  7 rows, so you get 49 rows.   

#### Exercise 9
Alike 8, it selects the product of the tables with a condition: account_number from account must be the same as account_number from depositor.

#### Exercise 10 
Natural joinmatches automatically columns with the same name and keeps only one of them, so in this case it will join the account_numbers if they are ambiguous. So practically, we get one less column using this.

#### Exercise 12
7 x 7 x 13

#### Exercise 13
Now the customer names between depositor and customer must match, so we'll get the street and the city where they live in.

#### Exercise 14
Same as 10. We get less columns shown.

#### Exercise 15
Define which account number we want, from depositor or from account.

#### PART II: Querying the database
#### Exercise 1
```
SELECT customer_name
FROM depositor, account
WHERE account.account_number = depositor.account_number
AND balance > 500;
```
	+---------------+---------+
	| customer_name | balance |
	+---------------+---------+
	| Johnson       |  900.00 |
	| Smith         |  700.00 |
	| Jones         |  750.00 |
	| Lindsay       |  700.00 |
	+---------------+---------+

#### Exercise 2
```
SELECT customer_city
FROM loan, borrower, customer
WHERE amount > 1000 
AND amount < 2000
AND borrower.customer_name = customer.customer_name
AND loan.loan_number = borrower.loan_number;
```
	+---------------+---------------+
	| customer_name | customer_city |
	+---------------+---------------+
	| Jackson       | Brooklyn      |
	| Hayes         | Harrison      |
	| Adams         | Pittsfield     |
	+---------------+---------------+
  
#### Exercise 3
```
SELECT account_name, balance*1.01 as balance
FROM account
WHERE branch_name = "Perryridge";
```
	+----------------+----------+
	| account_number | balance  |
	+----------------+----------+
	| A-102          | 404.0000 |
	+----------------+----------+
  
#### Exercise 4
```
SELECT account.account_number, balance
FROM account, depositor, customer, borrower
WHERE loan_number = L-15
AND account.account_number = depositor.account_number
AND depositor.customer_name = customer.customer_name
AND customer.customer_name = borrower.customer_name;
```
	+----------------+---------+
	| account_number | balance |
	+----------------+---------+
	| A-102          |  400.00 |
	+----------------+---------+
  
#### Exercise 5
```
SELECT customer_name
FROM branch, branch
WHERE branch.branch_city = customer.customer_city;
```
	+---------------+
	| customer_name |
	+---------------+
	| Brooks        |
	| Curry         |
	| Jackson       |
	| Johnson       |
	| Smith         |
	+---------------+
  
#### Exercise 6
```
SELECT assets 
FROM branch, account, depositor
WHERE account.account_number = depositor.account_number
AND account.branch_name = branch.branch_name
AND customer_name = "Jones";
```
	+------------+
	| assets     |
	+------------+
	| 7100000.00 |
	+------------+
  
#### Exercise 7
```
SELECT customer_name, branch_name
FROM depositor, account
WHERE customer_name LIKE 'J%s'
AND depositor.account_number = account.account_number;
```
	+---------------+-------------+
	| customer_name | branch_name |
	+---------------+-------------+
	| Jones         | Brighton    |
	+---------------+-------------+
  
#### Exercise 8
```
SELECT customer.customer_name, customer_street, loan.loan_number, amount
FROM loan, borrower, customer
WHERE customer.customer_name = borrower.customer_name
AND loan.loan_number = borrower.loan_number
AND customer_street LIKE '____';
```
	+---------------+-----------------+-------------+---------+
	| customer_name | customer_street | loan_number | amount  |
	+---------------+-----------------+-------------+---------+
	| Hayes         | Main            | L-15        | 1500.00 |
	| Jones         | Main            | L-17        | 1000.00 |
	+---------------+-----------------+-------------+---------+
  
#### Exercise 9
```
SELECT distinct customer.customer_name
FROM loan, account, depositor, borrower
WHERE loan.branch_name = account.branch_name
AND account.account_number = depositor.account_number
AND customer.customer_name  = depositor.customer_name
AND borrower.loan_number = loan.loan_number
AND borrower.customer_name = depositor.customer_name;
```
	+---------------+
	| customer_name |
	+---------------+
	| Hayes         |
	+---------------+

#### Notes
- Use `%` for any substring, e.g. `Perry%` (everything starting with Perry)
- Use `_` for any single character, e.g. `___` (everything with only 3 letters)

## Lab 5
### SQL Queries
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab05_en.pdf).
This follows the database created on [Lab1](#lab-1).

#### Exercise 1
```
SELECT COUNT(distinct customer.customer_name)
FROM branch, loan, borrower, customer
WHERE branch.branch_name = loan.branch_name
AND loan.loan_number = borrower.loan_number
AND borrower.customer_name = customer.customer_name
AND customer.customer_city = branch.branch_city;
```
	+---------------+----------------------------------------+
	| customer_name | count(distinct customer.customer_name) |
	+---------------+----------------------------------------+
	| Jackson       |                                      1 |
	+---------------+----------------------------------------+
	
#### Exercise 2
```
SELECT customer_name, AVG(balance)
FROM account, depositor
WHERE account.account_number = depositor.account_number
GROUP BY customer_name;
```
	+---------------+----------------------+
	| customer_name | AVG(account.balance) |
	+---------------+----------------------+
	| Hayes         |           400.000000 |
	| Johnson       |           700.000000 |
	| Jones         |           750.000000 |
	| Lindsay       |           700.000000 |
	| Smith         |           700.000000 |
	| Turner        |           350.000000 |
	+---------------+----------------------+
	
#### Exercise 3
```
SELECT customer_name, AVG(balance)
FROM account, depositor, branch
WHERE account.account_number = depositor.account_number
AND branch.branch_name = account.branch_name
AND branch_city = "Horseneck"
GROUP BY customer_name;
```
	+---------------+--------------+
	| customer_name | AVG(balance) |
	+---------------+--------------+
	| Hayes         |   400.000000 |
	| Smith         |   700.000000 |
	| Turner        |   350.000000 |
	+---------------+--------------+

#### Exercise 4
```
SELECT SUM(balance)
FROM account, branch
WHERE branch.branch_name = account.branch_name
AND branch_city = "Horseneck";
```
	+-------------+----------------------+
	| branch_city | SUM(account.balance) |
	+-------------+----------------------+
	| Horseneck   |              1450.00 |
	+-------------+----------------------+

#### Exercise 5
```
SELECT branch_city, SUM(balance)
FROM branch, account
WHERE branch.branch_name = account.branch_name
GROUP BY branch_city;
```
	+-------------+----------------------+
	| branch_city | SUM(account.balance) |
	+-------------+----------------------+
	| Brooklyn    |              2150.00 |
	| Horseneck   |              1450.00 |
	| Palo Alto   |               700.00 |
	+-------------+----------------------+
	
#### Exercise 6
```
SELECT branch_name
FROM loan
GROUP BY branch_name
HAVING COUNT(loan_number) >= 2
ORDER BY branch_name;
```
	+-------------+
	| branch_name |
	+-------------+
	| Downtown    |
	| Perryridge  |
	+-------------+
	
#### Exercise 7
```
SELECT branch_name, SUM(amount)
FROM loan
GROUP BY branch_name
HAVING COUNT(loan_number) >= 2
ORDER BY branch_name;
```
	+-------------+-------------+
	| branch_name | SUM(amount) |
	+-------------+-------------+
	| Downtown    |     2500.00 |
	| Perryridge  |     2800.00 |
	+-------------+-------------+

#### Exercise 8
```
SELECT branch.branch_name, branch_city, account_number
FROM branch 
LEFT OUTER JOIN account
ON branch.branch_name = account.branch_name
WHERE account.account_number IS NULL;
```
	+-------------+-------------+
	| branch_city | branch_name |
	+-------------+-------------+
	| Bennington  | Pownal      |
	| Rye         | North Town  |
	+-------------+-------------+

#### Exercise 9
```
SELECT customer_name
FROM customer
WHERE customer_name NOT IN (SELECT customer_name
			    FROM account
			    INNER JOIN depositor
			    ON account.account_number = depositor.account_number);
```
	+---------------+
	| customer_name |
	+---------------+
	| Adams         |
	| Brooks        |
	| Curry         |
	| Glenn         |
	| Green         |
	| Jackson       |
	| Williams      |
	+---------------+
	
#### Exercise 10
```
SELECT branch.branch_name 
FROM branch 
WHERE branch_name 
NOT IN (SELECT branch.branch_name
	FROM branch
	INNER JOIN loan
	ON branch.branch_name = loan.branch_name
	UNION
	SELECT branch.branch_name
	FROM branch
	INNER JOIN account
	ON branch.branch_name = account.branch_name);

```
	+-------------+
	| branch_name |
	+-------------+
	| North Town  |
	| Pownal      |
	+-------------+

#### Exercise 11
```
SELECT branch.branch_name 
FROM branch 
WHERE branch_name 
NOT IN (SELECT branch.branch_name
	FROM branch
	INNER JOIN loan
	ON branch.branch_name = loan.branch_name
	WHERE branch.branch_name 
	IN (SELECT branch.branch_name
	    FROM branch
	    INNER JOIN account
	    ON branch.branch_name = account.branch_name));
```
	+-------------+
	| branch_name |
	+-------------+
	| Brighton    |
	| North Town  |
	| Pownal      |
	+-------------+

#### Exercise 12
```
SELECT customer_name
FROM customer
WHERE customer_city IN (SELECT distinct branch_city
			FROM branch);
```
	+---------------+
	| customer_name |
	+---------------+
	| Brooks        |
	| Curry         |
	| Jackson       |
	| Johnson       |
	| Smith         |
	+---------------+

#### Exercise 13
```
SELECT loan_number, amount
FROM loan
WHERE amount > ALL (SELECT amount
		    FROM loan);
```
	+-------------+---------+
	| loan_number | amount  |
	+-------------+---------+
	| L-23        | 2000.00 |
	+-------------+---------+


#### Exercise 14
```
SELECT customer_name, SUM(amount)
FROM loan
INNER JOIN borrower
ON borrower.loan_number = loan.loan_number
GROUP BY customer_name;
```
	+---------------+-------------+
	| customer_name | sum(amount) |
	+---------------+-------------+
	| Adams         |     1300.00 |
	| Curry         |      500.00 |
	| Hayes         |     1500.00 |
	| Jackson       |     1500.00 |
	| Jones         |     1000.00 |
	| Smith         |     2900.00 |
	| Williams      |     1000.00 |
	+---------------+-------------+

#### Exercise 15
```
SELECT customer_name
FROM loan
INNER JOIN borrower
ON borrower.loan_number = loan.loan_number
GROUP BY customer_name
HAVING SUM(amount) >= ALL(SELECT SUM(amount)
			  FROM loan
			  INNER JOIN borrower
			  ON borrower.loan_number = loan.loan_number
			  GROUP BY customer_name);
```
	+---------------+
	| customer_name |
	+---------------+
	| Smith         |
	+---------------+

#### Notes 

- `COUNT(*)` counts the number of rows (may contain nulls).
- `INNER JOIN` is the same as using the WHERE clause but more readable.
- `FULL OUTER JOIN` is not supported in MySQL 5.1, a workaround is the union of `LEFT` and `RIGHT OUTER JOIN`.
- Set operations: `UNION`, `INTERSECT`, `EXCEPT`. 
- `UNION` removes duplicates, if you want all, use `UNION ALL`.
- `INTERSECT` is not supported in MySQL 5.1, a workaround is using the `IN` operator.
- `EXCEPT` is not supported in MySQL 5.1, a workaround is using the `NOT IN` operator.
- Nesting operators: `SOME`, `ALL`, `IN`.
- `SOME` is true  if comparison holds at least once.


## Lab 6
### Advanced SQL
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab06_en.pdf).
This follows the database created on [Lab1](#lab-1).

#### Part I: Customers with accounts in every branch of Brooklyn

#### Exercise 1
```
SELECT branch.branch_name
FROM branch
WHERE branch_city = "Brooklyn";
```
	+-------------+
	| branch_name |
	+-------------+
	| Brighton    |
	| Downtown    |
	+-------------+

#### Exercise 2
```
SELECT branch.branch_name, account.account_number
FROM branch
INNER JOIN account
ON branch.branch_name = account.branch_name
WHERE branch_city = "Brooklyn";
```

	+-------------+----------------+
	| branch_name | account_number |
	+-------------+----------------+
	| Brighton    | A-201          |
	| Brighton    | A-217          |
	| Downtown    | A-101          |
	+-------------+----------------+

#### Exercise 3
```
SELECT branch.branch_name, account.account_number, depositor.customer_name
FROM branch
INNER JOIN account
ON branch.branch_name = account.branch_name
INNER JOIN depositor
ON account.account_number = depositor.account_number
WHERE branch_city = "Brooklyn";
```
	+-------------+----------------+---------------+
	| branch_name | account_number | customer_name |
	+-------------+----------------+---------------+
	| Brighton    | A-201          | Johnson       |
	| Brighton    | A-217          | Jones         |
	| Downtown    | A-101          | Johnson       |
	+-------------+----------------+---------------+

#### Exercise 4

No. A count could be done to check that, but having to show the branch name and account number doesn't 
allow that since there would have to be a `GROUP BY customer_name`. 


#### Exercise 5
```
SELECT DISTINCT customer_name
FROM depositor AS d
WHERE NOT EXISTS (SELECT branch_name
		  FROM branch AS b
		  WHERE branch_ity = "Brooklyn"
		  AND branch_name NOT IN (SELECT branch_name
		  			  FROM account AS a, depositor AS d2
					  WHERE a.account_number = d2.account_number
					  AND d2.customer_name = d.customer_name));
```
	+---------------+
	| customer_name |
	+---------------+
	| Johnson       |
	+---------------+
	
#### Exercise 6
The third select in the query returns the branches where that customer has accounts.
The second returns all the branches that are in Brooklyn and in which the client does not have accounts.
If a subquery returns any rows at all, `EXISTS` subquery is TRUE, and `NOT EXISTS` subquery is FALSE.
If the customer has branches everywhere in Brooklyn, the second query will be `NULL`, and therefore `NOT EXISTS` is TRUE.

#### Exercise 7
```
SELECT DISTINCT customer_name 
FROM depositor AS d 
WHERE NOT EXISTS (SELECT branch_name 
		  FROM branch AS b 
		  WHERE branch_city = "Brooklyn" 
		  AND NOT EXISTS (SELECT branch_name 
		  		  FROM account AS a, depositor AS d2 
				  WHERE a.account_number = d2.account_number
				  AND d2.customer_name = d.customer_name 
				  AND branch_name = b.branch_name));
```
	+---------------+
	| customer_name |
	+---------------+
	| Johnson       |
	+---------------+

The third query will select all the branches in Brooklyn where the cusstomer has accounts.
If a customer has all the branches of Brooklyn, the second query `NOT EXISTS` will be FALSE since rows are returned.
Since its FALSE, the result of the second query is NULL and the first query gets the customer who has accounts in every branch of Brooklyn.

Second query represents a table (1) with all the Brooklyn branches, third query represents a table (2) with all the branches in Brooklyn where the cusstomer has accounts. `NOT EXISTS` will look for the first instance of table (1) that doesn't exist on table (2), and return TRUE if that is the case, i.e. there are rows that exist in table (1) and not in table (2). 


#### Part II: Customers with accounts in every branch of the city where they live

#### Exercise 8

**Q: How to formulate using the double negative?**

A: The objective is to find a customer such that there is no branch from the list of branches in the city the user lives in in which he/she does not have an account.

#### Exercise 9

**Q: Change the query from 5 in order to fulfil the required task**

```
SELECT DISTINCT c.customer_name
FROM depositor AS d1, customer AS c
WHERE d1.customer_name = c.customer_name
    AND NOT EXISTS (
        SELECT branch_name FROM branch AS b
        WHERE branch_city = c.customer_city
            AND NOT EXISTS (
                SELECT branch_name FROM account AS a, depositor AS d2
                WHERE a.account_number = d2.account_number
                    AND d1.customer_name = d2.customer_name
                    AND branch_name = b.branch_name));
```
```
+---------------+
| customer_name |
+---------------+
| Hayes         |
| Jones         |
| Lindsay       |
| Turner        |
+---------------+
```

#### Exercise 10

Run the following query which checks the location of the branch in which the previous customer do have accounts.

```
SELECT c.customer_name, c.customer_city, b.branch_city
FROM customer AS c, depositor AS d, account AS a, branch AS b
WHERE c.customer_name = d.customer_name
    AND d.account_number = a.account_number
    AND a.branch_name = b.branch_name
    AND c.customer_name IN ('Hayes','Jones','Lindsay','Turner');
```
```
+---------------+---------------+-------------+
| customer_name | customer_city | branch_city |
+---------------+---------------+-------------+
| Hayes         | Harrison      | Horseneck   |
| Jones         | Harrison      | Brooklyn    |
| Lindsay       | Pittsfield     | Palo Alto   |
| Turner        | Stamford      | Horseneck   |
+---------------+---------------+-------------+
```

**Q: The cities do not match. So what's going on here?**

A: We are indeed unable to find a branch in the city where the customer live in which he/she does not have an account.
In fact we were **unable to find a branch in that city altogether!**
So, the double negative presents us with false positive results.


#### Exercise 11

**Q: Correct the previous error, by adding an extra condition to the query.**

```
SELECT DISTINCT c.customer_name
FROM depositor AS d1, customer AS c
WHERE d1.customer_name = c.customer_name
    AND EXISTS (
      SELECT branch_name FROM customer, branch
      WHERE c.customer_city = branch.branch_city)
    AND NOT EXISTS (
        SELECT branch_name FROM branch AS b
        WHERE branch_city = c.customer_city
            AND NOT EXISTS (
                SELECT branch_name FROM account AS a, depositor AS d2
                WHERE a.account_number = d2.account_number
                    AND d1.customer_name = d2.customer_name
                    AND branch_name = b.branch_name));
```

This should return an **Empty set**.

## Lab 7
### Functions, Stored Procedures and Triggers
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab07.pdf).
This follows the database created on [Lab1](#lab-1).

#### Part I: Functions

#### Exercise 1

```
DELIMITER $$
CREATE FUNCTION get_absolute_balance(name VARCHAR(255))
RETURNS INT
BEGIN
	DECLARE positive_balance INT;
	DECLARE negative_balance INT;
	SELECT SUM(balance) INTO positive_balance, 
	FROM account NATURAL JOIN depositor
	WHERE customer_name = name;
	
	SELECT SUM(amount)INTO negative_balance
	FROM loan NATURAL JOIN borrower
	WHERE customer_name = name;
	
	RETURN positive_balance - negative balance;
	
END$$
DELIMITER ;
```


#### Exercise 3

```
SELECT customer_name 
FROM customer 
WHERE absolute_balance(customer_name) >= ALL (SELECT get_absolute_balance(customer_name) 
					      FROM customer);

```
	+---------------+
	| customer_name |
	+---------------+
	| Jones         |
	+---------------+


#### Part II: Stored Procedures

#### Exercise 4

```
DELIMITER $$
CREATE PROCEDURE get_branch_customers(in b_name VARCHAR(255), out customers )
BEGIN
	DROP TABLE temp IF EXISTS;
        CREATE TABLE temp (tname varchar(255), primary key(tname));
	INSERT INTO temp (SELECT customer_name INTO 
			  FROM depositor AS d, account AS a
			  WHERE d.account_number = a.account_number
			  AND a.branch_name = b_name);
END$$
DELIMITER ;
```
#### Exercise 5
```
CALL get_branch_customers("Brighton");
SELECT * from temp;
DROP TABLE temp;
```
	+---------+
	| tname   |
	+---------+
	| Johnson |
	| Jones   |
	+---------+


#### Part III: Triggers
#### Exercise 6
```
DELIMITER $$
CREATE TRIGGER check_loan BEFORE UPDATE ON loan
FOR EACH ROW
BEGIN
	IF new.amount < 0 THEN
		INSERT INTO account VALUES (new.loan_number, new.branch_name, (-1)*new.amount);
		INSERT INTO depositor (SELECT customer_name, loan_number
				       FROM borrower AS b
			               WHERE b.loan_number = new.loan_number);
		SET new.amount = 0;
	END IF;
END$$
DELIMITER ;
```

#### Exercise 7
```
UPDATE loan SET amount=amount-1200 WHERE loan_number = 'L-17';
```
	+----------------+-------------+---------+
	| account_number | branch_name | balance |
	+----------------+-------------+---------+
	| A-101          | Downtown    |  500.00 |
	| A-102          | Perryridge  |  400.00 |
	| A-201          | Brighton    |  900.00 |
	| A-215          | Mianus      |  700.00 |
	| A-217          | Brighton    |  750.00 |
	| A-222          | Redwood     |  700.00 |
	| A-305          | Round Hill  |  350.00 |
	| L-17           | Downtown    |  200.00 |
	+----------------+-------------+---------+


#### Notes 
Function 
- Parameters: only input
- Outputs: single return value
- Returned by `RETURN`
- Changes table data
- Invoked by `SELECT` and `WHERE`

Procedure
- Parameters: in, out, inout
- Outputs: variables, tables 
- Returned by `SET`, `CALL` and `SELECT`
- Changes table data and structure
- Invoked by `CALL`

## Lab 9
### PHP and MySQL

#### Notes

- GET
	- Page reload: Harmless
	- Can be bookmarked
	- Can be cached
	- Parameters remain in history
	- Data size limited to the length of the URL
	- Restricted to ASCII
	- Less secure

- POST
	- Page reload: data will be submitted again
	- Can't be bookmarked
	- Not cached
	- Parameters are not saved in history
	- No data size restrictions
	- Binary data can be sent 
	- Safer, because parameters aren't stored in history/logs

- `$_REQUEST`, by default, contains the contents of `$_GET`, `$_POST` and `$_COOKIE`. 

- SQL Injection

	Can be done in different ways, check [W3SCHOOLS](https://www.w3schools.com/sql/sql_injection.asp).
	- username: " or ""="
	
	```
	SELECT * FROM users WHERE username ="" or ""="";
	```
	The SQL above is valid and will return all rows from the "users" table, since OR ""="" is always TRUE.
	
	- balance: 400); DROP TABLE depositor;
	```
	INSERT INTO account VALUES ('A-125, 'Perryridge', 400); DROP TABLE depositor;
	```
	
	- id: 105 OR 1=1
	```
	SELECT UserId, Name, Password FROM Users WHERE UserId = 105 or 1=1; 
	```
	
	Use prepared statements to protect against it:
	```
	$account_number = $_REQUEST['account_number'];
	$stat = $connection->prepare("SELECT balance FROM account WHERE account_number=:account_number");
	$stat->bindParam(':account_number', $account_number);
	$stat->execute();
	```


## Lab 10
### Transactions

#### Notes

Some operations have ACID (atomicity, consistency, isolation, durability) properties, for example transfering money from 
one account to another. For that explicit transactions are required. 

Transactions have different isolation levels, that can be chosen:
- serializable (same value and same number of records during transaction)
- repeatable read (same value and different number of records during transaction) - default
- read committed (different value and different number of records during transaction)
- read uncommitted (different value and different number of records during transaction) - dirty read

```
SET TRANSACTION ISOLATION LEVEL repeatable read;
START TRANSACTION;
	UPDATE account
	SET balance = balance - 50
	WHERE account_number = 'A-101';
COMMIT; // or ROLLBACK;
```

in php:

```
$connection->beginTransaction();
$connection->exec($sql);
$connection->commit();
//$connection->rollback(); if there's any error
```


## Lab 11
### Data Warehouse
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab11.pdf). The files are in `lab11/`.

#### Exercise 15
```
SELECT AVG(reading), week_day_name
FROM meter_readings AS m, date_dimension AS d
WHERE m.date_id = d.date_id
GROUP BY week_day_name
WITH ROLLUP;
```
	+---------------+---------------+
	| AVG(reading)  | week_day_name |
	+---------------+---------------+
	| 19994178.2400 | Friday        |
	| 20081069.8697 | Monday        |
	| 12352433.4305 | Saturday      |
	| 11617916.9867 | Sunday        |
	| 20587682.6651 | Thursday      |
	| 18067392.0244 | Tuesday       |
	| 19696833.8342 | Wednesday     |
	| 17415595.8691 | NULL          |
	+---------------+---------------+
	
```
SELECT AVG(reading), week_day_name
FROM meter_readings AS m, date_dimension AS d
WHERE m.date_id = d.date_id
GROUP BY week_day_name
HAVING AVG(reading) >= ALL (SELECT AVG(reading)
				FROM meter_readings AS m, date_dimension AS d
				WHERE m.date_id = d.date_id
				GROUP BY week_day_name);
```
Thursday
```
SELECT AVG(reading), week_day_name
FROM meter_readings AS m, date_dimension AS d
WHERE m.date_id = d.date_id
GROUP BY week_day_name
HAVING AVG(reading) <= ALL (SELECT AVG(reading)
				FROM meter_readings AS m, date_dimension AS d
				WHERE m.date_id = d.date_id
				GROUP BY week_day_name);
```
Sunday

#### Exercise 16
```
SELECT AVG(reading), week_number
FROM meter_readings AS m, date_dimension AS d
WHERE m.date_id = d.date_id
AND week_number > 49
GROUP BY week_number
WITH ROLLUP;
```
	+---------------+-------------+
	| AVG(reading)  | week_number |
	+---------------+-------------+
	| 19989032.7437 |          50 |
	| 18635923.1146 |          51 |
	| 12698868.3111 |          52 |
	| 17082359.0932 |        NULL |
	+---------------+-------------+

#### Exercise 17
```
SELECT AVG(reading), week_number, building_name
FROM meter_readings AS m, date_dimension AS d, building_dimension as b
WHERE m.date_id = d.date_id
AND week_number > 49
GROUP BY week_number, building_name
WITH ROLLUP;
```
	+---------------+-------------+---------------+
	| AVG(reading)  | week_number | building_name |
	+---------------+-------------+---------------+
	| 19989032.7437 |          50 | A             |
	| 19989032.7437 |          50 | B             |
	| 19989032.7437 |          50 | C             |
	| 19989032.7437 |          50 | D             |
	| 19989032.7437 |          50 | E             |
	| 19989032.7437 |          50 | F             |
	| 19989032.7437 |          50 | G             |
	| 19989032.7437 |          50 | NULL          |
	| 18635923.1146 |          51 | A             |
	| 18635923.1146 |          51 | B             |
	| 18635923.1146 |          51 | C             |
	| 18635923.1146 |          51 | D             |
	| 18635923.1146 |          51 | E             |
	| 18635923.1146 |          51 | F             |
	| 18635923.1146 |          51 | G             |
	| 18635923.1146 |          51 | NULL          |
	| 12698868.3111 |          52 | A             |
	| 12698868.3111 |          52 | B             |
	| 12698868.3111 |          52 | C             |
	| 12698868.3111 |          52 | D             |
	| 12698868.3111 |          52 | E             |
	| 12698868.3111 |          52 | F             |
	| 12698868.3111 |          52 | G             |
	| 12698868.3111 |          52 | NULL          |
	| 17082359.0932 |        NULL | NULL          |
	+---------------+-------------+---------------+

#### Exercise 18
```
SELECT AVG(reading), building_name
FROM meter_readings AS m, building_dimension as b
GROUP BY building_name
ORDER BY AVG(reading) asc;
```
	+---------------+---------------+
	| AVG(reading)  | building_name |
	+---------------+---------------+
	| 17415595.8691 | A             |
	| 17415595.8691 | B             |
	| 17415595.8691 | C             |
	| 17415595.8691 | D             |
	| 17415595.8691 | E             |
	| 17415595.8691 | F             |
	| 17415595.8691 | G             |
	+---------------+---------------+

#### Exercise 19
```
SELECT AVG(reading), building_name, day_period
FROM meter_readings AS m, building_dimension as b, time_dimension as t
GROUP BY building_name, day_period
ORDER BY building_name, AVG(reading) desc;
```

#### Exercise 20
```
SELECT AVG(reading), building_name, day_period, hour_of_day
FROM meter_readings AS m, building_dimension as b, time_dimension as t
GROUP BY building_name, day_period, hour_of_day
ORDER BY building_name, AVG(reading) desc;
```

Exercise 19 and 20 were extremely slow when executing, so they are not tested! Make an issue if you can.

#### Notes

OLAP - Online Analytical Processing

OLTP - Online Transaction Processing


## Final notes

- Queries may be optimized by using hash keys for indexing or binary trees.

<h1>You made it! Here's a meme</h1>

<a>
  <img src="https://images-cdn.9gag.com/photo/ayDKNrX_700b.jpg">
</a>









