import io
import pymysql

con = pymysql.connect('192.168.88.249', 'Alex', '537931754218', 'map')
point = []
data  = []
query = 0
with open("data/in.csv", "r") as f:
    for line in f:
        data.append([float(x) for x in line.split(",")])
for i in range(len(data)):
    for j in range(0,len(data[i])-1,2):
        point.append((data[i][j+1],data[i][j],i))
query = "INSERT INTO point (id, longitude, latitude, id_way) VALUES (NULL, %s, %s, %s)"
cursor = con.cursor()
cursor.executemany(query, point)

con.commit()
con.close()