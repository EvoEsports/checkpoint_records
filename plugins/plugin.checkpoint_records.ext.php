<?php

class RecordsCheckpoint extends Checkpoint
{
    private $id;
    private $time;
    private $player;

    public function __construct($id = null, $time = null, $player = null)
    {
        parent::__construct();

        if ($id) $this->id = $id;
        if ($time) $this->time = $time;
        if ($player) $this->player = $player;
    }

    public function isBetter($time)
    {
        return $this->time > $time;
    }

    public function setNewBest($time, $player = null)
    {
        $this->time = $time;
        if ($player) {
            $this->player = $player;
        }
    }

    public function getTime()
    {
        return $this->time;
    }

    /**
     * Returns formatted time
     * @return string
     */
    public function getTimeFormatted()
    {
        $minutes = 0;
        $seconds = floor($this->time / 1000);
        $ms = $this->time % 1000;

        if ($seconds >= 60) {
            $minutes = $seconds / 60;
            $seconds = $seconds % 60;
        }

        return sprintf('%d:%02d.%03d', $minutes, $seconds, $ms);
    }

    public function getTimeNotNull()
    {
        $time = $this->getTimeFormatted();

        if (preg_match('/^([0:.]+)/', $time, $matches)) {
            return str_replace($matches[1], '', $time);
        }

        return $time;
    }

    public function getPlayerNick()
    {
        return $this->player->nickname;
    }

    /**
     * Gets checkpoint ID
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }
}