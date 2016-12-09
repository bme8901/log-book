## Synopsis

Hello! This project effectively migrates Project 2 to the Zend Framework.

## Installation

Please reference the zend framework library through a symbolic link:

```ln -s /path/to/zendframework/library/Zend```

## Use

Access the API at /api/...
1. ```/api/people``` will return all people in the database.
2. ```/api/visits``` will return all visits in the database.
3. ```/api/.../$id``` will return all the people/visits for the person associated with $id.

##Resources

[Zend](www.framework.zend.com)
