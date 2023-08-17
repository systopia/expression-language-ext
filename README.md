# Systopia Symfony ExpressionLanguage Extension

This is an extension for
[Symfony's ExpressionLanguage component](https://symfony.com/doc/current/components/expression_language.html).
It provides the function
[map](./src/FunctionProvider/MapExpressionFunctionProvider.php) as well as
different [PHP functions](./src/FunctionProvider/PhpFunctionsFunctionProvider.php).
For simplified use all those functions are available in the class
[SystopiaExpressionLanguage](./src/SystopiaExpressionLanguage.php).

## `date_create` Function

The `date_create` function creates an object of type `\DateTimeImmutable` by
using the default constructor.

Example:

```php
$expressionLanguage = new SystopiaExpressionLanguage();
$dateTime = $expressionLanguage->evaluate('date_create("2000-01-02 03:04:05")');
```

## `map` Function

The function `map` allows to apply an expression to the values of an array
(actually any iterable). Each pair of key and value are provided as variables
named `key` and `value` to the expression.

Example:

```php
$array = [
    'x' => (object) ['a' => 1, 'b' => 2],
    'y' => (object) ['a' => 3, 'b' => 4],
];

$expressionLanguage = new SystopiaExpressionLanguage();
$mapped = $expressionLanguage->evaluate(
    'map(array, "key ~ \": \" ~ (value.a + value.b)")',
     ['array' => $array]
);

var_dump($mapped);
```

Output:

```
array(2) {
  [0]=>
  string(4) "x: 3"
  [1]=>
  string(4) "y: 7"
}
```
