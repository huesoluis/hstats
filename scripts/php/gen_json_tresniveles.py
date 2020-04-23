import json
import sys

tree=[]
nl=0
lf=''
ft=1
linefinal='{'

fcsv=str(sys.argv[1])
dir='/datos/websfp/desarrollo/hstats/scripts/php/'

#hijo=0
for line in open(fcsv,'r').readlines():
#for line in open('prueba1.csv','r').readlines():
    nl+=1
    #if(nl<=6): continue 
    line=line.replace('\n','')
    l2=line
    l3=l2.split('-n-')
    #json.stringify(l3[0],null,'\t')

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
            #{"+children1+",\"children\":[{"+children2+"}"
    else:
        lf+="]}]},{"+lactual+",\"children1\":[{"+children1
        lf+=",\"children2\":[{"+children2+"}"
        ft=0
    lant=lactual
    lantchildren1=children1

lf=lf+"]}]}]"
#eliminamos dobles comillas
#lf=lf.replace('""','"')

print(lf)

#pjson=json.loads('{"in1":"2","in2":"2"}')

#print(tree[0]['children']['nombre'])
