# money
A simple Money Class for PHP

## Getting Started

Install via composer:

```bash
composer require byueksel/money
```

## Usage

### Instantiation

```php
$money = new Money();
var_dump($money->getAmount());

$total = new Money(1465.45, 'EUR', 100);
var_dump($total->getAmount());
```

### Add
```php
$money = new Money();
$money->add(new Money(14670.40));
var_dump($money->getAmount());
```

### Subtract
```php
$money = new Money(14670.40);
$money->subtract(new Money(670.20));
var_dump($money->getAmount());
```

### Multiply
```php
$money = new Money(14670.40);
$money->multiply(1.19);
var_dump($money->getAmount());
```

### Divide
```php
$money = new Money(14670.40);
$money->divide(2);
var_dump($money->getAmount());
```

### Format
```php
$money = new Money(14670.40);
var_dump($money->getFormatedAmount(2, '.', ','));
```
