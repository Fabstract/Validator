<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\EmailValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\EmailValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\EmailValidation::isValid()
 * @see \Fabstract\Component\Validator\Validation\EmailValidation::isValidated()
 */
class IsValidMethodTest extends MethodTestBase
{
    #region [correct arguments]

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(EmailValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartStartWithAlphaNumericLowerCharacterReturnsTrue()
    {
        $arguments = ['example@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartStartWithAlphaNumericUpperCharacterReturnsTrue()
    {
        $arguments = ['Example@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartStartWithAlphaNumericNumberReturnsTrue()
    {
        $arguments = ['123example@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeNumberReturnsTrue()
    {
        $arguments = ['ex123ample@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeUnderscoreReturnsTrue()
    {
        $arguments = ['e_xample@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeMinusReturnsTrue()
    {
        $arguments = ['e-xample@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeDotReturnsTrue()
    {
        $arguments = ['exa.mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeSingleQuoteReturnsTrue()
    {
        $arguments = ['e\'xample@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludeAmpersandReturnsTrue()
    {
        $arguments = ['exa&mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLocalPartIncludePlusReturnsTrue()
    {
        $arguments = ['exa+mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testDomainPartStartWithUppercaseCharacterReturnsTrue()
    {
        $arguments = ['example@Example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testDomainPartCompletelyUppercaseCharactersReturnsTrue()
    {
        $arguments = ['example@EXAMPLE.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testDomainPartIncludeMinusMarkReturnsTrue()
    {
        $arguments = ['example@exa-mple.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testEmailAddressAllowCountrySuffixReturnsTrue()
    {
        $arguments = ['example@example.com.uk'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLastPartTwoLengthReturnsTrue()
    {
        $arguments = ['example@example.co'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion


    #region [incorrect arguments]

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(EmailValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeSpaceReturnsFalse()
    {
        $arguments = ['exa mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeExclamationReturnsFalse()
    {
        $arguments = ['exa!mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeDoubleQuotesReturnsFalse()
    {
        $arguments = ['exa""mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludePoundReturnsFalse()
    {
        $arguments = ['exa#mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeDollarReturnsFalse()
    {
        $arguments = ['exa$mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludePercentReturnsFalse()
    {
        $arguments = ['exa%mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeOpeningParenthesisReturnsFalse()
    {
        $arguments = ['exa(mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeClosingParenthesisReturnsFalse()
    {
        $arguments = ['exa)mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeCommaReturnsFalse()
    {
        $arguments = ['exa,mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeColonReturnsFalse()
    {
        $arguments = ['exa:mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeSemiColonReturnsFalse()
    {
        $arguments = ['exa;mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeLessThanReturnsFalse()
    {
        $arguments = ['exa<mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeGreaterThanReturnsFalse()
    {
        $arguments = ['exa>mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeQuestionMarkReturnsFalse()
    {
        $arguments = ['exa?mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeAtMarkReturnsFalse()
    {
        $arguments = ['exa@mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeBackslashReturnsFalse()
    {
        $arguments = ['exa\mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeOpeningBracketReturnsFalse()
    {
        $arguments = ['exa[mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludeClosingBracketReturnsFalse()
    {
        $arguments = ['exa]mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartIncludePipeReturnsFalse()
    {
        $arguments = ['exa|mple@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartDoubleDotReturnsFalseReturnsFalse()
    {
        $arguments = ['e..xample@example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLocalPartWithoutAtMarkReturnsFalse()
    {
        $arguments = ['example.example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartStartWithUnderscoreReturnsFalse()
    {
        $arguments = ['example@_example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartStartWithNonAlphaNumericCharacterReturnsFalse()
    {
        $arguments = ['example@-example.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartEndWithUnderscoreReturnsFalse()
    {
        $arguments = ['example@example_.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartEndWithNonAlphaNumericCharacterReturnsFalse()
    {
        $arguments = ['example@example-.com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartDoesNotIncludeDotReturnsFalse()
    {
        $arguments = ['example@examplecom'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testDomainPartIncludesMoreThanOneDotReturnsFalse()
    {
        $arguments = ['example@example..com'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testEmailAddressStartWithSpaceReturnsFalse()
    {
        $arguments = [' example@example.com.uk'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLastPartMoreThanTwoLengthReturnsFalse()
    {
        $arguments = ['example@example.com.abc'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLastPartWithNonWordCharacterReturnsFalse()
    {
        $arguments = ['example@example.co^m'];

        $return = $this->call(new EmailValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}
