#!/bin/bash
# create table for import
head -1 $1 | awk '{split($0,f,","); printf "create table HSTATS.test (\
%s VARCHAR(200),\
%s VARCHAR(200),\
%s VARCHAR(200),\
%s INT,\
%s INT,\
%s VARCHAR(200),\
%s VARCHAR(200),\
%s VARCHAR(200),\
%s INT,\
%s VARCHAR(200),\
%s VARCHAR(200),\
%s VARCHAR(200)\
);"\
,f[1]\
,f[2]\
,f[3]\
,f[4]\
,f[5]\
,f[6]\
,f[7]\
,f[8]\
,f[9]\
,f[10]\
,f[11]\
,f[12]\
}' | mysql -uroot -pSuricato1.fp HSTATS
# import csv
mysql -uhstats -phstats HSTATS -e "LOAD DATA LOCAL INFILE $1 INTO TABLE test FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES"
