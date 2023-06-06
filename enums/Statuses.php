<?php

enum PaymentStatus: int {
    case PAID = 0;
    case UNPAID = 1;
}

enum ReservationStatus: int {
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = 2;
}