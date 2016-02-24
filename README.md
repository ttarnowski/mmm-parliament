# Botsphere Parliament Test

## Test description

A new parliament is elected in the state of MMM. Each member gets his unique positive integer identification number during the registration. The numbers were handed out in a random order; there could also be gaps in the sequence of numbers.

The chairs were arranged in a tree-like structure. When members entered the auditorium they took seats in the following order. The first took the chairman’s seat. Each of the following members headed left if his number was lower than the chairman’s, or right, otherwise. Then he took the empty seat and declared himself as wing chairman. If the seat of the wing chairman has been filled then the algorithm continued in the same way: the member went left or right depending on the wing chairman’s number.

Below is an example of the seating of the delegates if if they arrived in this order:

10
5
1
7
20
25
22
21
27

During its first session the members decided not to change seats. They also adopted a speech order. If the number of the session was odd then they spoke in the following order: the left wing, the right wing and the chairman. 

If a wing had more than one parliamentarian then their speech order was the same: the left wing, the right wing, and the wing chairman. If the number of the session was even, the speech order was different: the right wing, the left wing, and the chairman. For a given example the speech order for odd sessions will be 1, 7, 5, 21, 22, 27, 25, 20, 10; while for even sessions — 27, 21, 22, 25, 20, 7, 1, 5, 10.

Determine the speech order for an even session if the speech order for an odd session is given.

####Input

The first line of the input contains N, the total number of parliamentarians. The following lines contain N integer numbers, the identification numbers of the members of parliament according to the speech order for an odd session.

The total number of the members of parliament does not exceed 3000. Identification numbers do not exceed 65535.

####Output

The output should contain the identification numbers of the members of parliament in accordance with the speech order for an even session.
Sample

input
9
1
7
5
21
22
27
25
20
10

output
27
21
22
25
20
7
1
5
10

## Solution

A Web application with html form that trasforms input (odd session speech order) to output (even session speech order).

## Installation

1. Clone [Git repository](https://github.com/ttarnowski/mmm-parliament)
2. `cd` into project root directory
3. Run `composer install`

## Packages

##### Dev Dependencies:

1. [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit)

## Tests

Run the following commands from the project tests directory to:

1. Execute tests: `./run_tests.sh`

## Prerequisites

1. You have a version of PHP >= [5.5.9](http://php.net/releases/5_5_9.php)
2. You have installed [Composer](https://getcomposer.org/)
