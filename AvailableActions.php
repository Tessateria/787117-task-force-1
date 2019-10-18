<?php


class AvailableActions
{
    const ACTION_CREATE = 'create';
    const ACTION_CANCEL = 'cancel';
    const ACTION_TAKE = 'take';
    const ACTION_REFUSE = 'refuse';
    const ACTION_FINISH = 'finish';
    const ACTION_SEND_MESSAGE = 'send message';

    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FAILED = 'failed';
    const STATUS_IN_PROGRESS = 'in progress';
    const STATUS_DONE = 'done';

    const ROLE_AUTHOR = 'author';
    const ROLE_USER = 'user';
    const ROLE_WORKER = 'worker';

    private $author_id;
    private $worker_id;
    private $finish_date;
    private $real_status;

    private $statusList = [
        self::STATUS_NEW,
        self::STATUS_CANCEL,
        self::STATUS_IN_PROGRESS,
        self::STATUS_FAILED,
        self::STATUS_DONE
    ];

    private $actionList = [
        self::ACTION_CREATE,
        self::ACTION_CANCEL,
        self::ACTION_TAKE,
        self::ACTION_REFUSE,
        self::ACTION_FINISH,
        self::ACTION_SEND_MESSAGE
    ];

    public function __construct($author_id, $finish_date, $real_status = 'new', $worker_id = null)
    {
        $this->author_id = $author_id;
        $this->finish_date = $finish_date;
        $this->real_status = $real_status;
        $this->worker_id = $worker_id;
    }

    public function getStatusList()
    {
        return $this->statusList;
    }

    public function getActionList()
    {
       return $this->actionList;
    }

    public function getNextStatus($action)
    {
        $relations = [
            self::ACTION_CREATE => self::STATUS_NEW,
            self::ACTION_CANCEL => self::STATUS_CANCEL,
            self::ACTION_TAKE => self::STATUS_IN_PROGRESS,
            self::ACTION_REFUSE => self::STATUS_FAILED,
            self::ACTION_FINISH => self::STATUS_DONE,
            self::ACTION_SEND_MESSAGE => $this->real_status
        ];

        return array_key_exists($action, $relations) ? $relations[$action] : null;
    }
}
