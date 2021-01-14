import json
import sys
import codecs

tree=[]
nl=0
lf=''
linefinal='{'
fcsv=str(sys.argv[1])

lineas=open(fcsv,'r')
for line in lineas.readlines():
    nl+=1
    line=line.replace('\n','')
    l2=line
    
    if(nl==1): 
        lf="[{"+l2
        continue
    lf+="},{"+l2

lf=lf+"}]"
#eliminamos dobles comillas
lf=lf.replace('""','"')

print(lf)
