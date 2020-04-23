#!/usr/bin/env python
# -*- coding: latin-1 -*-
#generador de json con dos niveles de anidamiento
#eliminar del csv las primeras líneas
import json
import sys
import codecs

tree=[]
nl=0
lf=''
linefinal='{'
#fcsv=str(sys.argv[1])
dir='/datos/websfp/desarrollo/hstats/scripts/php/'

fcsv='p.csv';

lineas=open(fcsv,'r')
for line in lineas.readlines():
    nl+=1
    line=line.replace('\n','')
    l2=line

#    lactual=l3[0]
    
 #   children1=l3[1]
    
    if(nl==1): 
        lf="[{"+l2
        continue
    lf+="},{"+l2

lf=lf+"}]"
#eliminamos dobles comillas
lf=lf.replace('""','"')

print(lf)
