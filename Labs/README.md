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




