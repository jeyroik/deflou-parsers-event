<?php
namespace tests\parsers;

use deflou\components\applications\activities\Activity;
use deflou\components\parsers\ParserDeflouEventParameters;
use extas\components\conditions\ConditionRepository;
use extas\components\conditions\TSnuffConditions;
use extas\components\parsers\Parser;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use PHPUnit\Framework\TestCase;

/**
 * Class DeflouEventParametersTest
 *
 * @package tests\parsers
 * @author jeyroik <jeyroik@gmail.com>
 */
class DeflouEventParametersTest extends TestCase
{
    use THasMagicClass;
    use TSnuffRepositoryDynamic;
    use TSnuffConditions;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->createSnuffDynamicRepositories([
            ['parserRepository', 'name', Parser::class]
        ]);

        $this->registerSnuffRepos([
            'conditionRepository' => ConditionRepository::class
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testParsing()
    {
        $parser = new Parser([
            Parser::FIELD__CLASS => ParserDeflouEventParameters::class,
            Parser::FIELD__VALUE => '/\$"(.*?)"/',
            Parser::FIELD__CONDITION => '#',
            Parser::FIELD__PARAMETERS => [
                'event' => new Activity([
                    Activity::FIELD__PARAMETERS => [
                        'test_current_status' => [
                            'title' => 'Текущий статус теста',
                            'name' => 'test_current_status',
                            'value' => 'is ok'
                        ]
                    ]
                ])
            ]
        ]);

        $this->createSnuffCondition('regex');

        $value = 'Текущий статус теста: $"Текущий статус теста".';
        $this->assertTrue($parser->canParse($value), 'Can not parse string: ' . $value);
        $this->assertEquals('Статус теста: is ok', $parser->parse($value));
    }
}
