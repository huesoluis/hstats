#generador de json con dos niveles de anidamiento
#eliminar del csv las primeras líneas
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
    l3=l2.split('-n-')

    lactual=l3[0]
    
    children1=l3[1]
    
    if(nl==1): 
        lf="[{"+lactual
        lf+=",\"children1\":[{"+children1+"}"
        lant=lactual 
        continue
    if(lactual==lant):
        lf+=",{"+children1+"}"
    else:
        lf+="]},{"+lactual+",\"children1\":[{"+children1+"}"
    lant=lactual

lf=lf+"]}]"
#eliminamos dobles comillas
lf=lf.replace('""','"')

print(lf)
