import io
import pymysql
from math import radians, cos, sin, asin, sqrt

def haversine(lat1, lon1, lat2, lon2):
    lon1, lat1, lon2, lat2 = map(radians, (lon1, lat1, lon2, lat2))
    dlon = lon2 - lon1
    dlat = lat2 - lat1
    a = sin(dlat/2)**2 + cos(lat1) * cos(lat2) * sin(dlon/2)**2
    c = 2 * asin(sqrt(a))
    m = 6367000*c
    return m

con = pymysql.connect('192.168.88.249', 'Alex', '537931754218', 'map')
cursor = con.cursor()
for ways in range(2964):                  
    query = "SELECT * FROM point WHERE id_way = %s" %ways
    cursor.execute(query)
    records = cursor.fetchall()
    x=len(records)
    sections = []
    sql_val = []
    sql_insert = 0
    for row in records:
        sections.append([row[0],row[1],row[2]])
    for id in range(len(sections)-1):
        sql_val.append((sections[id][0],sections[id+1][0], haversine(sections[id][1],sections[id][2],sections[id+1][1],sections[id+1][2])))
    sql_insert = "INSERT INTO section (id, idpointf, idpoints, distanse) VALUES (NULL, %s, %s, %s)"
    cursor.executemany(sql_insert,sql_val)

con.commit()
con.close()