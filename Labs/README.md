# Labs resolutions
(This might not be completely correct)

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
### ​ Introduction​ ​ to​ ​ SQL
Check the [questions](https://github.com/Mrrvm/Database-Course/blob/master/Labs/lab_questions/lab04_en.pdf).
#### Exercise 1

