## Synopsis

Hello! Welcome to the repository for Project 4. The goal of this project was to effectively migrate Project 2 to the Zend Framework. All functionality remains consistent with the previous.

## Installation

Please reference the zend framework library through a symbolic link:

```ln -s /path/to/zendframework/library/Zend```

## Use

You may access the API at /api/...
1. ```/api/people``` will return all people in the database.
2. ```/api/visits``` will return all visits in the database.
3. ```/api/.../$id``` will return all the people/visits for the person associated with ```$id```.

##Resources

[Zend](www.framework.zend.com)
