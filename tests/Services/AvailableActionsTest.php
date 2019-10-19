<?php

namespace Tests\Services;

use App\Services\AvailableActions;

class AvailableActionsTest
{
    private $availableActionObj;

    private $expectActionList =
        [   'create',
            'cancel',
            'take',
            'refuse',
            'finish',
            'send message'
        ];

    private $expectStatusList =
        [   'new',
            'cancel',
            'in progress',
            'failed',
            'done'
        ];

    private $actualStatus;

    private function setUp($author_id, $finish_date, $real_status, $worker_id)
    {
        $this->actualStatus = $real_status;
        $this->availableActionObj = new AvailableActions($author_id, $finish_date, $real_status, $worker_id);
    }

    public function testGetActionList($expectActionList)
    {
        assert($expectActionList == $this->availableActionObj->getActionList(), 'failed ActionList');
    }

    public function testGetStatusList($expectStatusList)
    {
        assert($expectStatusList == $this->availableActionObj->getStatusList(), 'failed StatusList' );
    }

    public function testGetNextStatus()
    {
        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_CREATE);
        assert(AvailableActions::STATUS_NEW == $resultNextStatus, 'create action');

        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_CANCEL);
        assert(AvailableActions::STATUS_CANCEL == $resultNextStatus, 'cancel action');

        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_TAKE);
        assert(AvailableActions::STATUS_IN_PROGRESS == $resultNextStatus, 'take action');

        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_REFUSE);
        assert(AvailableActions::STATUS_FAILED == $resultNextStatus, 'refuse action');

        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_FINISH);
        assert(AvailableActions::STATUS_DONE == $resultNextStatus, 'cancel action');

        $resultNextStatus = $this->availableActionObj->getNextStatus(AvailableActions::ACTION_SEND_MESSAGE);
        assert($this->actualStatus == $resultNextStatus, 'send message action');
    }

    public function runTests()
    {
        $this->setUp(1, 56, 'done', 5);

        $this->testGetActionList($this->expectActionList);
        $this->testGetStatusList($this->expectStatusList);
        $this->testGetNextStatus();
    }
}

