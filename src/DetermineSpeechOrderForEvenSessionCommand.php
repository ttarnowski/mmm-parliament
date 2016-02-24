<?php

namespace Botsphere;

class DetermineSpeechOrderForEvenSessionCommand
{
    const MAX_NUMBER_OF_MEMBERS = 3000;
    const MAX_MEMBER_ID_VALUE = 65535;

    /**
     * @var WingFactory
     */
    private $wingFactory;

    public function __construct()
    {
        $this->wingFactory = new WingFactory();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function execute()
    {
        $args = func_get_args();

        if (count($args) > self::MAX_NUMBER_OF_MEMBERS) {
            throw new \Exception('Maximum number of parliament members is 3000!');
        }

        $members = $this->getMembers($args);

        $wing = $this->wingFactory->createFromOddSessionSpeechOrder($members);

        return $wing->getEvenSessionSpeechOrder();
    }

    /**
     * @param array|null $commandArguments
     * @return array
     */
    private function getMembers($commandArguments)
    {
        foreach ($commandArguments as $key => $arg) {
            if ($key != 0) {
                $members[] = $arg;

                $this->validateMemberValue($arg);
            }
        }

        return $members;
    }

    /**
     * @param int $member
     * @throws \Exception
     */
    private function validateMemberValue($member)
    {
        if ($member > self::MAX_MEMBER_ID_VALUE) {
            throw new \Exception(sprintf('Parliament member id \'%s\' exceed 65535 value!', $member));
        }

        if (!is_numeric($member) || $member < 0) {
            throw new \Exception(sprintf('Parliament member id \'%s\' is not a positive integer value!', $member));
        }
    }
}