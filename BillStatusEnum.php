<?php

/**
 * Статусы счета
 */
enum BillStatusEnum: string
{
    case New = 'new';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
}
