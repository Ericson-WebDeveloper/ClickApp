<?php

declare(strict_types=1);

namespace App\Interface;

interface ClickInterface {

    public function index($date);

    public function storeOrupdate($date);
}