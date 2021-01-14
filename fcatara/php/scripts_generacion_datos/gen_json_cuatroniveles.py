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
    #json.stringify(l3[0],null,'\t')

    lactual=l3[0]
    
    children1=l3[1]
    children2=l3[2]
    children3=l3[3]
    
    if(nl==1): 
        lf="[{"+lactual
        lf+=",\"children1\":[{"+children1
        lant=lactual
        lantchildren1=children1
        lantchildren2=children2
        lf+=",\"children2\":[{"+children2
        lf+=",\"children3\":[{"+children3+"}"
        ft=0
        continue
    if(lactual==lant):
        if(children1==lantchildren1):
            if(children2==lantchildren2):
                lf+=",{"+children3+"}"
            else:
                lf+="]},{"+children2
                lf+=",\"children3\":[{"+children3+"}"
        else:
            lf+="]}]},{"+children1
            lf+=",\"children2\":[{"+children2
            lf+=",\"children3\":[{"+children3+"}"
            #{"+children1+",\"children\":[{"+children2+"}"
    else:
        lf+="]}]}]},{"+lactual+",\"children1\":[{"+children1
        lf+=",\"children2\":[{"+children2
        lf+=",\"children3\":[{"+children3+"}"
        ft=0
    lant=lactual
    lantchildren1=children1
    lantchildren2=children2

lf=lf+"]}]}]}]"
#eliminamos dobles comillas
#lf=lf.replace('""','"')

print(lf)

#pjson=json.loads('{"in1":"2","in2":"2"}')

#print(tree[0]['children']['nombre'])
