#!/bin/bash
# create table for import
# import csv
mysql -uhstats -phstats HSTATS -e "LOAD DATA  INFILE $1 INTO TABLE test FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES"
