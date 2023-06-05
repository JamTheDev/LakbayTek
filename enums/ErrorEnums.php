<?php

enum AuthenticationErrors: int
{
    case NoAccount = 0;
    case WrongPassword = 1;
    case AccountAlreadyExists = 2;
    case PasswordsNotMatching = 3;
    case NoSessionID = 4;
    case None = 5;
    case ExpiredSessionID = 6;
}

enum OperationErrors: int {
    case FailedQuery = 0;
}
