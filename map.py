import pymysql
import io
#INSERT INTO `point` (`id`, `longitude`, `latitude`, `bla`) VALUES (NULL, '44.680672', '43.021845', '1');
con = pymysql.connect('192.168.88.249', 'Alex', '537931754218', 'map')

point = []
data  = []
query = 0
with open("data/in.csv", "r") as f:
    for line in f:
        data.append([float(x) for x in line.split(",")])

for i in range(len(data)):
    for j in range(len(data[i])-1):
        point.append((data[i][j+1],data[i][j],i))
        print(data[i][j], end=' ')
        query = "INSERT INTO point (id, longitude, latitude, id_way) VALUES (NULL, %(lon)f, %(lat)f, %(way)i)"

with con:
    cur = con.cursor()
    cur.execute(query)
    print("запись в базу")
    con.commit()
    
 
    version = cur.fetchone()
    
    print("Database version: {}".format(version[0]))

#закрываем базу и файл 
f.close()
con.close()
print(data[1][0])