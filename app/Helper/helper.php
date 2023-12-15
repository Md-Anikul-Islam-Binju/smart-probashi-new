<?php

function utcDate($data): string
{
    return date('Y-m-d', strtotime($data));
}
