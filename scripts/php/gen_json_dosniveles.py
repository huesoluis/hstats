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
#fcsv="datos_listados/out1.csv"
fcsv=str(sys.argv[1])
dir='/datos/websfp/desarrollo/hstats/scripts/php/'
#fcsv="datos_listados/f_centros_ciclos.pru"
#fcsv1=dir+fcsv
fcsv=dir+fcsv
#fcsv='datos_listados/f_centros_ciclos.txt'

lineas=open(fcsv,'r')

for line in lineas.readlines():
    nl+=1
    line=line.replace('\n','')
    l2=line
    l3=l2.split('-n-')
    #json.stringify(l3[0],null,'\t')

    lactual=l3[0]
    
    children1=l3[1]
    
    if(nl==1): 
        lf="[{"+lactual
        lf+=",\"children\":[{"+children1+"}"
        lant=lactual 
        continue
    if(lactual==lant):
        lf+=",{"+children1+"}"
    else:
        lf+="]},{"+lactual+",\"children\":[{"+children1+"}"
    lant=lactual

lf=lf+"]}]"
#eliminamos dobles comillas
lf=lf.replace('""','"')

print(lf)
#pjson=json.loads('{"in1":"2","in2":"2"}')

#print(tree[0]['children']['nombre'])