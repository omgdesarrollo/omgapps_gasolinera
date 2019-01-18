<?php

class GanttPojo { 
    
    public   $id;
    public   $text;
    public   $start_date;
    public   $duration;
    public   $progress;
    public   $parent;
    
    function getId() {
        return $this->id;
    }

    function getText() {
        return $this->text;
    }

    function getStart_date() {
        return $this->start_date;
    }

    function getDuration() {
        return $this->duration;
    }

    function getProgress() {
        return $this->progress;
    }

    function getParent() {
        return $this->parent;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setStart_date($start_date) {
        $this->start_date = $start_date;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }

    function setProgress($progress) {
        $this->progress = $progress;
    }

    function setParent($parent) {
        $this->parent = $parent;
    }
}
