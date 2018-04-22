<?php
interface IMoneyFormatter {
	public function format(Money $obj) : string;
}