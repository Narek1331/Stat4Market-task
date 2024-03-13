<?php
class Dec{
    private $deque;
    private $front;
    private $rear;
    private $size;
    private $capacity;

    public function __construct($capacity) {
        $this->capacity = $capacity;
        $this->deque = array_fill(0, $capacity, null);
        $this->front = 0;
        $this->rear = 0;
        $this->size = 0;
    }

    public function pushBack($value) {
        if ($this->isFull()) {
            return false;
        }
        $this->deque[$this->rear] = $value;
        $this->rear = ($this->rear + 1) % $this->capacity;
        $this->size++;
        return true;
    }

    public function pushFront($value) {
        if ($this->isFull()) {
            return false;
        }
        $this->front = ($this->front - 1 + $this->capacity) % $this->capacity;
        $this->deque[$this->front] = $value;
        $this->size++;
        return true;
    }

    public function popBack() {
        if ($this->isEmpty()) {
            return false;
        }
        $this->rear = ($this->rear - 1 + $this->capacity) % $this->capacity;
        $value = $this->deque[$this->rear];
        $this->deque[$this->rear] = null;
        $this->size--;
        return $value;
    }

    public function popFront() {
        if ($this->isEmpty()) {
            return false;
        }
        $value = $this->deque[$this->front];
        $this->deque[$this->front] = null;
        $this->front = ($this->front + 1) % $this->capacity;
        $this->size--;
        return $value;
    }

    private function isFull() {
        return $this->size == $this->capacity;
    }

    private function isEmpty() {
        return $this->size == 0;
    }
}

// Пример использования класса
$deque = new Dec(5);
$deque->pushBack(1);
$deque->pushFront(2);
$deque->pushBack(3);
$deque->pushFront(4);
echo $deque->popBack(); // Выведет 3
echo $deque->popFront(); // Выведет 4
