<?php
namespace mindpowered\financecalculator;

use \maglev\MagLev;
use \maglev\MagLevPhp;
use \financecalculator\FinanceCalculator as FinanceCalculator_Library;

/**
 * Copyright Mind Powered Corporation 2020
 * 
 * https://mindpowered.dev/
 */


/**
 * A library for performing various finance calculations
 */
class FinanceCalculator
{
	/**
	 * FinanceCalculator
	 */
	function __construct() {
		$bus = MagLev::getInstance('default');
		$lib = new FinanceCalculator_Library($bus);
	}

	/**
	 * Calculate present value of future money
	 * @param float $futureValue Future Value
	 * @param float $numPeriods Number of Periods
	 * @param float $interestRate Interest Rate
	 * @return object object containing Present Value and Total Interest
	 */
	public function PresentValueOfFutureMoney($futureValue, $numPeriods, $interestRate)
	{
		$phpbus = MagLevPhp::getInstance('default');
		$args = [$futureValue, $numPeriods, $interestRate];
		$ret = null;
		$phpbus->call('FinanceCalculator.PresentValueOfFutureMoney', $args, function($async_ret) use (&$ret) { $ret = $async_ret; });
		return $ret;
	}

	/**
	 * Calculate the present value of future deposits
	 * @param float $numPeriods Number of Periods
	 * @param float $interestRate Interest Rate
	 * @param float $depositAmount Periodic Deposit Amount
	 * @param bool $depositAtBeginning Periodic Deposits made at beginning of period
	 * @return object object containing Present Value, Total Principal, and Total Interest
	 */
	public function PresentValueOfDeposits($numPeriods, $interestRate, $depositAmount, $depositAtBeginning)
	{
		$phpbus = MagLevPhp::getInstance('default');
		$args = [$numPeriods, $interestRate, $depositAmount, $depositAtBeginning];
		$ret = null;
		$phpbus->call('FinanceCalculator.PresentValueOfDeposits', $args, function($async_ret) use (&$ret) { $ret = $async_ret; });
		return $ret;
	}

	/**
	 * Calculate the future value of money and/or deposits
	 * @param float $presentValue Present Value
	 * @param float $numPeriods Number of Periods
	 * @param float $interestRate Interest rate as a percentage
	 * @param float $timesCompoundedPerPeriod Times interest is compounded per period
	 * @param float $depositAmount Periodic Deposit Amount
	 * @param bool $depositAtBeginning Periodic Deposits made at beginning of period
	 * @return object object containing Future Value and Total Interest
	 */
	public function FutureValue($presentValue, $numPeriods, $interestRate, $timesCompoundedPerPeriod, $depositAmount, $depositAtBeginning)
	{
		$phpbus = MagLevPhp::getInstance('default');
		$args = [$presentValue, $numPeriods, $interestRate, $timesCompoundedPerPeriod, $depositAmount, $depositAtBeginning];
		$ret = null;
		$phpbus->call('FinanceCalculator.FutureValue', $args, function($async_ret) use (&$ret) { $ret = $async_ret; });
		return $ret;
	}

	/**
	 * Calculate net present value
	 * @param float $initialInvestment Initial Investment
	 * @param float $discountRate Discount Rate (eg. Interest Rate)
	 * @param float $timesCompoundedPerPeriod Times discount/interest is compounded per period
	 * @param float $cashFlowsAtBeginning 
	 * @param array $cashFlow List of cash flows per period
	 * @return float Net Present Value
	 */
	public function NetPresentValue($initialInvestment, $discountRate, $timesCompoundedPerPeriod, $cashFlowsAtBeginning, $cashFlow)
	{
		$phpbus = MagLevPhp::getInstance('default');
		$args = [$initialInvestment, $discountRate, $timesCompoundedPerPeriod, $cashFlowsAtBeginning, $cashFlow];
		$ret = null;
		$phpbus->call('FinanceCalculator.NetPresentValue', $args, function($async_ret) use (&$ret) { $ret = $async_ret; });
		return $ret;
	}

}
