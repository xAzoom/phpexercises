<?php

class Money {
	private $value;
	private $currency;

    public function __construct(string $name, float $val)
    {
        $this->currency = $name;
        $this->value = $val;
    }

	public function getMoney() : float {
		return $this->value;
	}

	public function getCurrency() : string {
		return $this->currency;
	}

	private function sameCurrency(Money $object) : bool {
		if ($this->getCurrency() === $object->getCurrency()) {
			return true;
		}
		return false;
	}

	public function add(Money $object) : void {
		if($this->sameCurrency($object)) {
			$this->value += $object->value;
		} else {
			throw new Exception("Bad currency");
		}
	}

	public function sub(Money $object) : void {
		if($this->sameCurrency($object)) {
			$this->value -= $object->value;
		} else {
			throw new Exception("Bad currency");
		}
	}

	public function mult(float $val) : void {
		$this->value *= $val;
	}

	public function dev(float $val) : void {
		if($val != 0) {
			$this->value /= $val;
		} else {
			throw new Exception("Division by 0");
		}
	}
}

//$formatter = new Formatter(2, ".", " ");

// $obj = new Money("PLN", 1000);
// $obj2 = new Money("PLN", 20);
// $obj->add($obj2);
// echo $formatter->format($obj);
// echo PHP_EOL;
// echo $obj->getMoney();