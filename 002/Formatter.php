<?php

require_once(dirname(__FILE__).'/IMoneyFormatter.php');

class Formatter implements IMoneyFormatter {
	private $decimals;
	private $dec_point;
	private $thousands_sep;

    public function __construct(int $decimals, string $dec_point, string $thousands_sep)
    {
        $this->decimals = $decimals;
        $this->dec_point = $dec_point;
        $this->thousands_sep = $thousands_sep;
    }


	public function format(Money $obj) : string {
		return number_format($obj->getMoney(), $this->decimals, $this->dec_point, $this->thousands_sep);
	}
}
