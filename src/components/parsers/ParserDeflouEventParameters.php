<?php
namespace deflou\components\parsers;

use deflou\interfaces\applications\activities\IActivity;
use extas\components\Item;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasValue;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserDeflouEventParameters
 *
 * @package deflou\components\parsers
 * @author jeyroik <jeyroik@gmail.com>
 */
class ParserDeflouEventParameters extends Item implements IParseDispatcher
{
    /**
     * @param mixed $value
     * @return mixed|string
     */
    public function __invoke($value)
    {
        if (isset($this['event'])) {
            /**
             * @var IActivity $event
             */
            $event = $this['event'];
            preg_match_all('/\$"(.*?)"/', $value, $matches);
            $parameters = $event->getParameters();
            $byTitle = array_column(
                $parameters,
                IHasValue::FIELD__VALUE,
                IHasDescription::FIELD__TITLE
            );

            if (!empty($matches[1])) {
                return $this->replaceMatches($matches[1], $value, $byTitle);
            }
        }

        return $value;
    }

    /**
     * @param array $matches
     * @param string $value
     * @param array $byTitle
     * @return string
     */
    protected function replaceMatches(array $matches, string $value, array $byTitle): string
    {
        foreach ($matches as $paramTitle) {
            if (isset($byTitle[$paramTitle])) {
                $value = str_replace('$"' . $paramTitle . '"', $byTitle[$paramTitle], $value);
            }
        }

        return $value;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'deflou.parser.event.parameters';
    }
}
