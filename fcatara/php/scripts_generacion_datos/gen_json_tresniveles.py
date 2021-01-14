import json
import sys
import codecs

tree=[]
nl=0
lf=''
ft=1
linefinal='{'
fcsv=str(sys.argv[1])

for line in open(fcsv,'r').readlines():
    nl+=1
    line=line.replace('\n','')
    l2=line
    l3=l2.split('-n-')

    lactual=l3[0]
    
    children1=l3[1]
    children2=l3[2]
    
    if(nl==1): 
        lf="[{"+lactual
        lf+=",\"children1\":[{"+children1
        lant=lactual
        lantchildren1=children1
        lf+=",\"children2\":[{"+children2+"}"
        ft=0
        continue
    if(lactual==lant):
        #lf+=",{"+children1
        #hijo=1
        if(children1==lantchildren1):
            lf+=",{"+children2+"}"
        else:
            lf+="]},{"+children1
            lf+=",\"children2\":[{"+children2+"}"
    else:
        lf+="]}]},{"+lactual+",\"children1\":[{"+children1
        lf+=",\"children2\":[{"+children2+"}"
        ft=0
    lant=lactual
    lantchildren1=children1
lf=lf+"]}]}]"
print(lf)

